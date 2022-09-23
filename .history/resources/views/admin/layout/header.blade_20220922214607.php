<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>Admin</title>
<!-- Favicons -->
<link href="/webapp/assets/img/favicon.png" rel="icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/admin-assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/admin-assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/admin-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/admin-assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="/admin-assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/admin-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
   <!-- Bootstrap4 Duallistbox -->
   <link rel="stylesheet" href="/admin-assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="/admin-assets/plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="/admin-assets/plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/admin-assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/admin-assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="/admin-assets/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="/admin-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="/admin-assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
   
  <!-- DataTables -->
  <link rel="stylesheet" href="/admin-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin-assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style type="text/css">
    /*Now the CSS Created by R.S*/
      .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #3498db !important;
    border: 1px solid #3498db !important;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 5px;
  }
  .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
      color: #fff !important;
  }
* {margin: 0; padding: 0;}

.tree ul {
    padding-top: 20px; position: relative;
  
  transition: all 0.5s;
  -webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
}

.tree li {
  float: left; text-align: center;
  list-style-type: none;
  position: relative;
  padding: 20px 5px 0 5px;
  
  transition: all 0.5s;
  -webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
  content: '';
  position: absolute; top: 0; right: 50%;
  border-top: 1px solid #ccc;
  width: 50%; height: 20px;
}
.tree li::after{
  right: auto; left: 50%;
  border-left: 1px solid #ccc;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
  display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
  border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
  border-right: 1px solid #ccc;
  border-radius: 0 5px 0 0;
  -webkit-border-radius: 0 5px 0 0;
  -moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
  border-radius: 5px 0 0 0;
  -webkit-border-radius: 5px 0 0 0;
  -moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
  content: '';
  position: absolute; top: 0; left: 50%;
  border-left: 1px solid #ccc;
  width: 0; height: 20px;
}

.tree li a{
  border: 1px solid #ccc;
  padding: 5px 10px;
  text-decoration: none;
  color: #666;
  font-family: arial, verdana, tahoma;
  font-size: 11px;
  display: inline-block;
  
  border-radius: 5px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  
  transition: all 0.5s;
  -webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
  background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
  border-color:  #94a0b4;
}
    @media screen and (min-width : 0px) and (max-width : 767px){
        
        
    .tree li{
        padding:0;
    }
    .tree li a {
        border: 1px solid #ccc;
        /* padding: 5px 10px; */
        text-decoration: none;
        color: #666;
        font-family: arial, verdana, tahoma;
        font-size: 11px;
        display: initial;
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }
    .tree li a img{
            height: 30px !important;
            width: 25px !important;
    }
    }


.panel {
    border: none;
    box-shadow: none;
    background-color: #f1f2f7;

}

.panel-heading {
    border-color:#eff2f7 ;
    font-size: 16px;
    font-weight: 300;
}

.panel-title {
    color: #2A3542;
    font-size: 14px;
    font-weight: 400;
    margin-bottom: 0;
    margin-top: 0;
    font-family: 'Open Sans', sans-serif;
}

/*product list*/

.prod-cat li a{
    border-bottom: 1px dashed #d9d9d9;
}

.prod-cat li a {
    color: #3b3b3b;
}

.prod-cat li ul {
    margin-left: 30px;
}

.prod-cat li ul li a{
    border-bottom:none;
}
.prod-cat li ul li a:hover,.prod-cat li ul li a:focus, .prod-cat li ul li.active a , .prod-cat li a:hover,.prod-cat li a:focus, .prod-cat li a.active{
    background: none;
    color: #ff7261;
}

.pro-lab{
    margin-right: 20px;
    font-weight: normal;
}

.pro-sort {
    padding-right: 20px;
    float: left;
}

.pro-page-list {
    margin: 5px 0 0 0;
}

.product-list img{
    width: 100%;
    border-radius: 4px 4px 0 0;
    -webkit-border-radius: 4px 4px 0 0;
}

.product-list .pro-img-box {
    position: relative;
}
.adtocart {
    background: #fc5959;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    color: #fff;
    display: inline-block;
    text-align: center;
    border: 3px solid #fff;
    left: 45%;
    bottom: -25px;
    position: absolute;
}

.adtocart i{
    color: #fff;
    font-size: 25px;
    line-height: 42px;
}

.pro-title {
    color: #5A5A5A;
    display: inline-block;
    margin-top: 20px;
    font-size: 16px;
}

.product-list .price {
    color:#fc5959 ;
    font-size: 15px;
}

.pro-img-details {
    margin-left: -15px;
}

.pro-img-details img {
    width: 100%;
}

.pro-d-title {
    font-size: 16px;
    margin-top: 0;
}

.product_meta {
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    padding: 10px 0;
    margin: 15px 0;
}

.product_meta span {
    display: block;
    margin-bottom: 10px;
}
.product_meta a, .pro-price{
    color:#fc5959 ;
}

.pro-price, .amount-old {
    font-size: 18px;
    padding: 0 10px;
}

.amount-old {
    text-decoration: line-through;
}
/* 
.quantity {
    width: 120px;
} */

.pro-img-list {
    margin: 10px 0 0 -15px;
    width: 100%;
    display: inline-block;
}

.pro-img-list a {
    float: left;
    margin-right: 10px;
    margin-bottom: 10px;
}

.pro-d-head {
    font-size: 18px;
    font-weight: 300;
}

.pro-qty {
    width: 90px;
    height: 40px;
    border: 1px solid #ddd;
    padding: 0 15px;
    float: left;
}
table tr .pro-qty .qtybtn {
    width: 15px;
    display: block;
    float: left;
    line-height: 38px;
    cursor: pointer;
    text-align: center;
    font-size: 22px;
    font-weight: 400;
    color: #555555;
}

table tr .pro-qty input {
    width: 28px;
    float: left;
    border: none;
    height: 40px;
    line-height: 34px;
    padding: 0;
    text-align: center;
    background-color: transparent;
}
table tr .pro-qty .qtybtn {
    width: 15px;
    display: block;
    float: left;
    line-height: 38px;
    cursor: pointer;
    text-align: center;
    font-size: 22px;
    font-weight: 400;
    color: #555555;
}
.tree:hover {
  -ms-transform: scale(1.5); /* IE 9 */
  -webkit-transform: scale(1.5); /* Safari 3-8 */
  transform: scale(1.5); 
}
a{
  cursor: pointer;
}
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/admin/edituser/{{$_SESSION['userid']}}" class="nav-link">My Profile</a>
      </li>
     
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" target="_blank" class="nav-link">Go to Website</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a onClick="window.location.reload();" style="cursor:pointer;" class="nav-link"><i class="ion ion-refresh"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          ({{ucwords($_SESSION['username'])}})
        </a>
      </li>
      <!-- <li class="nav-item dropdown"> -->
        
        <!--<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">-->
        <!--  <span class="dropdown-item dropdown-header">15 Notifications</span>-->
        <!--  <div class="dropdown-divider"></div>-->
        <!--  <a href="#" class="dropdown-item">-->
        <!--    <i class="fas fa-envelope mr-2"></i> 4 new messages-->
        <!--    <span class="float-right text-muted text-sm">3 mins</span>-->
        <!--  </a>-->
        <!--  <div class="dropdown-divider"></div>-->
        <!--  <a href="#" class="dropdown-item">-->
        <!--    <i class="fas fa-users mr-2"></i> 8 friend requests-->
        <!--    <span class="float-right text-muted text-sm">12 hours</span>-->
        <!--  </a>-->
        <!--  <div class="dropdown-divider"></div>-->
        <!--  <a href="#" class="dropdown-item">-->
        <!--    <i class="fas fa-file mr-2"></i> 3 new reports-->
        <!--    <span class="float-right text-muted text-sm">2 days</span>-->
        <!--  </a>-->
        <!--  <div class="dropdown-divider"></div>-->
        <!--  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>-->
        <!--</div>-->
      <!-- </li> -->
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="/admin/logout" role="button">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <!-- <img src="/webapp/logo.jpeg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width:140px; height:50px;"> -->
      <span class="brand-text font-weight-light">Clinic24  ({{ucwords($_SESSION['username'])}} Panel)</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/admin-assets/images/default.jpg" class="img-circle elevation-2" alt="Admin Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{$_SESSION['username']}} 
          </a>
        </div>
        
      </div>
      
      <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel pb-3 mb-3">
       
      </div> -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link {{Request::is('admin/dashboard')?'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
               <!--  <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
           
          </li>
          @if($_SESSION['username'])
          <li class="nav-item">
            <a href="/doctors" class="nav-link {{Request::is('doctors')?'active' : '' }}">
              <i class="nav-icon fas fa-user-md"></i>
              <p>
                Doctors
               <!--  <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
           
          </li>
          @endif
          <li class="nav-item">
            <a href="/patients" class="nav-link {{Request::is('patients')?'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
              Patients
               <!--  <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
           
          </li>
          <li class="nav-item">
            <a href="/appointments" class="nav-link {{Request::is('appointments')?'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>
              Appointments
               <!--  <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
           
          </li>
          
          <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
               <!--  <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>