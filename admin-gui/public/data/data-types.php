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
                          $allAirtime = json_decode($newQData->getAllDataTypes(), true);
                          
                          if($allAirtime["statusret"] =="success"){
                            $thePlans = $allAirtime["data"];
                            echo '<div class="table-responsive">';
                            echo '<table class="table table-striped">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th class="tdscroll">Data Type Name</th>';
                            echo '<th class="tdscroll">Data Type Network</th>';
                            echo '<th class="tdscroll">Currency</th>';
                            echo '<th class="tdscroll">Status</th>';
                            echo '</tr>';
                            echo '</thead>';
                            for($i = 0; $i < count($thePlans); $i++){
                                $plan = $thePlans[$i];

                                $jsArgs = [
                                    json_encode($plan["id"]),
                                    json_encode($plan["dataTypeName"]),
                                    json_encode($plan["dataTypeNetwork"]),
                                    json_encode($plan["currency"]),
                                    json_encode($plan["status"])
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
                                
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["dataTypeName"]) . '</td>';
                                echo '<td class="tdscroll">' . htmlspecialchars($plan["dataTypeNetwork"]) . '</td>';
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
                            echo 'This means no Data type is found. <br />';
                          }
                          ?>

                          <hr />
                          <div class="col-12 grid-margin stretch-card">
                           <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">Add Data Types</h4>
                            <p class="card-description"> Add Data Types</p>
                            <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputName1">Data Type Name(e.g Corporate Gifting)</label>
                                <input type="text" id="data_type_name" name="data_type_name" placeholder="e.g corporate gifting" class="form-control">
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
function editDataTypeModal(data1, data2, data3, data4, data5){
    event.preventDefault();
    //Note: once you open the adminmodal, you pass your content into the adminmodalinner
    openAdminModal();
        document.getElementById("adminmodalinner").innerHTML=`
        <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Data Type</h4>
                    <p class="card-description"> Edit Data Type </p>
                    <form class="forms-sample">
                        <input type="hidden" id="edittbleid" value="${data1}" />
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Data Type Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editdatatypename" value="${data2}" placeholder="Data Type Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Network</label>
                        <div class="col-sm-9">
                            <select id="editdatatypenetwork" name="editdatatypenetwork" class="form-control">
                                <option value="${data3}">${data3}</option>
                                <option value="9mobile">9Mobile</option>
                                <option value="airtel">Airtel</option>
                                <option value="glo">GLO</option>
                                <option value="mtn">MTN</option>
                            </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Currency</label>
                        <div class="col-sm-9">
                          <select class="form-control" id="editcurrency">
                                <option value="${data4}">${data4}</option>
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
                                <option value="${data5}">${data5}</option>
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>
                        </div>
                      </div>

                      <span id="savechango">
                        <button type="submit" class="btn btn-primary me-2" onclick="saveChanges()">Save Changes</button>
                        <button class="btn btn-light" onclick="askBeforeAction('${data1}','${data2}','${data3}','${data4}','${data5}')">Delete Data Type</button>
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
    let editdatatypename = document.getElementById("editdatatypename").value;
    let editdatatypenetwork = document.getElementById("editdatatypenetwork").value;
    let editcurrency = document.getElementById("editcurrency").value;
    let editstatus = document.getElementById("editstatus").value;
    let dataSaveChange =`id=${edittableid}&network=${editdatatypenetwork}&datatypename=${editdatatypename}&currency=${editcurrency}&status=${editstatus}`;
    $.ajax({
        url:"/Controller/Admin/UpdateDataType.php",
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
            Are you sure you want to delete this Data Type ?
            
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
        url:"/Controller/Admin/DeleteDataType.php",
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
                        document.getElementById("screeno").innerHTML=`<font style="color:green;">Data Type Deleted</font>`;
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
                                let dataTypeName = document.getElementById('data_type_name').value;
                                let network = document.getElementById("network").value;
                                let currency = document.getElementById("currency").value;
                                let status = document.getElementById("status").value;
                                let adminEmail = document.getElementById("adminEmail").value;
                                let adminPassw = document.getElementById("adminPassw").value;
                                let planToSend =`adminEmail=${adminEmail}&adminPassw=${adminPassw}&dataTypeName=${dataTypeName}&network=${network}&currency=${currency}&status=${status}`;
                                $.ajax({
                                    url:"/Controller/Admin/AddDataType.php",
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