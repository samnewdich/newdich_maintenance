<?php
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/head.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/left.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/public/wallet/wallet-top-body.php");
?>




                  <div class="tab-content tab-content-basic">
                    <h3>Manual Payments</h3>
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <!--<div class="statistics-details d-flex align-items-center justify-content-between" style="display:flex; flex-wrap:wrap;">-->

                          <?php
                          include($_SERVER["DOCUMENT_ROOT"]."/Wallet/Query/QWallet.php");

                          $allAirtime = json_decode($newQWallet->allManualPayments(), true);

                          if($allAirtime["statusret"] =="success"){
                            $thePlans = $allAirtime["data"];
                            $sn = 1;
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-striped">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th class="tdscroll">S/N</th>';
                            echo '<th class="tdscroll">Bank Name</th>';
                            echo '<th class="tdscroll">Account Number</th>';
                            echo '<th class="tdscroll">Name On Account</th>';
                            echo '<th class="tdscroll">Currency</th>';
                            echo '<th class="tdscroll">Status</th>';
                            echo '</tr>';
                            echo '</thead>';
                            for ($i = 0; $i < count($thePlans); $i++) {
                                $plan = $thePlans[$i];
                            
                                // Collect all parameters as a JS-friendly argument list
                                $jsArgs = [
                                    json_encode($plan["tableId"]),
                                    json_encode($plan["bankName"]),
                                    json_encode($plan["accountNumber"]),
                                    json_encode($plan["beneficiaryName"]),
                                    json_encode($plan["currency"]),
                                    json_encode($plan["status"])
                                ];
                            
                                // Implode the arguments into a single JS argument list string
                                $jsArgString = implode(', ', $jsArgs);
                            
                                // Echo the row with onclick
                                echo '<tr style="background:red; color:white; cursor:pointer;" onclick=\'askBeforeAction(' . $jsArgString . ')\'>'; // notice the single quotes around onclick        
                                //echo '<tr style="background:red; color:white; cursor:pointer;">'; // notice the single quotes around onclick                                                        
                                echo '<td class="tdscroll">' .$sn++ . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["bankName"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["accountNumber"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["beneficiaryName"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["currency"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["status"]) . '</td>';
                                echo '</tr>';
                            }
                            
                            echo '</table>';
                            echo '</div>';
                          }
                          else{
                            echo $allAirtime["reason"];
                            echo '<br />';
                            echo 'This means no manual payment is found. <br />';
                          }
                          ?>

                            <hr />
                          <div class="col-12 grid-margin stretch-card">
                           <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Add Manual Payment</h4>
                            <p class="card-description"> Add Manual Payment</p>
                            <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">Currency</label>
                                <select id="currency" name="currency" class="form-control">
                                    <option value="NGN">Nigerian Naira(NGN)</option>
                                    <option value="GHC">Ghanian Cedis(GHC)</option>
                                    <option value="ZAR">South African Rands(ZAR)</option>
                                    <option value="USD">United States Dollar(USD)</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="on">On</option>
                                    <option value="off">Off</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Bank Name</label>
                                <input type="text" id="bank_name" name="bank_name" placeholder="e.g Opay" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Name On Account</label>
                                <input type="text" id="name_on_account" name="name_on_account" placeholder="e.g Newdich Technology" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Account number</label>
                                <input type="number" id="account_number" name="account_number" placeholder="e.g Opay" class="form-control">
                            </div>

                            
                            <div style="padding:10px;" id="btnsub">
                                <button onclick="addManualPayment()" style="width:350px; height:35px; border:none; border-radius:10px; background-color:royalblue; color:white; cursor:pointer;">Add Plan</button>
                            </div>

                            <div style="padding:10px; text-align:center;" id="output"></div>
                            
                            </form>
                          </div>
                        </div>
                        </div>
<script>
    function addManualPayment(){
        event.preventDefault();
        let currency = document.getElementById("currency").value;
        let status = document.getElementById("status").value;
        let accountNumber = document.getElementById("account_number").value;
        let nameOnAccount = document.getElementById("name_on_account").value;
        let bankName = document.getElementById("bank_name").value;
        let datst =`currency=${currency}&status=${status}&accountNumber=${accountNumber}&nameOnAccount=${nameOnAccount}&bankName=${bankName}`;
        $.ajax({
            url:"/Controller/Admin/AddManualPayment.php",
            method:"POST",
            dataType:"html",
            data:datst,
            cache:false,
            beforeSend:function(){
                document.getElementById("output").innerHTML=`Adding manual payment`;
            },
            success:function(resp){
                try{
                    if(resp !=='' && resp !==undefined && resp !==null){
                        let response = JSON.parse(resp);
                        if(response.statusret ==="success"){
                            document.getElementById("output").innerHTML=`<font style="color:royalblue; font-size:14px;">Successfully Added</font>`;
                        }
                        else{
                            document.getElementById("output").innerHTML=`${response.reason}`;
                        }
                    }
                    else{
                        document.getElementById("output").innerHTML=`<font style="font-size:14px; color:red;">Oops!! Something went wrong.</font>`;
                    }
                }
                catch(errr){
                    console.error(errr.message);
                }
            }
        });
    }
</script>

<script>
function askBeforeAction(askd1, askd2, askd3, askd4, askd5, askd6){
    event.preventDefault();
    //firstly close the modal
    closeAdminModal();
    //then open the modal
    openAdminModal();
    //then pass contemt to the inner modal.
    document.getElementById("adminmodalinner").innerHTML=`
        <div style="padding:7px; text-align:center;">
            Are you sure you want to delete this Manual Payment ?
            
            <p>(${askd2} ${askd3} ${askd4} ${askd5} ${askd6})<p>
                <span id="screeno">
                <button onclick="deletePlan('${askd1}')" style="background-color:red; color:white; cursor:pointer; height:35px;">Yes Delete</button> 
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="closeAdminModal()" style="background-color:royalblue; color:white; cursor:pointer; height:35px;">Cancel</button>
                </span>
            </p>
        </div>
    `;
}



function deletePlan(dataToDelete){
    event.preventDefault();
    let dataDel =`data=${dataToDelete}`;
    $.ajax({
        url:"/Controller/Admin/DeleteManualPayment.php",
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
                        document.getElementById("screeno").innerHTML=`<font style="color:green;">Manual Payment Deleted</font>`;
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