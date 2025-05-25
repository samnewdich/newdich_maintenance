<?php
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/head.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/left.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/public/data/data-top-body.php");
?>




                  <div class="tab-content tab-content-basic">
                    <h3>Data Types</h3>
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <!--<div class="statistics-details d-flex align-items-center justify-content-between" style="display:flex; flex-wrap:wrap;">-->

                          <?php
                          include($_SERVER["DOCUMENT_ROOT"]."/Data/Query/QData.php");
                          
                          $allAirtime;
                          if(!isset($_GET["currentpage"])){
                            $cpage = 0;
                            $allAirtime = json_decode($newQData->getAllDataPlans($cpage), true);
                          }
                          elseif(isset($_GET["currentpage"])){
                            $cpage = (int) trim(htmlspecialchars($_GET["currentpage"]));
                            $allAirtime = json_decode($newQData->getAllDataPlans($cpage), true);
                          }
                          
                          
                          if($allAirtime["statusret"] =="success"){
                            $thePlans = $allAirtime["data"];
                            $allRows = $allAirtime["totalRows"];
                            $nextp = $allAirtime["nextPage"];
                            $dpp = (int) $allAirtime["displayPerPage"];
                            echo '<p>Total : '.$allRows.'</p>';
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-striped">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th class="tdscroll">S/N</th>';
                            echo '<th class="tdscroll">Plan Id</th>';
                            echo '<th class="tdscroll">Plan Type</th>';
                            echo '<th class="tdscroll">Network ID</th>';
                            echo '<th class="tdscroll">Network</th>';
                            echo '<th class="tdscroll">Validity</th>';
                            echo '<th class="tdscroll">Plan</th>';
                            echo '<th class="tdscroll">Amount</th>';
                            echo '<th class="tdscroll">Status</th>';
                            echo '<th class="tdscroll">Provider</th>';
                            echo '<th class="tdscroll">Currency</th>';
                            echo '<th class="tdscroll">Smart Earner</th>';
                            echo '<th class="tdscroll">Top User</th>';
                            echo '<th class="tdscroll">Reseller</th>';
                            echo '<th class="tdscroll">Affiliate</th>';
                            echo '<th class="tdscroll">API</th>';
                            echo '</tr>';
                            echo '</thead>';
                            $sn = 1;
                            for($i = 0; $i < count($thePlans); $i++){
                                $plan = $thePlans[$i];

                                $jsArgs = [
                                    json_encode($plan["tableId"]),
                                    json_encode($plan["planId"]),
                                    json_encode($plan["planType"]),
                                    json_encode($plan["networkId"]),
                                    json_encode($plan["network"]),
                                    json_encode($plan["validity"]),
                                    json_encode($plan["plan"]),
                                    json_encode($plan["planAmount"]),
                                    json_encode($plan["status"]),
                                    json_encode($plan["provider"]),
                                    json_encode($plan["currency"]),
                                    json_encode($plan["smartEarner"]),
                                    json_encode($plan["topUser"]),
                                    json_encode($plan["reseller"]),
                                    json_encode($plan["affiliate"]),
                                    json_encode($plan["api"])
                                ];

                                // Implode the arguments into a single JS argument list string
                                $jsArgString = implode(', ', $jsArgs);

                                // Echo the row with onclick
                                if($plan['status'] ==='on'){
                                    echo '<tr style="background:royalblue; color:white; cursor:pointer;" onclick=\'editDataTypeModal(' . $jsArgString . ')\'>'; // notice the single quotes around onclick
                                }
                                elseif($plan['status'] ==='off'){
                                    echo '<tr style="background:red; color:white; cursor:pointer;" onclick=\'editDataTypeModal(' . $jsArgString . ')\'>'; // notice the single quotes around onclick
                                }

                                $cacl = $cpage * $dpp;
                                $incsnn = $sn++;
                                $snn = $cacl + $incsnn;

                                echo '<td class="tdscroll">' .$snn . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["planId"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["planType"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["networkId"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["network"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["validity"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["plan"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["planAmount"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["status"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["provider"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["currency"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["smartEarner"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["topUser"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["reseller"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["affiliate"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["api"]) . '</td>';
                                echo '</tr>';
                            }
                            echo '</table>';

                            echo '<table style="margin-top:10px;">';
                            echo '<tr>';
                            $totalPages = ceil($allRows/50);

                            echo '<td>';
                            echo '<a href="/admin-data-plans/?currentpage=0">';
                            echo '<button class="btn" style="text-align:center; cursor:pointer;">';
                            echo 'First Page';
                            echo '</button>';
                            echo '</a>';
                            echo '</td>';
                            for($p=0; $p<$totalPages; $p++){
                                echo '<td>';
                                if($cpage === $p){
                                    echo '<a href="/admin-data-plans/?currentpage='.$p.'">';
                                    echo '<button class="btn" style="text-align:center; cursor:pointer; background-color:royalblue; color:white;">';
                                    echo $p+1;
                                    echo '</button>';
                                    echo '</a>';
                                    echo '</td>';
                                }
                                else{
                                    echo '<a href="/admin-data-plans/?currentpage='.$p.'">';
                                    echo '<button class="btn" style="text-align:center; cursor:pointer;">';
                                    echo $p+1;
                                    echo '</button>';
                                    echo '</a>';
                                    echo '</td>';
                                }
                            }
                            echo '<td>';
                            $lastPage = (int) $totalPages - 1;
                            echo '<a href="/admin-data-plans/?currentpage='.$lastPage.'">';
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
                            echo 'This means no Data Plan is found. <br />';
                          }
                          ?>

                          <hr />
                          <div class="col-12 grid-margin stretch-card">
                           <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Add Data Plans</h4>
                            <p class="card-description"> Add Data Plans</p>
                            <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">Plan Id(e.g 201)</label>
                                <input type="number" id="planid" name="planid" placeholder="e.g 201" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Plan Type(e.g corporate gifting)</label>
                                <select id="plantype" name="plantype" class="form-control">
                                <?php
                                $appv = json_decode($newQData->getDataTypeUniquely(), true);
                                if($appv["statusret"] ==="success"){
                                    $dataCome = $appv["data"];
                                    for($i=0; $i<count($dataCome); $i++){
                                        echo '<option value="'.$dataCome[$i]["dataTypeName"].'">';
                                        echo $dataCome[$i]["dataTypeName"];
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
                                <label for="exampleInputName1">Network Id(e.g 2)</label>
                                <input type="number" id="networkid" name="networkid" placeholder="e.g 2" class="form-control">
                            </div>


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
                                <label for="exampleInputName1">Validity(e.g 30days)</label>
                                <input type="text" id="validity" name="validity" placeholder="e.g 30days" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Plan(Quantity)(e.g 10GB)</label>
                                <input type="text" id="plan" name="plan" placeholder="e.g 10GB" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Amount(Price)(e.g 2000)</label>
                                <input type="number" id="planamount" name="planamount" placeholder="e.g 2000" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="on">ON</option>
                                    <option value="off">OFF</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Provider</label>
                                <select id="provider" name="provider" class="form-control">
                                    <?php
                                    $appv = json_decode($newQApiProvider->getAllApIProviders(), true);
                                    if($appv["statusret"] ==="success"){
                                        $dataCome = $appv["data"];
                                        for($i=0; $i<count($dataCome); $i++){
                                            echo '<option value="'.$dataCome[$i]["provider"].'">';
                                            echo $dataCome[$i]["provider"];
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
                                <label for="exampleInputName1">Smart Earners Discount(Currency)</label>
                                <input type="number" id="smartearner" name="smartearner" placeholder="e.g 20" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Top Users Discount(Currency)</label>
                                <input type="number" id="topuser" name="topuser" placeholder="e.g 20" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Reseller Users Discount(Currency)</label>
                                <input type="number" id="reseller" name="reseller" placeholder="e.g 20" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Affiliate Users Discount(Currency)</label>
                                <input type="number" id="affiliate" name="affiliate" placeholder="e.g 20" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">API Users Discount(Currency)</label>
                                <input type="number" id="api" name="api" placeholder="e.g 20" class="form-control">
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
                                <button onclick="addDataTypes()" style="width:350px; height:35px; border:none; border-radius:10px; background-color:royalblue; color:white; cursor:pointer;">Add Data Type</button>
                            </div>

                            <div style="padding:10px; text-align:center;" id="output"></div>
                            
                            </form>
                            </div>
                        </div>
                        </div>



<script>
function editDataTypeModal(data1, data2, data3, data4, data5, data6, data7, data8, data9, data10, data11, data12, data13, data14, data15, data16){
    event.preventDefault();
    //Note: once you open the adminmodal, you pass your content into the adminmodalinner
    openAdminModal();
        document.getElementById("adminmodalinner").innerHTML=`
        <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Data Plan</h4>
                    <p class="card-description"> Edit Data Plan </p>
                    <form class="forms-sample">
                        <input type="hidden" id="edittbleid" value="${data1}" />
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Plan ID</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editplanid" value="${data2}" placeholder="Plan ID">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Plan Type</label>
                        <div class="col-sm-9">
                            <select id="editplantype" name="editplantype class="form-control">
                                <?php
                                $appv = json_decode($newQData->getDataTypeUniquely(), true);
                                if($appv["statusret"] ==="success"){
                                    $dataCome = $appv["data"];
                                    ?>
                                    <option value="${data3}">${data3}</option>
                                    <?php
                                    for($i=0; $i<count($dataCome); $i++){
                                        echo '<option value="'.$dataCome[$i]["dataTypeName"].'">';
                                        echo $dataCome[$i]["dataTypeName"];
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
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Network ID</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editnetworkid" value="${data4}" placeholder="Network ID">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Network</label>
                        <div class="col-sm-9">
                            <select id="editnetwork" name="editnetwork" class="form-control">
                                <option value="${data5}">${data5}</option>
                                <option value="9mobile">9Mobile</option>
                                <option value="airtel">Airtel</option>
                                <option value="glo">GLO</option>
                                <option value="mtn">MTN</option>
                            </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Validity</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editvalidity" value="${data6}" placeholder="Validity">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Plan(Quantity)</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editplan" value="${data7}" placeholder="Plan(Quantity)">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Network ID</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editplanamount" value="${data8}" placeholder="Plan Amount">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="editstatus">
                                <option value="${data9}">${data9}</option>
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Provider</label>
                        <div class="col-sm-9">
                            <select id="editprovider" name="editprovider" class="form-control">
                                    <?php
                                    $appv = json_decode($newQApiProvider->getAllApIProviders(), true);
                                    if($appv["statusret"] ==="success"){
                                        $dataCome = $appv["data"];
                                        ?>
                                        <option value="${data10}">${data10}</option>
                                        <?php
                                        for($i=0; $i<count($dataCome); $i++){
                                            echo '<option value="'.$dataCome[$i]["provider"].'">';
                                            echo $dataCome[$i]["provider"];
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
                                <option value="${data11}">${data11}</option>
                                <option value="NGN">Nigerian Naira(NGN)</option>
                                <option value="GHC">Ghanian Cedis(GHC)</option>
                                <option value="ZAR">South African Rands(ZAR)</option>
                                <option value="USD">United States Dollar(USD)</option>
                            </select>
                        </div>
                      </div>
                      
                      
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Smart Earners Discount(Currency)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editsmartearner" value="${data12}" placeholder="Smart Earners Discount(Currency)">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Top Users Discount(Currency)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="edittopuser" value="${data13}" placeholder="Top Users Discount(Currency)">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Resellers Discount(Currency)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editreseller" value="${data14}" placeholder="Resellers Discount(Currency)">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Affiliates Discount(Currency)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editaffiliate" value="${data15}" placeholder="Affiliates Discount(Currency)">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">APIs Discount(Currency)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editapi" value="${data16}" placeholder="APIs Discount(Currency)">
                        </div>
                      </div>

                      <span id="savechango">
                        <button type="submit" class="btn btn-primary me-2" onclick="saveChanges()">Save Changes</button>
                        <button class="btn btn-light" onclick="askBeforeAction('${data1}','${data2}','${data3}','${data4}','${data5}','${data6}','${data7}','${data8}','${data9}')">Delete Data Plan</button>
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
    let editplanid = document.getElementById("editplanid").value;
    let editplantype = document.getElementById("editplantype").value;
    let editnetworkid = document.getElementById("editnetworkid").value;
    let editnetwork = document.getElementById("editnetwork").value;
    let editvalidity = document.getElementById("editvalidity").value;
    let editplan = document.getElementById("editplan").value;
    let editplanamount = document.getElementById("editplanamount").value;
    let editstatus = document.getElementById("editstatus").value;
    let editprovider = document.getElementById("editprovider").value;
    let editcurrency = document.getElementById("editcurrency").value;
    let editsmartearner = document.getElementById("editsmartearner").value;
    let edittopuser = document.getElementById("edittopuser").value;
    let editreseller = document.getElementById("editreseller").value;
    let editaffiliate = document.getElementById("editaffiliate").value;
    let editapi = document.getElementById("editapi").value;
    
    let dataSaveChange =`id=${edittableid}&planid=${editplanid}&plantype=${editplantype}&networkid=${editnetworkid}&network=${editnetwork}&validity=${editvalidity}&plan=${editplan}&planamount=${editplanamount}&status=${editstatus}&provider=${editprovider}&currency=${editcurrency}&smartearner=${editsmartearner}&topuser=${edittopuser}&reseller=${editreseller}&affiliate=${editaffiliate}&api=${editapi}`;
    $.ajax({
        url:"/Controller/Admin/UpdateDataPlan.php",
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




function askBeforeAction(askd1, askd2, askd3, askd4, askd5, askd6, askd7, askd8, askd9){
    event.preventDefault();
    //firstly close the modal
    closeAdminModal();
    //then open the modal
    openAdminModal();
    //then pass contemt to the inner modal.
    document.getElementById("adminmodalinner").innerHTML=`
        <div style="padding:7px; text-align:center;">
            Are you sure you want to delete this Data Plan ?
            
            <p>(${askd2} ${askd3} ${askd4} ${askd5} ${askd6} ${askd7} ${askd8}) ${askd9}<p>
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
        url:"/Controller/Admin/DeleteDataPlan.php",
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
                        document.getElementById("screeno").innerHTML=`<font style="color:green;">Data Plan Deleted</font>`;
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
                            function addDataTypes(){
                                event.preventDefault();
                                let planid = document.getElementById('planid').value;
                                let plantype = document.getElementById("plantype").value;
                                let networkid = document.getElementById("networkid").value;
                                let network = document.getElementById("network").value;
                                let validity = document.getElementById("validity").value;
                                let plan = document.getElementById('plan').value;
                                let planamount = document.getElementById('planamount').value;
                                let status = document.getElementById("status").value;
                                let provider = document.getElementById("provider").value;
                                let currency = document.getElementById("currency").value;
                                let smartearner = document.getElementById("smartearner").value;
                                let topuser = document.getElementById("topuser").value;
                                let reseller = document.getElementById("reseller").value;
                                let affiliate = document.getElementById("affiliate").value;
                                let api = document.getElementById("api").value;
                                let adminEmail = document.getElementById("adminEmail").value;
                                let adminPassw = document.getElementById("adminPassw").value;
                                let planToSend =`adminEmail=${adminEmail}&adminPassw=${adminPassw}&planid=${planid}&plantype=${plantype}&networkid=${networkid}&network=${network}&validity=${validity}&plan=${plan}&planamount=${planamount}&status=${status}&provider=${provider}&currency=${currency}&smartearner=${smartearner}&topuser=${topuser}&reseller=${reseller}&affiliate=${affiliate}&api=${api}`;

                                $.ajax({
                                    url:"/Controller/Admin/AddDataPlan.php",
                                    method:"POST",
                                    dataType:"html",
                                    data:planToSend,
                                    cache:false,
                                    beforeSend:function(){
                                        document.getElementById("btnsub").style.display="none";
                                        document.getElementById("output").innerHTML="Processing";
                                    },
                                    success:function(sty){
                                        console.log(sty);
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