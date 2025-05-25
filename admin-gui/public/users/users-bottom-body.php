<script>
function editDataTypeModal(data1, data2, data3, data4, data5, data6, data7, data8, data9, data10, data11, data12, data13, data14, data15, data16, data17, data18){
    event.preventDefault();
    //Note: once you open the adminmodal, you pass your content into the adminmodalinner
    openAdminModal();
        document.getElementById("adminmodalinner").innerHTML=`
        <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                    <p class="card-description"> Edit User </p>

                        <input type="hidden" id="edittbleid" value="${data1}" />
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editusername" value="${data2}" placeholder="Username">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Full Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editfullname" value="${data3}" placeholder="Full Name">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editemail" value="${data4}" placeholder="Email">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Phone</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editphone" value="${data5}" placeholder="Phone">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Action</label>
                        <div class="col-sm-9">
                            <select id="editaction" name="editaction" class="form-control">
                                <option value="">Choose One Action</option>
                                <option value="verify">Verify</option>
                                <option value="suspend">Suspend</option>
                                <option value="reinstate">Reinstate</option>
                                <option value="delete">Delete</option>
                            </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Admin Email</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editadminemail" placeholder="Admin Email">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Admin Password</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="editadminpassword" placeholder="Admin Password">
                        </div>
                      </div>
                      

                      <span id="savechango">
                        <button type="submit" class="btn btn-primary me-2" onclick="saveChanges()">Save Changes</button>
                      </span>
                  </div>
                </div>
              </div>
        `;
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
            Are you sure you want to delete this User ?
            
            <p>(${askd2} <br/> ${askd3} <br/> ${askd4} <br/> ${askd5} <br/> ${askd6})<p>
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
        url:"/Controller/Admin/DeleteUser.php",
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
  function saveChanges(){
    event.preventDefault();
    let edittableid = document.getElementById("edittbleid").value;
    let editusername = document.getElementById("editusername").value;
    let editfullname = document.getElementById("editfullname").value;
    let editemail = document.getElementById("editemail").value;
    let editphone = document.getElementById("editphone").value;
    let editcountry = document.getElementById("editcountry").value;
    let editstatus = document.getElementById("editstatus").value;
    let editotpverify = document.getElementById("editotpverify").value;
    let editaccounttype = document.getElementById("editaccounttype").value;
    let editapikey = document.getElementById("editapikey").value;
    let dataSaveChange =`id=${edittableid}&username=${editusername}&fullname=${editfullname}&email=${editemail}&phone=${editphone}&country=${editcountry}&status=${editstatus}&otpverify=${editotpverify}&accounttype=${editaccounttype}&apikey=${editapikey}`;
    $.ajax({
        url:"/Controller/Admin/UpdateUser.php",
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
</script>
