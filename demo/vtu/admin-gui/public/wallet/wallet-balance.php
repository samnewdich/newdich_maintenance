<?php
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/head.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/left.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/public/wallet/wallet-top-body.php");
?>




                  <div class="tab-content tab-content-basic">
                    <h3>Wallet Balance</h3>
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <!--<div class="statistics-details d-flex align-items-center justify-content-between" style="display:flex; flex-wrap:wrap;">-->

                          <?php
                          include($_SERVER["DOCUMENT_ROOT"]."/Wallet/Query/QWallet.php");

                          $allAirtime = json_decode($newQWallet->allWalletBalance($email="", $walletBalance="", $currency="", $currentPage=0, $pagePerRow=50), true);

                            $emailsearch = trim(htmlspecialchars($_GET["emailsearch"])) ? trim(htmlspecialchars($_GET["emailsearch"])) : '';
                            $pageNumberSearch = trim(htmlspecialchars($_GET["page_number"])) ? trim(htmlspecialchars($_GET["page_number"])) : 50;
                            $currentPageSearch = trim(htmlspecialchars($_GET["current_page"])) ? trim(htmlspecialchars($_GET["current_page"])) : 0;
                            $walletbalancesearch = trim(htmlspecialchars($_GET["walletbalancesearch"])) ? trim(htmlspecialchars($_GET["walletbalancesearch"])) : '';
                            $currencysearch = trim(htmlspecialchars($_GET["currencysearch"])) ? trim(htmlspecialchars($_GET["currencysearch"])) : '';

                            $pageNumberSearch = (int) $pageNumberSearch;
                            $currentPageSearch = (int) $currentPageSearch;
                            $currentPageSearchDisplay = $currentPageSearch + 1;

                            $allAirtime;
                            if(isset($_GET["currentpage"])){
                                $cpage = (int) trim(htmlspecialchars($_GET["currentpage"]));
                                $allAirtime = json_decode($newQWallet->allWalletBalance($emailsearch, $walletbalancesearch, $currencysearch, $cpage, $pageNumberSearch), true);
                            }
                            elseif(isset($_GET["current_page"])){
                                $cpage = (int) trim(htmlspecialchars($_GET["current_page"]));
                                $allAirtime = json_decode($newQWallet->allWalletBalance($emailsearch, $walletbalancesearch, $currencysearch, $cpage, $pageNumberSearch), true);
                            }
                            else{
                                $cpage = $currentPageSearch;
                                $allAirtime = json_decode($newQWallet->allWalletBalance($emailsearch, $walletbalancesearch, $currencysearch, $cpage, $pageNumberSearch), true);
                            }

                            $allRows = (int) $allAirtime["allRows"];
                            

                            echo '<p>Filter By :</p>';
                            echo '<form action="" method="GET" enctype="multipart/form-data">';

                            echo '<table style="width:100%;">';
                            echo '<tr style="width:100%;">';
                            echo '<td style="width:33%;"> Rows:<br/>
                            <select style="height:35px; width:100%;" name="page_number">
                            <option value="'.$pageNumberSearch.'">'.$pageNumberSearch.'</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                            </select>
                            </td>';
                            echo '<td style="width:33%;"> Page:<br/>';
                            $tpt = ceil($allRows/$pageNumberSearch);
                            echo '<select style="height:35px; width:100%;" name="current_page">';
                            echo '<option value='.$currentPageSearch.'>'.$currentPageSearchDisplay.'</option>';
                            for($x=0; $x<$tpt; $x++){
                            $xx = $x+1;
                            echo '<option value='.$x.'>'.$xx.'</option>';
                            }
                            echo '</select>';
                            echo '</td>';
                            echo '<td style="width:33%;">Currency:<br/>
                            <select style="height:35px; width:100%;" name="currencysearch">
                            <option value="'.$currencysearch.'">'.$currencysearch.'</option>
                            <option value="">All</option>
                            <option value="NGN">Nigerian Naira(NGN)</option>
                            <option value="USD">United States Dollar(USD)</option>
                            <option value="GHC">Ghanian Cedis(GHC)</option>
                            <option value="ZAR">South African Rands(ZAR)</option>
                            <option value="GBP">Great British Pounds(GBP)</option>
                            </select>';
                            echo '<tr>';
                            echo '</table>';

                            echo '<table style="width:100%;">';
                            echo '<tr style="width:100%;">';
                            echo '<td style="width:75%;"> Search: <input style="width:100%; height:35px;" type="text" value="'.$emailsearch.'" name="emailsearch" placeholder="Search By Email " /></td>';
                            echo '<td style="width:25%;"> <br/> <button style="width:100%; height:35px; background-color:royalblue; color:white; cursor:pointer; border:none; height:35px;">Search</button> </td>';
                            echo '<tr>';
                            echo '</table>';
                            echo '</form>';
                            echo '<hr/>';



                          if($allAirtime["statusret"] =="success"){
                            $thePlans = $allAirtime["data"];
                            $dpp = (int) $allAirtime["displayPerPage"];
                            $sn = 1;
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-striped">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th class="tdscroll">S/N</th>';
                            echo '<th class="tdscroll">Email</th>';
                            echo '<th class="tdscroll">Wallet Balance</th>';
                            echo '<th class="tdscroll">Total Deposited</th>';
                            echo '<th class="tdscroll">Total Spent</th>';
                            echo '<th class="tdscroll">Currency</th>';
                            echo '<th class="tdscroll">Last Updated</th>';
                            echo '</tr>';
                            echo '</thead>';
                            for ($i = 0; $i < count($thePlans); $i++) {
                                $plan = $thePlans[$i];

                                $cacl = $cpage * $dpp;
                                $incsnn = $sn++;
                                $snn = $cacl + $incsnn;
                            
                                // Collect all parameters as a JS-friendly argument list
                                $jsArgs = [
                                    json_encode($plan["tableId"]),
                                    json_encode($plan["email"]),
                                    json_encode($plan["walletBalance"]),
                                    json_encode($plan["totalDeposited"]),
                                    json_encode($plan["totalSpent"]),
                                    json_encode($plan["currency"]),
                                    json_encode($plan["lastUpdated"])
                                ];
                            
                                // Implode the arguments into a single JS argument list string
                                $jsArgString = implode(', ', $jsArgs);
                            
                                // Echo the row with onclick
                                //echo '<tr style="background:red; color:white; cursor:pointer;" onclick=\'askBeforeAction(' . $jsArgString . ')\'>'; // notice the single quotes around onclick        
                                echo '<tr style="background:red; color:white; cursor:pointer;">'; // notice the single quotes around onclick                                                        
                                echo '<td class="tdscroll">' .$snn . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["email"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["walletBalance"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["totalDeposited"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["totalSpent"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["currency"]) . '</td>';
                                echo '<td class="tdscroll">' . date("Y-m-d H:i:s", htmlspecialchars($plan["lastUpdated"])) . '</td>';
                                echo '</tr>';
                            }
                            
                            echo '</table>';
                            echo '</div>';

                            echo '<div class="table-responsive" style="margin-top:10px;">';
                            echo '<table class="table table-striped">';
                            echo '<tr style="width:100%;">';
                            $totalPages = ceil($allRows/$pageNumberSearch);

                            echo '<td>';
                            echo '<a href="?currentpage=0">';
                            echo '<button class="btn" style="text-align:center; cursor:pointer;">';
                            echo 'First Page';
                            echo '</button>';
                            echo '</a>';
                            echo '</td>';
                            for($p=0; $p<$totalPages; $p++){
                                echo '<td>';
                                if($cpage === $p){
                                    echo '<a href="?currentpage='.$p.'">';
                                    echo '<button class="btn" style="text-align:center; cursor:pointer; background-color:royalblue; color:white;">';
                                    echo $p+1;
                                    echo '</button>';
                                    echo '</a>';
                                    echo '</td>';
                                }
                                else{
                                    echo '<a href="?currentpage='.$p.'">';
                                    echo '<button class="btn" style="text-align:center; cursor:pointer;">';
                                    echo $p+1;
                                    echo '</button>';
                                    echo '</a>';
                                    echo '</td>';
                                }
                            }
                            echo '<td>';
                            $lastPage = (int) $totalPages - 1;
                            echo '<a href="?currentpage='.$lastPage.'">';
                            echo '<button class="btn" style="text-align:center; cursor:pointer;">';
                            echo 'Last Page';
                            echo '</button>';
                            echo '</a>';
                            echo '</td>';
                            echo '</tr>';
                            echo '</table>';
                            echo '</div>';

                          }
                          else{
                            echo $allAirtime["reason"];
                            echo '<br />';
                            echo 'This means no Wallet is found. <br />';
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
        <div style="padding:7px; text-align:center;">
            Are you sure you want to delete this plan ?
            
            <p>(${askd2} ${askd3} ${askd4} ${askd5})<p>
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
        url:"/Controller/Admin/DeleteAirtimePlan.php",
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
                        document.getElementById("screeno").innerHTML=`<font style="color:green;">Plan Deleted</font>`;
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