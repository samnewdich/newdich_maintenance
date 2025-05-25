<?php
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/head.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/left.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/public/airtime/airtime-top-body.php");
?>




                  <div class="tab-content tab-content-basic">
                    <h3>Airtime Plans</h3>
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <!--<div class="statistics-details d-flex align-items-center justify-content-between" style="display:flex; flex-wrap:wrap;">-->

                          <?php
                          include($_SERVER["DOCUMENT_ROOT"]."/Airtime/Query/QAirtime.php");
                          include($_SERVER["DOCUMENT_ROOT"]."/Api_Provider/Query/QApiProvider.php");

                          $allAirtime = json_decode($newQAirtime->getAllAirtimePlans(), true);
                          
                          if($allAirtime["statusret"] =="success"){
                            $thePlans = $allAirtime["data"];
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-striped">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th class="tdscroll">Network</th>';
                            echo '<th class="tdscroll">Network ID</th>';
                            echo '<th class="tdscroll">API Provider</th>';
                            echo '<th class="tdscroll">Currency</th>';
                            echo '<th class="tdscroll">Status</th>';
                            echo '<th class="tdscroll">SmartEarner Discount</th>';
                            echo '<th class="tdscroll">TopUser Discount</th>';
                            echo '<th class="tdscroll">Reseller Discount</th>';
                            echo '<th class="tdscroll">Affiliate Discount</th>';
                            echo '<th class="tdscroll">API Discount</th>';
                            echo '</tr>';
                            echo '</thead>';
                            for ($i = 0; $i < count($thePlans); $i++) {
                                $plan = $thePlans[$i];
                            
                                // Collect all parameters as a JS-friendly argument list
                                $jsArgs = [
                                    json_encode($plan["tableId"]),
                                    json_encode($plan["network"]),
                                    json_encode($plan["networkId"]),
                                    json_encode($plan["provider"]),
                                    json_encode($plan["currency"]),
                                    json_encode($plan["status"]),
                                    json_encode($plan["smart_earner"]),
                                    json_encode($plan["top_user"]),
                                    json_encode($plan["reseller"]),
                                    json_encode($plan["affiliate"]),
                                    json_encode($plan["api"])
                                ];
                            
                                // Implode the arguments into a single JS argument list string
                                $jsArgString = implode(', ', $jsArgs);
                            
                                // Echo the row with onclick
                                if($plan['status'] ==='on'){
                                    echo '<tr style="background:royalblue; color:white; cursor:pointer;" onclick=\'editAirtimePlanModal(' . $jsArgString . ')\'>'; // notice the single quotes around onclick
                                }
                                elseif($plan['status'] ==='off'){
                                    echo '<tr style="background:red; color:white; cursor:pointer;" onclick=\'editAirtimePlanModal(' . $jsArgString . ')\'>'; // notice the single quotes around onclick
                                }
                                
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["network"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["networkId"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["provider"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["currency"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["status"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["smart_earner"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["top_user"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["reseller"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["affiliate"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["api"]) . '</td>';
                                echo '</tr>';
                            }
                            
                            echo '</table>';
                            echo '</div>';
                          }
                          else{
                            echo $allAirtime["reason"];
                            echo '<br />';
                            echo 'This means no Airtime plan is found. <br />';
                          }
                          ?>

                          <hr />
                          <div class="col-12 grid-margin stretch-card">
                           <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Add Airtime plans</h4>
                            <p class="card-description"> Add Airtime plans</p>
                            <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">Network</label>
                                <select id="network" name="network" class="form-control">
                                    <option value="9mobile">9Mobile</option>
                                    <option value="airtel">Airtel</option>
                                    <option value="glo">GLO</option>
                                    <option value="mtn">MTN</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Network ID</label>
                                <select id="networkid" name="networkid" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputName1">API Provider</label>
                                <select id="provider" name="provider" class="form-control">
                                    <?php
                                    $appv = json_decode($newQApiProvider->getAllApIProviders(), true);
                                    if($appv["statusret"] ==="success"){
                                        $dataCome = $appv["data"];
                                        for($i=0; $i<count($dataCome); $i++){
                                            echo '<option value="'.$dataCome[$i]["provider"].'">';
                                            echo ucwords($dataCome[$i]["provider"]);
                                            echo '</option>';
                                        }
                                    }
                                    else{
                                        echo $appv["reason"];
                                    }
                                    ?>
                                </select>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputName1">Currency</label>
                                <select id="currency" name="currency" class="form-control">
                                    <option value="NGN">Nigerian Naira (NGN)</option>
                                    <option value="GHC">Ghanian Cedis (GHC)</option>
                                    <option value="ZAR">South African Rands (ZAR)</option>
                                    <option value="USD">United States Dollar (USD)</option>
                                </select>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputName1">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="on">ON</option>
                                    <option value="off">OFF</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Discount For Smart Earners(if any) In Currency</label>
                                <input type="number" id="smart_earner" name="smart_earner" placeholder="e.g 10" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Discount For Top Users(if any) In Currency</label>
                                <input type="number" id="top_user" name="top_user" placeholder="e.g 10" class="form-control">
                            </div>



                            <div class="form-group">
                                <label for="exampleInputName1">Discount For Resellers(if any) In Currency</label>
                                <input type="number" id="reseller" name="reseller" placeholder="e.g 10" class="form-control">
                            </div>



                            <div class="form-group">
                                <label for="exampleInputName1">Discount For Affiliates(if any) In Currency</label>
                                <input type="number" id="affiliate" name="affiliate" placeholder="e.g 10" class="form-control">
                            </div>
                            


                            <div class="form-group">
                                <label for="exampleInputName1">Discount For API Users(if any) In Currency</label>
                                <input type="number" id="api" name="api" placeholder="e.g 10" class="form-control">
                            </div>



                            <div class="form-group">
                                <label for="exampleInputName1">Admin Email</label>
                                <input type="email" id="adminEmail" name="adminEmail" class="form-control">
                            </div>
                            

                            <div class="form-group">
                                <label for="exampleInputName1">Admin Password</label>
                                <input type="text" id="adminPassw" name="adminPassw" class="form-control">
                            </div>
                            
                            
                            <div style="padding:10px;" id="btnsub">
                                <button onclick="addAirtimePlan()" style="width:350px; height:35px; border:none; border-radius:10px; background-color:royalblue; color:white; cursor:pointer;">Add Plan</button>
                            </div>

                            <div style="padding:10px; text-align:center;" id="output"></div>
                            
                            </form>
                          </div>
                        </div>
                        </div>

<script>
    function editAirtimePlanModal(data1, data2, data3, data4, data5, data6, data7, data8, data9, data10, data11){
        event.preventDefault();
        //Note: once you open the adminmodal, you pass your content into the adminmodalinner
        openAdminModal();
        document.getElementById("adminmodalinner").innerHTML=`
        <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Airtime Plans</h4>
                    <p class="card-description"> Edit Airtime Plans </p>
                    <form class="forms-sample">
                        <input type="hidden" id="edittbleid" value="${data1}" />
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Network</label>
                        <div class="col-sm-9">
                            <select id="editnetwork" name="editnetwork" class="form-control">
                                <option value="${data2}">${data2}</option>
                                <option value="9mobile">9Mobile</option>
                                <option value="airtel">Airtel</option>
                                <option value="glo">GLO</option>
                                <option value="mtn">MTN</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Network ID</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editnetworkid" value="${data3}" placeholder="Network ID">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">API Provider</label>
                        <div class="col-sm-9">
                        <select id="editprovider" name="editprovider" class="form-control">
                                    <?php
                                    $appv = json_decode($newQApiProvider->getAllApIProviders(), true);
                                    if($appv["statusret"] ==="success"){
                                        $dataCome = $appv["data"];
                                        ?>
                                        <option value="${data4}">${data4.toUpperCase()}</option>
                                        <?php
                                        for($i=0; $i<count($dataCome); $i++){
                                            echo '<option value="'.$dataCome[$i]["provider"].'">';
                                            echo ucwords($dataCome[$i]["provider"]);
                                            echo '</option>';
                                        }
                                    }
                                    else{
                                        echo $appv["reason"];
                                    }
                                    ?>
                                </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Currency</label>
                        <div class="col-sm-9">
                          <select class="form-control" id="editcurrency">
                                <option value="${data5}">${data5}</option>
                                <option value="NGN">Nigerian Naira(NGN)</option>
                                <option value="GHC">Ghanian Cedis(GHC)</option>
                                <option value="ZAR">South African Rands(ZAR)</option>
                                <option value="USD">United States Dollar(USD)</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="editstatus">
                                <option value="${data6}">${data6}</option>
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Smart Earner Discount(Currency)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editsmartearner" value="${data7}" placeholder="Smart Earner Discount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Top User Discount(Currency)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="edittopuser" value="${data8}" placeholder="Top User Discount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Reseller Discount(Currency)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editreseller" value="${data9}" placeholder="Reseller Discount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Affiliate Discount(Currency)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editaffiliate" value="${data10}" placeholder="Affiliate Discount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">API Discount(Currency)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editapi" value="${data11}" placeholder="API Discount">
                        </div>
                      </div>
                      <span id="savechango">
                        <button type="submit" class="btn btn-primary me-2" onclick="saveChanges()">Save Changes</button>
                        <button class="btn btn-light" onclick="askBeforeAction('${data1}','${data2}','${data3}','${data4}','${data5}')">Delete Plan</button>
                      </span>
                    </form>
                  </div>
                </div>
              </div>
        `;
    }


function saveChanges(){
    event.preventDefault();
    let edittableid = document.getElementById("edittbleid").value;
    let editnetwork = document.getElementById("editnetwork").value;
    let editnetworkid = document.getElementById("editnetworkid").value;
    let editprovider = document.getElementById("editprovider").value;
    let editcurrency = document.getElementById("editcurrency").value;
    let editstatus = document.getElementById("editstatus").value;
    let editsmartearner = document.getElementById("editsmartearner").value;
    let edittopuser = document.getElementById("edittopuser").value;
    let editreseller = document.getElementById("editreseller").value;
    let editaffiliate = document.getElementById("editaffiliate").value;
    let editapi = document.getElementById("editapi").value;
    let dataSaveChange =`id=${edittableid}&network=${editnetwork}&networkid=${editnetworkid}&provider=${editprovider}&currency=${editcurrency}&status=${editstatus}&smartearner=${editsmartearner}&topuser=${edittopuser}&reseller=${editreseller}&affiliate=${editaffiliate}&api=${editapi}`;
    $.ajax({
        url:"/Controller/Admin/UpdateAirtimePlan.php",
        method:"POST",
        dataType:"html",
        data:dataSaveChange,
        cache:false,
        beforeSend:function(){
            document.getElementById("savechango").innerHTML=`<font style="color:royalblue;">Saving Changes..</font>`;
        },
        success:function(rres){
            try{
                if(rres !=='' && rres !==undefined && rres !==null){
                    let rresponse = JSON.parse(rres);
                    if(rresponse.statusret ==="success"){
                        document.getElementById("savechango").innerHTML=`<font style="color:green;">Changes Saved.</font>`;
                    }
                    else{
                        document.getElementById("savechango").innerHTML=`<font style="color:red;">${rresponse.reason}</font>`;
                    }
                }
                else{
                    document.getElementById("savechango").innerHTML=`<font style="color:red;">Oops!! something went wrong..</font>`;
                }
            }
            catch(err){
                console.error(err.message);
            }
        }
    });
}



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
                            
                          <script>
                            function addAirtimePlan(){
                                event.preventDefault();
                                let network = document.getElementById("network").value;
                                let networkId = document.getElementById("networkid").value;
                                let provider = document.getElementById("provider").value;
                                let currency = document.getElementById("currency").value;
                                let status = document.getElementById("status").value;
                                let smartEarner = document.getElementById("smart_earner").value;
                                let topUser = document.getElementById("top_user").value;
                                let reseller = document.getElementById("reseller").value;
                                let affiliate = document.getElementById("affiliate").value;
                                let api = document.getElementById("api").value;
                                let adminEmail = document.getElementById("adminEmail").value;
                                let adminPassw = document.getElementById("adminPassw").value;
                                let planToSend =`adminEmail=${adminEmail}&adminPassw=${adminPassw}&network=${network}&networkId=${networkId}&provider=${provider}&currency=${currency}&status=${status}&smartEarner=${smartEarner}&topUser=${topUser}&reseller=${reseller}&affiliate=${affiliate}&api=${api}`;
                                $.ajax({
                                    url:"/Controller/Admin/AddAirtimePlan.php",
                                    method:"POST",
                                    dataType:"html",
                                    data:planToSend,
                                    cache:false,
                                    beforeSend:function(){
                                        document.getElementById("btnsub").style.display="none";
                                        document.getElementById("output").innerHTML="Processing";
                                    },
                                    success:function(sty){
                                        try{
                                            if(sty !== null && sty !== undefined && sty !==''){
                                                let dsty = JSON.parse(sty);
                                                if(dsty.statusret ==="success"){
                                                    document.getElementById("btnsub").style.display="block";
                                                    return document.getElementById("output").innerHTML="Added successfully";
                                                }
                                                else{
                                                    document.getElementById("btnsub").style.display="block"; 
                                                    return document.getElementById("output").innerHTML=`${dsty.reason}`;
                                                }
                                            }
                                            else{
                                                document.getElementById("btnsub").style.display="block"; 
                                                return document.getElementById("output").innerHTML="Oops!! something went wrong";
                                            }
                                        }
                                        catch(err){
                                            console.error(err.message);
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