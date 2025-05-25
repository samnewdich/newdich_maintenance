<?php
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/head.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/left.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/public/wallet/wallet-top-body.php");
?>




                  <div class="tab-content tab-content-basic">
                    <h3>Credit/Debit Wallet</h3>
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <!--<div class="statistics-details d-flex align-items-center justify-content-between" style="display:flex; flex-wrap:wrap;">-->
                          <form action="" method="GET">
                          <label>Search User to Credit/Debit</label>  
                          <table style="width:100%;">
                                <tr style="width:100%;">
                                    <td style="width:80%;">
                                        <input style="width:100%; height:35px;" type="text" name="emailsearch" placeholder="Search Via Email | Username | Phone | FullName" />
                                    </td>
                                    <td style="width:20%;">
                                        <button style="border:none; color:white; cursor:pointer; width:100%; height:35px; background-color:royalblue;" id="scrdeb">Search</button>
                                    </td>
                                </tr>
                            </table>
                            </form>

                            <?php
                            $emailsearch;
                            if(isset($_GET["emailsearch"])){
                                $emailsearch = trim(htmlspecialchars($_GET["emailsearch"]));
                            }
                            ?>

                          <?php
                          include($_SERVER["DOCUMENT_ROOT"]."/Users/Query/QUsers.php");

                          $allAirtime = json_decode($newQUser->getUserByEmailUsernamePhoneFullName($emailsearch), true);
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
                            echo '<th class="tdscroll">Fullname</th>';
                            echo '<th class="tdscroll">Phone</th>';
                            echo '<th class="tdscroll">Account Type</th>';
                            echo '</tr>';
                            echo '</thead>';
                            for ($i = 0; $i < count($thePlans); $i++) {
                                $plan = $thePlans[$i];
                            
                                // Collect all parameters as a JS-friendly argument list
                                $jsArgs = [
                                    json_encode($plan["email"]),
                                    json_encode($plan["userName"]),
                                    json_encode($plan["fname"]),
                                    json_encode($plan["phone"]),
                                    json_encode($plan["accountType"])
                                ];
                            
                                // Implode the arguments into a single JS argument list string
                                $jsArgString = implode(', ', $jsArgs);
                            
                                // Echo the row with onclick
                                echo '<tr style="background:red; color:white; cursor:pointer;" onclick=\'askBeforeAction(' . $jsArgString . ')\'>'; // notice the single quotes around onclick        
                                //echo '<tr style="background:red; color:white; cursor:pointer;">'; // notice the single quotes around onclick                                                        
                                echo '<td class="tdscroll">' .$sn++ . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["email"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["userName"]) . '</td>';
                                echo '<td class="tdscroll">'.htmlspecialchars($plan["fname"]).'</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["phone"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["accountType"]) . '</td>';
                                echo '</tr>';
                            }
                            
                            echo '</table>';
                            echo '</div>';
                          }
                          else{
                            echo $allAirtime["reason"];
                            echo '<br />';
                            echo 'This means no user is found. <br />';
                          }
                          ?>

                            <hr />
                        </div>
                        </div>

<script>
function askBeforeAction(askd1, askd2, askd3, askd4, askd5){
    event.preventDefault();
    //firstly close the modal
    closeAdminModal();
    //then open the modal
    openAdminModal();
    //then pass contemt to the inner modal.
    document.getElementById("adminmodalinner").innerHTML=`
        <div style="padding:7px">
            <p>
            <label>User Email:</label><br/>
            <input type="text" id="cdemail" value="${askd1}" style="height:35px; width:100%;" />
            </p>

            <p>
            <label>Username:</label><br/>
            <input type="text" id="cdusername" value="${askd2}" style="height:35px; width:100%;" />
            </p>

            <p>
            <label>Fullname:</label><br/>
            <input type="text" id="cdfname" value="${askd3}" style="height:35px; width:100%;" />
            </p>

            <p>
            <label>Phone:</label><br/>
            <input type="text" id="cdphone" value="${askd4}" style="height:35px; width:100%;" />
            </p>

            <p>
            <label>Account Type:</label><br/>
            <input type="text" id="cdaccounttype" value="${askd5}" style="height:35px; width:100%;" />
            </p>

            <p>
            <label>Action to perform:</label><br/>
            <select id="cdaction" style="height:35px; width:100%;">
                <option value="">Choose One</option>
                <option value="credit">Credit</option>
                <option value="debit">Debit</option>
            </select>
            </p>

            <p>
            <label>Amount:</label><br/>
            <input type="number" id="cdamount" placeholder="Amount to transact" style="height:35px; width:100%;" />
            </p>

            <p>
            <label>Currency:</label><br/>
            <select id="cdcurrency" style="height:35px; width:100%;">
                <option value="NGN">Nigeria Naira</option>
                <option value="GHC">Ghana Cedis</option>
                <option value="ZAR">South Africa Rands</option>
                <option value="USD">United States Dollar</option>
                <option value="GBP">Great British Pounds</option>
            </select>
            </p>

            <p>
            <label>Reason/Note:</label><br/>
            <textarea id="cdreason" style="height:50px; width:100%;"></textarea>
            </p>

            <p>
            <label>Admin Email:</label><br/>
            <input type="email" id="adminemail" placeholder="Admin Email" style="height:35px; width:100%;" />
            </p>

            <p>
            <label>Admin Password:</label><br/>
            <input type="text" id="adminpassword" placeholder="Admin Password" style="height:35px; width:100%;" />
            </p>

            <p id="output">
                <em style="font-size:14px; color:red;">Please check well before proceeding..</em>
                <br/>
                <button onclick="creditDebitWallet()" style="width:200px; height:40px; cursor:pointer; border:none; background-color:royalblue; color:white;">Continue</button>
            </p>
        </div>
    `;
}



function creditDebitWallet(){
    event.preventDefault();
    let cdemail = document.getElementById("cdemail").value;
    let cdusername = document.getElementById("cdusername").value;
    let cdfname = document.getElementById("cdfname").value;
    let cdphone = document.getElementById("cdphone").value;
    let cdaccounttype = document.getElementById("cdaccounttype").value;
    let cdaction = document.getElementById("cdaction").value;
    let cdamount = document.getElementById("cdamount").value;
    let cdreason = document.getElementById("cdreason").value;
    let adminEmail = document.getElementById("admemail").value;
    let adminPassword = document.getElementById("adminpassword").value;
    let cdcurrency = document.getElementById("cdcurrency").value;

    let dataSending =`adminEmail=${adminEmail}&adminPassword=${adminPassword}&email=${cdemail}&action=${cdaction}&amount=${cdamount}&reason=${cdreason}&currency=${cdcurrency}`;

    $.ajax({
        url:"/Controller/Admin/CreditDebitWallet.php",
        method:"POST",
        dataType:"html",
        data:dataSending,
        cache:false,
        beforeSend:function(){
            document.getElementById("output").innerHTML=`<font style="color:red; font-size:14px;">Loading..</font>`;
        },
        success:function(respp){
            try{
                if(respp !==undefined && respp !==null && respp !==''){
                    let response = JSON.parse(respp);
                    if(response.statusret ==="success"){
                        document.getElementById("output").innerHTML=`<font style="color:green; font-size:14px;">Operation was successful</font>`;
                    }
                    else{
                        document.getElementById("output").innerHTML=`<font style="color:red; font-size:14px;">${response.reason}</font>`;
                    }
                }
                else{
                    document.getElementById("output").innerHTML=`<font style="color:red; font-size:14px;">Oops!! something went wrong</font>`;
                }
            }
            catch(errtr){
                console.error(errtr.message);
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