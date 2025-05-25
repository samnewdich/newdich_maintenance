<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Area </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/admin-gui/ui/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="/admin-gui/ui/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/admin-gui/ui/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/admin-gui/ui/assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/admin-gui/ui/assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="/admin-gui/ui/assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="/admin-gui/ui/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/admin-gui/ui/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="/admin-gui/ui/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="/admin-gui/ui/assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/admin-gui/ui/assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/public/favicon.png" />
    <script src="/public/jquery.js"></script>
    <style>
      .tablescroll{
        overflow-x:auto; 
        display:block; 
        white-space: nowrap;
        border-collapse: collapse;
        width: 100%; /* Optional if you want full width */
      }

      .tdscroll{
        width: 150px; /* Set a fixed width for all cells */
        text-align: left;
        padding: 8px;
        border: 1px solid #ccc;
        box-sizing: border-box;
      }

      #adminmodal{
        position: fixed;
        top:0;
        left:0;
        width:100%;
        height:100%;
        background-color:white;
        opacity:1.0;
        z-index:2000;
        display:none;
        overflow:auto;
      }

      #adminmodalinner{
        width:95%;
        margin-left:2.5%;
        box-shadow:2px 3px 6px 4px rgba(0,0,0,0.5);
        min-height:100%;
        background-color:white;
      }

      #adminmodalbtndiv{
        width:95%;
        margin-left:2.5%;
        box-shadow:3px 4px 8px 6px rgba(0,0,0,0.5);
        background-color:white;
        margin-bottom:2px;
      }

      #adminmodalbtn{
        margin-left:95%;
        max-height:50px;
        max-width:60px;
        background-color:red;
        color:white;
        border:none;
        cursor:pointer;
      }
    </style>

    <script>
      function closeAdminModal(){
        document.getElementById("adminmodal").style.display="none";
      }

      function openAdminModal(){
        document.getElementById("adminmodal").style.display="block";
      }
    </script>

<script>
    const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    document.cookie = "user_timezone=" + userTimezone + "; path=/";
</script>

  </head>
  <body class="with-welcome-text">

<!--SET MODAL-->
<div id="adminmodal">
    <div id="adminmodalbtndiv">
        <button id="adminmodalbtn" onclick="closeAdminModal()">X</button>
    </div>
    <div id="adminmodalinner"></div>
</div>

    <div class="container-scroller">
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <div>
            <a class="navbar-brand brand-logo" href="/">
              <img src="/public/logo.png" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="/">
              <img src="/public/logo.png" alt="logo" />
            </a>
          </div>
      </nav>

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
















        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
                

            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Admin Login</h4>
                    <p class="card-description"> Login to Admin Panel </p>
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputName1">Admin Email</label>
                        <input type="text" class="form-control" id="admin_email" placeholder="Admin Email">
                      </div>
                      <div class="form-group">
                        <table style="width:100%;">
                            <tr style="width:100%;">
                                <td style="width:90%;">
                                    <label for="exampleInputEmail3">Admin Password</label>
                                </td>
                                <td style="width:10%;">
                                    <span id="show" onclick="showPassword()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>
                                    </span>
                                    <span id="hide" style="display:none;" onclick="hidePassword()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                        <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z"/>
                                        <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829"/>
                                        <path d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z"/>
                                        </svg>
                                    </span>
                                </td>
                            </tr>
                        </table>
                        <input type="password" class="form-control" id="admin_password" placeholder="Admin Password">
                      </div>
                      <p id="output">
                        <button onclick="modifyUser()" type="submit" class="btn btn-primary me-2">Login</button>
                      </p>
                    </form>
                  </div>
                </div>
              </div>

<script>
    function adminLogin(){
        let adminEmail = document.getElementById("admin_email").value;
        let adminPassword = document.getElementById("admin_password").value;
        let admindet =`adminEmail=${adminEmail}&adminPassword=${adminPassword}`;
        $.ajax({
            url:"",
            method:"POST",
            dataType:"html",
            data:admindet,
            cache:false,
            beforeSend:function(){
                document.getElementById("output").innerHTML=`<font style="color:royalblue; font-size:12px;">Loading..</font>`;
            },
            success:function(res){
                try{
                    if(res !==undefined && res !==null && res !=='' && res !=''){
                        let response = JSON.parse(res);
                        if(response.statusret ==="success"){
                            //get data
                            document.getElementById("output").innerHTML=`<font style="color:green; font-size:12px;">Successful</font>`;
                        }
                        else{
                            document.getElementById("output").innerHTML=`<font style="color:red; font-size:12px;">${response.reason}</font>`;
                        }
                    }
                    else{
                        document.getElementById("output").innerHTML=`<font style="color:red; font-size:12px;">Oops!! Something went wrong</font>`;
                    }
                }
                catch(errty){
                    console.error(errty.message);
                }
            }
        });
    }

    function showPassword(){
        document.getElementById("admin_password").type="text";
        document.getElementById('show').style.display="none";
        document.getElementById('hide').style.display="inline-block";
    }

    function hidePassword(){
        document.getElementById("admin_password").type="password";
        document.getElementById('show').style.display="inline-block";
        document.getElementById('hide').style.display="none";
    }
</script>
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







</div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/admin-gui/ui/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="/admin-gui/ui/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/admin-gui/ui/assets/vendors/chart.js/chart.umd.js"></script>
    <script src="/admin-gui/ui/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/admin-gui/ui/assets/js/off-canvas.js"></script>
    <script src="/admin-gui/ui/assets/js/template.js"></script>
    <script src="/admin-gui/ui/assets/js/settings.js"></script>
    <script src="/admin-gui/ui/assets/js/hoverable-collapse.js"></script>
    <script src="/admin-gui/ui/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/admin-gui/ui/assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="/admin-gui/ui/assets/js/dashboard.js"></script>
    <!-- <script src="assets/js/Chart.roundedBarCharts.js"></script> -->
    <!-- End custom js for this page-->
  </body>
</html>
