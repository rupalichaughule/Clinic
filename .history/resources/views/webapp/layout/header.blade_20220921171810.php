<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="html 5 template">
    <meta name="author" content="">
    <title>Clinic</title>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="/webapp-assets/{{$headersdata['headerwebsitedata']->favicon}}">
    <link rel="stylesheet" href="/webapp-assets/css/jquery-ui.css">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Asap:400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="/webapp-assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="/webapp-assets/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Slider Revolution CSS Files -->
    <link rel="stylesheet" href="/webapp-assets/revolution/css/settings.css">
    <link rel="stylesheet" href="/webapp-assets/revolution/css/layers.css">
    <link rel="stylesheet" href="/webapp-assets/revolution/css/navigation.css">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="/webapp-assets/css/search.css">
    <link rel="stylesheet" href="/webapp-assets/css/animate.css">
    <link rel="stylesheet" href="/webapp-assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/webapp-assets/css/lightcase.css">
    <link rel="stylesheet" href="/webapp-assets/css/owl-carousel.css">
    <link rel="stylesheet" href="/webapp-assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/webapp-assets/css/bootstrap.css">
    <link rel="stylesheet" href="/webapp-assets/css/slick.css">
    
    <link rel="stylesheet" href="/webapp-assets/css/styles.css">
    <link rel="stylesheet" href="/webapp-assets/css/maps.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" id="color" href="/webapp-assets/css/default.css">
    <!-- Carausel -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="/admin-assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/admin-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	
	 <!-- daterange picker -->
  <link rel="stylesheet" href="/admin-assets/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="/admin-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
 
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/admin-assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
 
	
    <link rel="manifest" href="/manifest.json">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(Request::is('my-location/*'))
    <style>
        select.form-control:not([size]):not([multiple]) {
            height: auto;
        }
        </style>
    @endif
     @if(Request::is('create-listing') || Request::is('my-profile/*') || Request::is('fill-details/*') || Request::is('edit-listing/*'))
    
    <style>
        .select2-container--default .select2-selection--single{
            border: 1px solid #444 !important;
            border-radius: 0!important;
        }
		.input-group-text {
            border: 1px solid #212529 !important;
       }
        </style>
    @else
    <style>
        .select2-container--default .select2-selection--single{
        border: 1px solid #fff !important;
        }
        iframe{
        width:100% !important;
       }
        </style>
   
    @endif
</head>

<body class="{{Request::is('/') || Request::is('login') || Request::is('register') || Request::is('dashboard') || Request::is('my-profile/*') || Request::is('my-listings') || Request::is('create-listing') || Request::is('change-password') || Request::is('all-listings') || Request::is('listing/*') || Request::is('verify-otp/*') || Request::is('thank-you') || Request::is('failed') || Request::is('packages') || Request::is('my-location/*') || Request::is('fill-details/*') || Request::is('verify-mobile') || Request::is('edit-listing/*') || Request::is('my-packages') || Request::is('contact-us') || Request::is('about-us') || Request::is('terms-and-conditions') || Request::is('refund-policy') || Request::is('privacy-policy')?'inner-pages' : '' }}">
	
	<!-- START PRELOADER -->
    <div id="preloader">
        <div id="status">
            <div class="status-mes"></div>
        </div>
    </div>
    <!-- END PRELOADER -->
	
    <!-- START SECTION HEADINGS -->
	@if(session()->has('loginerror'))
                <div class="alert alert-danger m-auto text-center alert-dismissible">
                      <strong>Error!! </strong> {{ session()->get('loginerror') }}
                        <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                </div>
              @endif

              @if(session()->has('phoneerror'))
                <div class="alert alert-danger m-auto text-center alert-dismissible">
                      <strong>Error!! </strong> {{ session()->get('phoneerror') }}
                        <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                </div>
              @endif
    <div class="header vid">
        <div class="header-top">
            <div class="container">
                <div class="top-info hidden-sm-down">
                    <div class="call-header">
                        <p><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:{{$headersdata['headerwebsitedata']->contact_no}}">{{$headersdata['headerwebsitedata']->contact_no}}</a></p>
                    </div>
                    <div class="address-header">
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i>{{$headersdata['headerwebsitedata']->address}}</p>
                    </div>
                    <div class="mail-header">
                        <p><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:{{$headersdata['headerwebsitedata']->email}}">{{$headersdata['headerwebsitedata']->email}}</a></p>
                    </div>
                </div>
                <div class="top-social hidden-sm-down">
                    <div class="login-wrap">
                        <ul class="d-flex">
                        @if(isset($_SESSION['userid']))
                            <li><a href="/dashboard"><img src="/webapp-assets/images/user-images/{{$_SESSION['userphoto']}}" height="15" width="15"> {{$_SESSION['username']}}</a></li>
                            <li><a href="/my-profile/{{$_SESSION['userid']}}"><i class="fa fa-user"></i> My Profile</a></li>
                            <li><a href="/logout"><i class="fa fa-sign-in"></i> Logout</a></li>
                        @else
                            <li><a href="#" data-toggle="modal" data-target="#loginModal"><i class="fa fa-user"></i> Login</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#registerModal"><i class="fa fa-sign-in"></i> Register</a></li>
                        @endif
                        </ul>
                    </div>
                    <div class="social-icons-header">
                        <div class="social-icons">
                            @if(!empty($headersdata['headerwebsitedata']->facebook_link))
                            <a target="_blank" href="{{$headersdata['headerwebsitedata']->facebook_link}}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            @endif
                            @if(!empty($headersdata['headerwebsitedata']->twitter_link))
                            <a target="_blank" href="{{$headersdata['headerwebsitedata']->twitter_link}}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            @endif
                            @if(!empty($headersdata['headerwebsitedata']->google_link))
                            <a target="_blank" href="{{$headersdata['headerwebsitedata']->google_link}}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                            @endif
                            @if(!empty($headersdata['headerwebsitedata']->insta_link))
                            <a target="_blank" href="{{$headersdata['headerwebsitedata']->insta_link}}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            @endif
                            @if(!empty($headersdata['headerwebsitedata']->youtube_link))
                            <a target="_blank" href="{{$headersdata['headerwebsitedata']->youtube_link}}"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                            @endif
                        </div>
                    </div>
                    <!-- <div class="dropdown">
                        <button class="btn-dropdown dropdown-toggle" type="button" id="dropdownlang" data-toggle="dropdown" aria-haspopup="true">
                            <img src="/webapp-assets/images/en.png" alt="lang" /> English
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownlang">
                            <li><img src="/webapp-assets/images/fr.png" alt="lang" />France</li>
                            <li><img src="/webapp-assets/images/de.png" alt="lang" /> German</li>
                            <li><img src="/webapp-assets/images/it.png" alt="lang" />Italy</li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="header-bottom heading vid sticky-header" id="heading">
            <div class="container">
                <a href="/" class="logo">
                    <img src="/webapp-assets/{{$headersdata['headerwebsitedata']->logo}}" alt="realhome">
                </a>
                <!-- <button type="button" class="search-button" data-toggle="collapse" data-target="#bloq-search" aria-expanded="false">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button> -->
                @if(isset($_SESSION['userid']))
                    <a href="/dashboard" class="search-button hidden-lg-up">
                         <img src="/webapp-assets/images/user-images/{{$_SESSION['userphoto']}}" height="30" width="30">
                    </a>
                    
                    
                @else
                    <a href="#" data-toggle="modal" data-target="#loginModal" class="search-button hidden-lg-up">
                        <!-- <i class="fa fa-user"></i> -->
                        Login
                    </a>

                    <a href="#" data-toggle="modal" data-target="#registerModal" class="search-button hidden-lg-up">
                        <!-- <i class="fa fa-user"></i> -->
                        Register
                    </a>
                    
                @endif
                <div class="get-quote hidden-lg-down">
                    <a href="create-listing">
                        <p>Add Listing</p>
                    </a>
                </div>
                <button type="button" class="button-menu hidden-lg-up" data-toggle="collapse" data-target="#main-menu" aria-expanded="false">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>

                <form action="#" id="bloq-search" class="collapse">
                    <div class="bloq-search">
                        <input type="text" placeholder="search...">
                        <input type="submit" value="Search">
                    </div>
                </form>

                <nav id="main-menu" class="collapse">
                    <ul>
                        
                        <li>
                            <a class="{{Request::is('/') || Request::is('index')?'active' : '' }}" href="/">Home</a>
                        </li>
                        @if(isset($_SESSION['userid']))
                        <li class="hidden-lg-up"><a href="/my-listings" class="nav-link {{Request::is('my-listings')?'active' : '' }}">My Listings</a></li>
                        <li class="hidden-lg-up">
                            <a class="{{Request::is('my-profile/*')?'active' : '' }}" href="/my-profile/{{$_SESSION['userid']}}"><i class="fa fa-user"></i> My Profile</a>
                        </li>
                        @endif
                        <!-- STAR COLLAPSE MOBILE MENU -->
                        
                       
                        <!-- END COLLAPSE MOBILE MENU -->
                        <li class="hidden-md-down">
                            <a href="/all-listings">All Listings</a>
                            <!-- <div class="dropdown-menu">
                                <a class="dropdown-item" href="about.html">About Us</a>
                                <a class="dropdown-item" href="dashboard.html">Dashboard</a>
                                <a class="dropdown-item" href="faq.html">Faq</a>
                                <a class="dropdown-item" href="pricing-table.html">Pricing</a>
                                <a class="dropdown-item" href="payment-method.html">Payment Method</a>
                                <a class="dropdown-item" href="thank-you.html">Thank You</a>
                                <a class="dropdown-item" href="404.html">404</a>
                                <a class="dropdown-item" href="login.html">Login</a>
                                <a class="dropdown-item" href="register.html">Register</a>
                                <a class="dropdown-item" href="coming-soon.html">Coming Soon</a>
                                <a class="dropdown-item" href="under-construction.html">Under Construction</a>
                            </div> -->
                        </li>
                        <!-- STAR COLLAPSE MOBILE MENU -->
                        
                        <!-- END COLLAPSE MOBILE MENU -->
                        <!-- <li class="dropdown hidden-md-down">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Blog</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Blog </a>
                                <a class="dropdown-item" href="#">Blog Sidebar</a>
                                <a class="dropdown-item" href="#">Blog List</a>
                            </div>
                        </li> -->
                        <li><a href="/about-us">About Us</a></li>
                        <li><a href="/contact-us">Contact</a></li>
                        
                        
                        <li class="hidden-lg-up">
                            <a @if(isset($_SESSION['userotpstatus']) && $_SESSION['userotpstatus']!='yes') href="#" @elseif(isset($_SESSION['userid']) && $_SESSION['userotpstatus']=='yes') href="/create-listing"  @else href="#" data-toggle="modal" data-target="#loginModal" @endif><i class="fa fa-plus"></i> Add Listing</a>
                        </li>
                        @if(isset($_SESSION['userid']))
                        <li class="hidden-lg-up">
                            <a href="/logout"><i class="fa fa-sign-in"></i> Logout</a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>