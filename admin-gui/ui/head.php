<?php
session_start();
if(!isset($_SESSION["THE_ADMIN_EMAIL"])){
  ?>
  <script>
    window.location="/admin-login";
  </script>
  <?php
  exit();
}
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
          <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
              <span class="icon-menu"></span>
            </button>
          </div>
          <div>
            <a class="navbar-brand brand-logo" href="/">
              <img src="/public/logo.png" alt="logo" />
            </a>
            <a class="navbar-brand brand-logo-mini" href="/">
              <img src="/public/logo.png" alt="logo" />
            </a>
          </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-top">
          <ul class="navbar-nav">
            <li class="nav-item fw-semibold d-none d-lg-block ms-0">
              <h1 class="welcome-text">Welcome Back, <span class="text-black fw-bold">TimoPay</span></h1>
              <h3 class="welcome-sub-text">Your performance summary this week </h3>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item d-none d-lg-block">
              <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                <span class="input-group-addon input-group-prepend border-right">
                  <span class="icon-calendar input-group-text calendar-icon"></span>
                </span>
                <input type="text" class="form-control">
              </div>
            </li>
            <li class="nav-item">
              <form class="search-form" action="#">
                <i class="icon-search"></i>
                <input type="search" class="form-control" placeholder="Search Here" title="Search here">
              </form>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>

      <!-- partial -->
      <div class="container-fluid page-body-wrapper">