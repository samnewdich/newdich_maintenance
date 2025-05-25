<div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences" role="tab" aria-selected="false">Audiences</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics" role="tab" aria-selected="false">Demographics</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab" aria-selected="false">More</a>
                      </li>
                    </ul>
                    <div>
                      <div class="btn-wrapper">
                        <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                        <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                        <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                      </div>
                    </div>
                  </div>
                  <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="statistics-details d-flex align-items-center justify-content-between" style="display:flex; flex-wrap:wrap;">
                            
                            <div style="text-align:center; width:32%; margin:0.3%; padding-top:7px;">
                              <p class="statistics-title">Airtime</p>
                              <h3 class="rate-percentage" id="totalAirtime">32.53%</h3>
                            </div>

                            <div style="text-align:center; width:32%; margin:0.3%; padding-top:7px;">
                              <p class="statistics-title">Data</p>
                              <h3 class="rate-percentage" id="totalData">7,682</h3>
                            </div>

                            <div style="text-align:center; width:32%; margin:0.3%; padding-top:7px;">
                              <p class="statistics-title">Cable/TV</p>
                              <h3 class="rate-percentage" id="totalCable">68.8</h3>
                            </div>
                            
                            <div style="text-align:center; width:32%; margin:0.3%; padding-top:15px;">
                              <p class="statistics-title">Electricity</p>
                              <h3 class="rate-percentage" id="totalElectricity">2m:35s</h3>
                            </div>

                            <div style="text-align:center; width:32%; margin:0.3%; padding-top:15px;">
                              <p class="statistics-title">Results</p>
                              <h3 class="rate-percentage" id="totalResult">68.8</h3>
                            </div>

                            <div style="text-align:center; width:32%; margin:0.3%; padding-top:15px;">
                              <p class="statistics-title">Users</p>
                              <h3 class="rate-percentage" id="totalUser">2m:35s</h3>
                            </div>

                          </div>
                        </div>



                      </div>
                      <div class="row">
                        <div class="col-lg-8 d-flex flex-column">
                          <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                <div class="card-body">
                                  <div class="d-sm-flex justify-content-between align-items-start">
                                    <div>
                                      <h4 class="card-title card-title-dash">Recent Transactions</h4>
                                      <p class="card-subtitle card-subtitle-dash">10 Most Recent Transactions</p>
                                    </div>
                                    <div>
                                      <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i class="mdi mdi-account-plus"></i>All Transactions</button>
                                    </div>
                                  </div>
                                  <div class="table-responsive  mt-1">
                                    <table class="table select-table">
                                      <thead>
                                        <tr>
                                          <th>
                                            <div class="form-check form-check-flat mt-0">
                                              <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" aria-checked="false" id="check-all"><i class="input-helper"></i></label>
                                            </div>
                                          </th>
                                          <th>User</th>
                                          <th>Service</th>
                                          <th>Amount</th>
                                          <th>Status</th>
                                        </tr>
                                      </thead>
                                      <tbody id="recentevent">
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-4 d-flex flex-column">
                          <div class="row flex-grow">
                            <div class="col-12 grid-margin stretch-card">
                              <div class="card card-rounded">
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title card-title-dash">Best Performing Users(Top 10)</h4>
                                        <div class="add-items d-flex mb-0">
                                          <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                                          <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                                        </div>
                                      </div>
                                      <div class="list-wrapper">
                                        <ul class="todo-list todo-list-rounded" id="bestperform">
                                          
                                        </ul>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <div class="row flex-grow">
                          </div>
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


<script src="/admin-gui/ui/useful.js"></script>

<script>
  function dataAll(){
    $.ajax({
      url:"/Controller/Admin/MainData.php",
      method:"GET",
      dataType:"html",
      cache:false,
      success:function(response){
        try{
          if(
            response !== null &&
            response !== undefined && 
            response !==''
          ){
            let res = JSON.parse(response);
            if(res.statusret ==="success"){
              document.getElementById("totalAirtime").innerHTML =`${res.data.totalAirtime}`;
              document.getElementById("totalData").innerHTML =`${res.data.totalData}`;
              document.getElementById("totalCable").innerHTML =`${res.data.totalCable}`;
              document.getElementById("totalElectricity").innerHTML =`${res.data.totalElectricity}`;
              document.getElementById("totalResult").innerHTML =`${res.data.totalResult}`;
              document.getElementById("totalUser").innerHTML =`${res.data.totalUser}`;
            }
          }
        }
        catch(error){
          console.error(error.message);
        }
      }
    });
  }

  //call the function
  dataAll();
</script>




<script>
  function bestPerform(){
    $.ajax({
      url:"/Controller/Admin/BestPerform.php",
      method:"GET",
      dataType:"html",
      cache:false,
      success:function(response){
        console.log(response);
        try{
          if(
            response !== null &&
            response !== undefined && 
            response !==''
          ){
            let res = JSON.parse(response);
            if(res.statusret ==="success"){
              let resdata = res.data;
              let outerm ='';
              for(let i = 0; i < resdata.length; i++){
                let iyini = resdata[i];
                outerm +=`
                <li class="d-block">
                  <div class="form-check w-100">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">${capitalizeString(iyini.userName)} <br/> ${iyini.email} <i class="input-helper rounded"></i>
                    </label>
                    <div class="d-flex mt-2">
                      <div class="ps-4 text-small me-3">${timeToClientZone(iyini.dateCompleted)} <br/>
                        <span class="badge badge-opacity-warning me-3">${iyini.currency}${truncateToTwoDecimals(iyini.totalAmountTransacted)}</span>
                      </div>
                      <i class="mdi mdi-flag ms-2 flag-color"></i>
                    </div>
                  </div>
                </li>
                `;
              }
              document.getElementById("bestperform").innerHTML =`${outerm}`;
            }
          }
        }
        catch(error){
          console.error(error.message);
        }
      }
    });
  }

  //call the function
  setTimeout(bestPerform, 2000);
</script>







<script>
  function recentEvents(){
    $.ajax({
      url:"/Controller/Admin/RecentEvents.php",
      method:"GET",
      dataType:"html",
      cache:false,
      success:function(response){
        console.log(response);
        try{
          if(
            response !== null &&
            response !== undefined && 
            response !==''
          ){
            let res = JSON.parse(response);
            if(res.statusret ==="success"){
              let resdata = res.data;
              let outerm ='';
              for(let i = 0; i < resdata.length; i++){
                let iyini = resdata[i];
                outerm +=`
                <tr>
                  <td>
                    <div class="form-check form-check-flat mt-0">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" aria-checked="false">
                        <i class="input-helper"></i>
                      </label>
                    </div>
                  </td>

                    <td>
                      <div class="d-flex ">
                        <div>
                          <h6>${capitalizeString(iyini.userName)}</h6>
                          <p>${iyini.email}</p>
                        </div>
                      </div>
                    </td>
                    
                    <td>
                      <h6>${capitalizeString(iyini.transactionType)}</h6>
                      <p>${capitalizeString(iyini.transactionStatus)}</p>
                    </td>
                    
                    <td>
                      <h6>${iyini.currency}${truncateToTwoDecimals(iyini.amountTransacted)}</h6>
                      <p>${iyini.currency}${truncateToTwoDecimals(iyini.transactionFee)}</p>
                    </td>
                    
                    <td>
                      ${
                        iyini.transactionStatus ==='success' || iyini.transactionStatus ==='successful' ? 
                        `<div class="badge badge-opacity-success">${capitalizeString(iyini.transactionStatus)}</div>
                        ` :
                        `
                        <div class="badge badge-opacity-danger">${capitalizeString(iyini.transactionStatus)}</div>
                        `
                      }
                    </td>
                  </tr>
                `;
              }
              document.getElementById("recentevent").innerHTML =`${outerm}`;
            }
          }
        }
        catch(error){
          console.error(error.message);
        }
      }
    });
  }

  //call the function
  setTimeout(recentEvents, 1000);
</script>