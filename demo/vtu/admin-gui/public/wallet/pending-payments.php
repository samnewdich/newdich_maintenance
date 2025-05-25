<?php
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/head.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/left.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/public/wallet/wallet-top-body.php");
?>




                  <div class="tab-content tab-content-basic">
                    <h3>Pending Manual Payments</h3>
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <!--<div class="statistics-details d-flex align-items-center justify-content-between" style="display:flex; flex-wrap:wrap;">-->

                          <?php
                          include($_SERVER["DOCUMENT_ROOT"]."/Wallet/Query/QWallet.php");

                          $allAirtime = json_decode($newQWallet->allPendingManualPayments(), true);

                          if($allAirtime["statusret"] =="success"){
                            $thePlans = $allAirtime["data"];
                            $sn = 1;
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-striped">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th class="tdscroll">S/N</th>';
                            echo '<th class="tdscroll">Email</th>';
                            echo '<th class="tdscroll">Username</th>';
                            echo '<th class="tdscroll">Amount Paid</th>';
                            echo '<th class="tdscroll">From(Bank)</th>';
                            echo '<th class="tdscroll">Payer</th>';
                            echo '<th class="tdscroll">Date</th>';
                            echo '<th class="tdscroll">Status</th>';
                            echo '</tr>';
                            echo '</thead>';
                            for ($i = 0; $i < count($thePlans); $i++) {
                                $plan = $thePlans[$i];
                            
                                // Collect all parameters as a JS-friendly argument list
                                $jsArgs = [
                                    json_encode($plan["tableId"]),
                                    json_encode($plan["email"]),
                                    json_encode($plan["userName"]),
                                    json_encode($plan["amountPaid"]),
                                    json_encode($plan["fromBank"]),
                                    json_encode($plan["payerName"]),
                                    json_encode($plan["datePaid"]),
                                    json_encode($plan["status"]),
                                    json_encode($plan["currency"])
                                ];
                            
                                // Implode the arguments into a single JS argument list string
                                $jsArgString = implode(', ', $jsArgs);
                            
                                // Echo the row with onclick
                                echo '<tr style="background:red; color:white; cursor:pointer;" onclick=\'askBeforeAction(' . $jsArgString . ')\'>'; // notice the single quotes around onclick        
                                //echo '<tr style="background:red; color:white; cursor:pointer;">'; // notice the single quotes around onclick                                                        
                                echo '<td class="tdscroll">' .$sn++ . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["email"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["userName"]) . '</td>';
                                echo '<td class="tdscroll">'.htmlspecialchars($plan["currency"]).'' . htmlspecialchars($plan["amountPaid"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["fromBank"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["payerName"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["datePaid"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["status"]) . '</td>';
                                echo '</tr>';
                            }
                            
                            echo '</table>';
                            echo '</div>';
                          }
                          else{
                            echo $allAirtime["reason"];
                            echo '<br />';
                            echo 'This means no pending manual payment is found. <br />';
                          }
                          ?>

                            <hr />
                        </div>
                        </div>

<script>
function askBeforeAction(askd1, askd2, askd3, askd4, askd5, askd6, askd7, askd8, askd9){
    event.preventDefault();
    //firstly close the modal
    closeAdminModal();
    //then open the modal
    openAdminModal();
    //then pass contemt to the inner modal.
    document.getElementById("adminmodalinner").innerHTML=`
        <div style="padding:7px; text-align:center;">
            Do you want to delete this Pending Manual Payment ?
            
            <p>(${askd2} ${askd3} ${askd4} ${askd5} ${askd6} ${askd7}, ${askd8}, ${askd9})<p>
                <span id="screeno">
                <button onclick="deletePlan('${askd1}')" style="background-color:red; color:white; cursor:pointer; height:35px;">Yes Delete</button> 
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="closeAdminModal()" style="background-color:royalblue; color:white; cursor:pointer; height:35px;">Cancel</button>
                </span> <hr />
            </p>

            <p>
             <h1>OR</h1>
                <button onclick="askConfirmPayment('${askd1}', '${askd2}', '${askd3}', '${askd4}', '${askd5}', '${askd6}', '${askd7}', '${askd8}', '${askd9}')" style="background-color:royalblue; color:white; cursor:pointer; height:35px; width:200px; border:none;">Confirm Payment</button>
            </p>
        </div>
    `;
}



function deletePlan(dataToDelete){
    event.preventDefault();
    let dataDel =`data=${dataToDelete}`;
    $.ajax({
        url:"/Controller/Admin/DeletePendingManualPayment.php",
        method:"POST",
        dataType:"html",
        data:dataDel,
        cache:false,
        beforeSend:function(){
            document.getElementById("screeno").innerHTML=`<font style="color:red;">Deleting..</font>`;
        },
        success:function(respp){
            try{
                if(respp !=='' && respp !== null && respp !== undefined){
                    let response = JSON.parse(respp);
                    if(response.statusret ==="success"){
                        document.getElementById("screeno").innerHTML=`<font style="color:green;">Pending Manual Payment Deleted</font>`;
                    }
                    else{
                        document.getElementById("screeno").innerHTML=`<font style="color:red;">${response.reason}</font>`;
                    }
                }
                else{
                    document.getElementById("screeno").innerHTML=`<font style="color:red;">Oops!! something went wrong..</font>`;
                }
            }
            catch(error){
                console.error(error.message);
            }
        }
    });
}


function askConfirmPayment(askd1, askd2, askd3, askd4, askd5, askd6, askd7, askd8, askd9){
    event.preventDefault();
    //firstly close the modal
    closeAdminModal();
    //then open the modal
    openAdminModal();
    //then pass contemt to the inner modal.
    document.getElementById("adminmodalinner").innerHTML=`
        <div style="padding:7px; text-align:center; font-weight:bolder; font-size:14px;">
            Are you sure you want to Confirm this Pending Manual Payment ?
            
            <p>User Email: ${askd2} <br/>Username: ${askd3} <br/>Amount Paid: ${askd4} <br/>From(Bank): ${askd5} <br/>Payer Name: ${askd6} <br/>Currency: ${askd9})<p>
                <span id="screeno">
                <button onclick="confirmPayment('${askd1}', '${askd2}', '${askd3}', '${askd4}', '${askd5}', '${askd6}', '${askd7}', '${askd8}', '${askd9}')" style="background-color:royalblue; color:white; cursor:pointer; height:35px;">Yes Confirm</button> 
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="closeAdminModal()" style="background-color:red; color:white; cursor:pointer; height:35px;">Cancel</button>
                </span> <hr />
            </p>
            <p id="confirmoutput"></p>
        </div>
    `;

}


function confirmPayment(askd1, askd2, askd3, askd4, askd5, askd6, askd7, askd8, askd9){
    event.preventDefault();
    let dtsend =`id=${askd1}&email=${askd2}&userName=${askd3}&amountPaid=${askd4}&fromBank=${askd5}&payerName=${askd6}&datePaid=${askd7}&status=${askd8}&currency=${askd9}`;
    $.ajax({
        url:"/Controller/Admin/ConfirmPayment.php",
        method:"POST",
        dataType:"html",
        data:dtsend,
        cache:false,
        beforeSend:function(){
            document.getElementById("confirmoutput").innerHTML=`Confirming..`;
        },
        success:function(respp){
            try{
                if(respp !=='' && respp !='' && respp !==undefined && respp !==null){
                    let respponse = JSON.parse(respp);
                    if(respponse.statusret ==="success"){
                        document.getElementById("confirmoutput").innerHTML=`<font style="color:green;">Payment Confirmed</font>`;
                        setInterval(() => {
                            window.location="/admin-pending-payment"
                        }, 1000);
                    }
                    else{
                        document.getElementById("confirmoutput").innerHTML=`${respponse.reason}`;
                    }
                }
                else{
                    document.getElementById("confirmoutput").innerHTML="Oops!! Something went wrong";
                }
            }
            catch(errt){
                console.error(errt.message);
            }
        }
    });
}
</script>
                            
                        </div>



                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Developed & Maintained By <a href="https://www.newdich.tech/" target="_blank">Newdich Technology</a></span>
              <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2024. All rights reserved.</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->




<?php
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/footer.php");
?>