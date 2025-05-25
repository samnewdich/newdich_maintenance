<?php
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/head.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/left.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/public/api/api-top-body.php");
?>




                  <div class="tab-content tab-content-basic">
                    <h3>API Providers</h3>
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <!--<div class="statistics-details d-flex align-items-center justify-content-between" style="display:flex; flex-wrap:wrap;">-->
                         
                          <?php
                          include($_SERVER["DOCUMENT_ROOT"]."/Api_Provider/Query/QApiProvider.php");
                          $allAirtime = json_decode($newQApiProvider->getAllApIProviders(), true);
                          
                          if($allAirtime["statusret"] =="success"){
                            $thePlans = $allAirtime["data"];
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-striped">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th class="tdscroll">Provider</th>';
                            echo '<th class="tdscroll">API Key</th>';
                            echo '<th class="tdscroll">Public Key</th>';
                            echo '<th class="tdscroll">Secret Key</th>';
                            echo '<th class="tdscroll">Token</th>';
                            echo '<th class="tdscroll">Status</th>';
                            echo '<th class="tdscroll">Airtime Available ?</th>';
                            echo '<th class="tdscroll">Data Available ?</th>';
                            echo '<th class="tdscroll">Cable Available ?</th>';
                            echo '<th class="tdscroll">Electric Available ?</th>';
                            echo '<th class="tdscroll">Result Available ?</th>';
                            echo '<th class="tdscroll">Bulk SMS Available ?</th>';
                            echo '</tr>';
                            echo '</thead>';
                            for($i = 0; $i < count($thePlans); $i++){
                                $plan = $thePlans[$i];

                                $jsArgs = [
                                    json_encode($plan["tableId"]),
                                    json_encode($plan["provider"]),
                                    json_encode($plan["providerApiKey"]),
                                    json_encode($plan["providerPublicKey"]),
                                    json_encode($plan["providerSecretKey"]),
                                    json_encode($plan["providerToken"]),
                                    json_encode($plan["status"]),
                                    json_encode($plan["airtimeAvailable"]),
                                    json_encode($plan["dataAvailable"]),
                                    json_encode($plan["cableAvailable"]),
                                    json_encode($plan["electricityAvailable"]),
                                    json_encode($plan["result_available"]),
                                    json_encode($plan["bulkSmsAvailable"])
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
                                
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["provider"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["providerApiKey"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["providerPublicKey"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["providerSecretKey"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["providerToken"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["status"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["airtimeAvailable"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["dataAvailable"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["cableAvailable"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["electricityAvailable"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["result_available"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["bulkSmsAvailable"]) . '</td>';
                                echo '</tr>';
                            }
                            echo '</table>';
                            echo '</div>';
                          }
                          else{
                            echo $allAirtime["reason"];
                            echo '<br />';
                            echo 'This means no API Provider is found. <br />';
                          }
                          ?>

                          <hr />
                          <div class="col-12 grid-margin stretch-card">
                           <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Add API Provider</h4>
                            <p class="card-description"> Add API Provider</p>
                            <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">Provider(e.g newdichapi)</label>
                                <input type="text" id="provider" name="provider" placeholder="e.g newdichapi" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Provider API Key(optional)</label>
                                <input type="text" id="providerapikey" name="providerapikey" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">Provider Public Key(optional)</label>
                                <input type="text" id="providerpublickey" name="providerpublickey" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Provider Secret Key(optional)</label>
                                <input type="text" id="providersecretkey" name="providersecretkey" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Provider Token(optional)</label>
                                <input type="text" id="providertoken" name="providertoken" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="on">ON</option>
                                    <option value="off">OFF</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Is Airtime Available ?</label>
                                <select id="airtimeavailable" name="airtimeavailable" class="form-control">
                                    <option value="on">ON</option>
                                    <option value="off">OFF</option>
                                </select>
                            </div>



                            <div class="form-group">
                                <label for="exampleInputName1">Is Data Available ?</label>
                                <select id="dataavailable" name="dataavailable" class="form-control">
                                    <option value="on">ON</option>
                                    <option value="off">OFF</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Is Cable Available ?</label>
                                <select id="cableavailable" name="cableavailable" class="form-control">
                                    <option value="on">ON</option>
                                    <option value="off">OFF</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Is Electricity Available ?</label>
                                <select id="electricityavailable" name="electricityavailable" class="form-control">
                                    <option value="on">ON</option>
                                    <option value="off">OFF</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Is Result Available ?</label>
                                <select id="resultavailable" name="resultavailable" class="form-control">
                                    <option value="on">ON</option>
                                    <option value="off">OFF</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Is Bulk SMS Available ?</label>
                                <select id="bulksmsavailable" name="bulksmsavailable" class="form-control">
                                    <option value="on">ON</option>
                                    <option value="off">OFF</option>
                                </select>
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
function editDataTypeModal(data1, data2, data3, data4, data5, data6, data7, data8, data9, data10, data11, data12, data13){
    event.preventDefault();
    //Note: once you open the adminmodal, you pass your content into the adminmodalinner
    openAdminModal();
        document.getElementById("adminmodalinner").innerHTML=`
        <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit API Provider</h4>
                    <p class="card-description"> Edit API Provider </p>
                    <form class="forms-sample">
                        <input type="hidden" id="edittbleid" value="${data1}" />
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Provider</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editprovider" value="${data2}" placeholder="e.g newdichapi">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">API Key(optional)</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editproviderapikey" value="${data3}">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Public Key(optional)</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editproviderpublickey" value="${data4}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Secret Key(optional)</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editprovidersecretkey" value="${data5}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">API Token(optional)</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editprovidertoken" value="${data6}">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="editstatus">
                                <option value="${data7}">${data7}</option>
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Is Airtime Available ?</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="editairtimeavailable">
                                <option value="${data8}">${data8}</option>
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Is Data Available ?</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="editdataavailable">
                                <option value="${data9}">${data9}</option>
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Is Cable Available ?</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="editcableavailable">
                                <option value="${data10}">${data10}</option>
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Is Electricity Available ?</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="editelectricityavailable">
                                <option value="${data11}">${data11}</option>
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Is Result Available ?</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="editresultavailable">
                                <option value="${data12}">${data12}</option>
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Is Bulk SMS Available ?</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="editbulksmsavailable">
                                <option value="${data13}">${data13}</option>
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>
                        </div>
                      </div>


                      <span id="savechango">
                        <button type="submit" class="btn btn-primary me-2" onclick="saveChanges()">Save Changes</button>
                        <button class="btn btn-light" onclick="askBeforeAction('${data1}','${data2}')">Delete API</button>
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
    let editprovider = document.getElementById("editprovider").value;
    let editproviderapikey = document.getElementById("editproviderapikey").value;
    let editproviderpublickey = document.getElementById("editproviderpublickey").value;
    let editprovidersecretkey = document.getElementById("editprovidersecretkey").value;
    let editprovidertoken = document.getElementById("editprovidertoken").value;
    let editstatus = document.getElementById("editstatus").value;
    let editairtimeavailable = document.getElementById("editairtimeavailable").value;
    let editdataavailable = document.getElementById("editdataavailable").value;
    let editcableavailable = document.getElementById("editcableavailable").value;
    let editelectricityavailable = document.getElementById("editelectricityavailable").value;
    let editresultavailable = document.getElementById("editresultavailable").value;
    let editbulksmsavailable = document.getElementById("editbulksmsavailable").value;
    
    let dataSaveChange =`id=${edittableid}&provider=${editprovider}&providerapikey=${editproviderapikey}&providerpublickey=${editproviderpublickey}&providersecretkey=${editprovidersecretkey}&providertoken=${editprovidertoken}&status=${editstatus}&airtimeavailable=${editairtimeavailable}&dataavailable=${editdataavailable}&cableavailable=${editcableavailable}&electricityavailable=${editelectricityavailable}&resultavailable=${editresultavailable}&bulksmsavailable=${editbulksmsavailable}`;
    $.ajax({
        url:"/Controller/Admin/UpdateApiProvider.php",
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




function askBeforeAction(askd1, askd2){
    event.preventDefault();
    //firstly close the modal
    closeAdminModal();
    //then open the modal
    openAdminModal();
    //then pass contemt to the inner modal.
    document.getElementById("adminmodalinner").innerHTML=`
        <div style="padding:7px; text-align:center;">
            Are you sure you want to delete this API ?
            <p>(${askd2})<p>
            <em style="font-weight:bolder; color:red; font-size:14px;">Note: This will also delete all Data Types, Data Plans, Airtime Plans, Cable and every other services connected to this API.</em><br />
                <span id="screeno">
                <button onclick="deletePlan('${askd1}','${askd2}')" style="background-color:red; color:white; cursor:pointer; height:35px;">Yes Delete</button> 
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button onclick="closeAdminModal()" style="background-color:royalblue; color:white; cursor:pointer; height:35px;">Cancel</button>
                </span>
            </p>
        </div>
    `;
}


function deletePlan(dataToDelete, provider){
    event.preventDefault();
    let dataDel =`data=${dataToDelete}&provider=${provider}`;
    $.ajax({
        url:"/Controller/Admin/DeleteApiProvider.php",
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
                        document.getElementById("screeno").innerHTML=`<font style="color:green;">API Provider Deleted</font>`;
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
                                let provider = document.getElementById("provider").value;
                                let providerapikey = document.getElementById("providerapikey").value;
                                let providerpublickey = document.getElementById("providerpublickey").value;
                                let providersecretkey = document.getElementById("providersecretkey").value;
                                let providertoken = document.getElementById("providertoken").value;
                                let status = document.getElementById("status").value;
                                let airtimeavailable = document.getElementById("airtimeavailable").value;
                                let dataavailable = document.getElementById("dataavailable").value;
                                let cableavailable = document.getElementById("cableavailable").value;
                                let electricityavailable = document.getElementById("electricityavailable").value;
                                let resultavailable = document.getElementById("resultavailable").value;
                                let bulksmsavailable = document.getElementById("bulksmsavailable").value;

                                let adminEmail = document.getElementById("adminEmail").value;
                                let adminPassw = document.getElementById("adminPassw").value;
                                let planToSend =`adminEmail=${adminEmail}&adminPassw=${adminPassw}&provider=${provider}&providerapikey=${providerapikey}&providerpublickey=${providerpublickey}&providersecretkey=${providersecretkey}&providertoken=${providertoken}&status=${status}&airtimeavailable=${airtimeavailable}&dataavailable=${dataavailable}&cableavailable=${cableavailable}&electricityavailable=${electricityavailable}&resultavailable=${resultavailable}&bulksmsavailable=${bulksmsavailable}`;
                                $.ajax({
                                    url:"/Controller/Admin/AddApiProvider.php",
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