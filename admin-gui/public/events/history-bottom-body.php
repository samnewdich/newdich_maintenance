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