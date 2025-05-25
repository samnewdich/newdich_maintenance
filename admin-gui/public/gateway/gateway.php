<?php
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/head.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/left.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/public/gateway/gateway-top-body.php");
?>




                  <div class="tab-content tab-content-basic">
                    <h3>All Gateways</h3>
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <!--<div class="statistics-details d-flex align-items-center justify-content-between" style="display:flex; flex-wrap:wrap;">-->
                         
                          <?php
                          include($_SERVER["DOCUMENT_ROOT"]."/Gateway/Query/QGateway.php");
                          $allAirtime = json_decode($newQGateway->getAllGateways(), true);
    

                          if($allAirtime["statusret"] =="success"){
                            $thePlans = $allAirtime["data"];
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-striped">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th class="tdscroll">Provider</th>';
                            echo '<th class="tdscroll">API Key</th>';
                            echo '<th class="tdscroll">Secret Key</th>';
                            echo '<th class="tdscroll">Token</th>';
                            echo '<th class="tdscroll">Fee(%)</th>';
                            echo '<th class="tdscroll">Fee(Currency)</th>';
                            echo '<th class="tdscroll">Status</th>';
                            echo '<th class="tdscroll">Contract Code</th>';
                            echo '</tr>';
                            echo '</thead>';
                            for($i = 0; $i < count($thePlans); $i++){
                                $plan = $thePlans[$i];

                                $jsArgs = [
                                    json_encode($plan["tableId"]),
                                    json_encode($plan["provider"]),
                                    json_encode($plan["apiKey"]),
                                    json_encode($plan["secretKey"]),
                                    json_encode($plan["token"]),
                                    json_encode($plan["feePercentage"]),
                                    json_encode($plan["fee"]),
                                    json_encode($plan["status"]),
                                    json_encode($plan["contractCode"]),
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
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["apiKey"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["secretKey"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["token"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["feePercentage"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["fee"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["status"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["contractCode"]) . '</td>';
                                echo '</tr>';
                            }
                            echo '</table>';
                            echo '</div>';
                          }
                          else{
                            echo $allAirtime["reason"];
                            echo '<br />';
                            echo 'This means no Gateway is found. <br />';
                          }
                          ?>

                          <hr />
                          <div class="col-12 grid-margin stretch-card">
                           <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Add Payment Gateway</h4>
                            <p class="card-description"> Add Payment Gateway</p>
                            <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">Provider(e.g paystack)</label>
                                <input type="text" id="provider" name="provider" placeholder="e.g paystack" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputName1">API Key(optional)</label>
                                <input type="text" id="apikey" name="apikey" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Secret Key(optional)</label>
                                <input type="text" id="secretkey" name="secretkey" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Token(optional)</label>
                                <input type="text" id="token" name="token" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="exampleInputName1">Fee(%)(optional)</label>
                                <input type="text" id="feepercentage" name="feepercentage" class="form-control">
                            </div>



                            <div class="form-group">
                                <label for="exampleInputName1">Fee(Currency)(optional)</label>
                                <input type="text" id="fee" name="fee" class="form-control">
                            </div>



                            <div class="form-group">
                                <label for="exampleInputName1">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="on">ON</option>
                                    <option value="off">OFF</option>
                                </select>
                            </div>
                            


                            <div class="form-group">
                                <label for="exampleInputName1">Contract Code(optional)</label>
                                <input type="text" id="contractcode" name="contractcode" class="form-control">
                            </div>

                    

                            
                            <div style="padding:10px;" id="btnsub">
                                <button onclick="addDataTypes()" style="width:350px; height:35px; border:none; border-radius:10px; background-color:royalblue; color:white; cursor:pointer;">Add Gateway</button>
                            </div>

                            <div style="padding:10px; text-align:center;" id="output"></div>
                            
                            </form>
                            </div>
                        </div>
                        </div>
                        

<script>
function editDataTypeModal(data1, data2, data3, data4, data5, data6, data7, data8, data9){
    event.preventDefault();
    //Note: once you open the adminmodal, you pass your content into the adminmodalinner
    openAdminModal();
        document.getElementById("adminmodalinner").innerHTML=`
        <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Gateway</h4>
                    <p class="card-description"> Edit Gateway </p>
                    <form class="forms-sample">
                        <input type="hidden" id="edittbleid" value="${data1}" />
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Provider</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editprovider" value="${data2}" placeholder="e.g paystack">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">API Key(optional)</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editapikey" value="${data3}">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Secret Key(optional)</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editsecretkey" value="${data4}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Token(optional)</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="edittoken" value="${data5}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Fee(%)(optional)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editfeepercentage" value="${data6}">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Fee(Currency)(optional)</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="editfee" value="${data7}">
                        </div>
                      </div>


                      <div class="form-group row">
                            <label for="exampleInputUsername2">Status</label>
                            <select id="editstatus" name="editstatus" class="form-control">
                                <option value="${data8}">${data8}</option>
                                <option value="on">ON</option>
                                <option value="off">OFF</option>
                            </select>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Contract Code(optional)</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editcontractcode" value="${data9}">
                        </div>
                      </div>




                      <span id="savechango">
                        <button type="submit" class="btn btn-primary me-2" onclick="saveChanges()">Save Changes</button>
                        <button class="btn btn-light" onclick="askBeforeAction('${data1}','${data2}')">Delete Gateway</button>
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
    let editapikey = document.getElementById("editapikey").value;
    let editsecretkey = document.getElementById("editsecretkey").value;
    let edittoken = document.getElementById("edittoken").value;
    let editfeepercentage = document.getElementById("editfeepercentage").value;
    let editfee = document.getElementById("editfee").value;
    let editstatus = document.getElementById("editstatus").value;
    let editcontractcode = document.getElementById("editcontractcode").value;
    
    let dataSaveChange =`id=${edittableid}&provider=${editprovider}&apikey=${editapikey}&secretkey=${editsecretkey}&token=${edittoken}&feepercentage=${editfeepercentage}&fee=${editfee}&status=${editstatus}&contractcode=${editcontractcode}`;
    $.ajax({
        url:"/Controller/Admin/UpdateGateway.php",
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
            Are you sure you want to delete this Gateway ?
            <p>(${askd2})<p>
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
        url:"/Controller/Admin/DeleteGateway.php",
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
                        document.getElementById("screeno").innerHTML=`<font style="color:green;">Gateway Deleted</font>`;
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
                                let apikey = document.getElementById("apikey").value;
                                let secretkey = document.getElementById("secretkey").value;
                                let token = document.getElementById("token").value;
                                let feepercentage = document.getElementById("feepercentage").value;
                                let fee = document.getElementById("fee").value;
                                let status = document.getElementById("status").value;
                                let contractcode = document.getElementById("contractcode").value;
                                let planToSend =`provider=${provider}&apikey=${apikey}&secretkey=${secretkey}&token=${token}&feepercentage=${feepercentage}&fee=${fee}&status=${status}&contractcode=${contractcode}`;
                                $.ajax({
                                    url:"/Controller/Admin/AddGateway.php",
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