<!-- START FOOTER -->
<footer class="first-footer">
        <div class="top-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="netabout">
                            <a href="/" class="logo">
                                <img src="/webapp-assets/{{$headersdata['headerwebsitedata']->logo}}" alt="netcom">
                            </a>
                            <p></p>
                        </div>
                        <div class="contactus">
                            <ul>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <p class="in-p">{{$headersdata['headerwebsitedata']->address}}</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <p class="in-p"><a href="tel:{{$headersdata['headerwebsitedata']->contact_no}}">{{$headersdata['headerwebsitedata']->contact_no}}</a></p>
                                    </div>
                                </li>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <p class="in-p ti"><a href="mailto:{{$headersdata['headerwebsitedata']->email}}">{{$headersdata['headerwebsitedata']->email}}</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget quick-link clearfix">
                            <h3 class="widget-title">Quick Links</h3>
                            <div class="quick-links">
                                <ul class="one-half mr-5">
                                    <li><a href="/">Home</a></li>
                                    <li><a href="/about-us">About Us</a></li>
                                    
                                    <li><a href="/register">Register</a></li>
                                </ul>
                                <ul class="one-half">
                                   
                                    <li><a href="/contact-us">Contact</a></li>
                                    <li><a href="/refund-policy">Refund Policy</a></li>
								    <li><a href="/privacy-policy">Privacy Policy & Terms </a></li>
								    <li class="no-pb"><a href="/all-listings">Listings</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget">
                            <h3>Instagram</h3>
                            <ul class="photo">
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-1.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-2.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-3.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-4.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-5.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-6.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect mb-0">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-7.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect mb-0">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-8.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect mb-0">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-9.jpg" alt=""></a>
                                    </figure>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="newsletters">
                            <h3>Newsletters</h3>
                            <p>Sign Up for Our Newsletter to get Latest Updates and Offers. Subscribe to receive news in your inbox.</p>
                        </div>
                        <form class="bloq-email mailchimp form-inline" method="post" action="">
                            <label for="subscribeEmail" class="error"></label>
                            <div class="email">
                                <input type="email" id="subscribeEmail" name="EMAIL" placeholder="Enter Your Email">
                                <input type="submit" value="Subscribe">
                                <p class="subscription-success"></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="second-footer">
            <div class="container">
                <p>Vaahak24 ©<script>document.write(new Date().getFullYear());</script> All rights reserved. </p>
                <p>Developed And Managed By<a href="https://www.mavericinfotech.in">Maveric InfoTech (+91 9552302834)</a></p>
                <ul class="netsocials">
                    <!-- <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li> -->
                            @if(!empty($headersdata['headerwebsitedata']->facebook_link))
                            <li><a target="_blank" href="{{$headersdata['headerwebsitedata']->facebook_link}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            @endif
                            @if(!empty($headersdata['headerwebsitedata']->twitter_link))
                            <li><a target="_blank" href="{{$headersdata['headerwebsitedata']->twitter_link}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            @endif
                            @if(!empty($headersdata['headerwebsitedata']->google_link))
                            <li><a target="_blank" href="{{$headersdata['headerwebsitedata']->google_link}}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            @endif
                            @if(!empty($headersdata['headerwebsitedata']->insta_link))
                            <li><a target="_blank" href="{{$headersdata['headerwebsitedata']->insta_link}}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            @endif
                            @if(!empty($headersdata['headerwebsitedata']->youtube_link))
                            <li><a target="_blank" href="{{$headersdata['headerwebsitedata']->youtube_link}}"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                            @endif
                </ul>
            </div>
        </div>
    </footer>

    <a data-scroll href="#heading" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
    <!-- END FOOTER -->

 <a href="tel:9120027006" class="call-button"><i class="fa fa-phone"></i></a>

   
    <!--Style Switcher===========================================-->
    <div class="color-switcher" id="choose_color"> <a href="#." class="picker_close"><i class="fa fa-cog fa-spin fa-2x" ></i></a>
        <div class="theme-colours">
            <p class="font-italic">Choose Colour style</p>
            <ul>
                <li>
                    <a href="#." class="blue" id="blue"></a>
                </li>
                <li>
                    <a href="#." class="pink" id="pink"></a>
                </li>
                <li>
                    <a href="#." class="orange" id="orange"></a>
                </li>
                <li>
                    <a href="#." class="purple" id="purple"></a>
                </li>
                <li>
                    <a href="#." class="green" id="green"></a>
                </li>
                <li>
                    <a href="#." class="red" id="red"></a>
                </li>
                <li>
                    <a href="#." class="cyan" id="cyan"></a>
                </li>
                <li>
                    <a href="#." class="sky-blue" id="sky-blue"></a>
                </li>
                <!-- <li>
                    <a href="#." class="gray" id="gray"></a>
                </li>
                <li>
                    <a href="#." class="brown" id="brown"></a>
                </li> -->
            </ul>
        </div>
    </div>



    <!--Login Modal -->
  <div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">LOGIN</h4>
          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
         <!-- START SECTION LOGIN -->
    <div id="login">
        <div class="login">
        @if(session()->has('loginerror'))
                <div class="alert alert-danger m-auto text-center alert-dismissible">
                      <strong>Error!! </strong> {{ session()->get('loginerror') }}
                        <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                </div>
              @endif
            <form action="/sendotp" method="POST">
            {{ csrf_field() }}
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" maxlength="10" placeholder="Enter your Phone no" class="form-control" name="phone" onkeypress="return isNumber(event)" id="phone">
                    <i class="icon_mail_alt"></i>
                </div>
                <!--<div class="form-group">-->
                <!--    <label>Password</label>-->
                <!--    <input type="password" laceholder="Enter Password" class="form-control" name="password" id="password" value="">-->
                <!--    <i class="icon_lock_alt"></i>-->
                <!--</div>-->
                <!--<div class="fl-wrap filter-tags clearfix add_bottom_30">-->
                <!--    <div class="checkboxes float-left">-->
                <!--        <div class="filter-tags-wrap">-->
                <!--            <input id="check-b" type="checkbox" name="remember">-->
                <!--            <label for="check-b">Remember me</label>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--     </div>-->
                <button type="submit" class="btn_1 rounded full-width">LOGIN</button>
                <!--<div class="text-center add_top_10">Not registered yet? <strong><a href="#" data-toggle="modal" data-target="#registerModal">Sign up!</a></strong></div>-->
            </form>
        </div>
    </div>
    <!-- END SECTION LOGIN -->

        </div>
      
      </div>
      
    </div>
  </div>





    <!--Register Modal -->
    <div class="modal fade" id="registerModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
         
          <h4 class="modal-title">Register</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
         
         <!-- START SECTION LOGIN -->
         <div id="login">
  
	   <div class="login">
	   
		   <form action="/sendotp" method="POST">
			   {{ csrf_field() }}
			  
			   <div class="form-group">
				   <label>Phone Number <span class="text-danger">*</span> (You will recieve OTP)</label>
				   <input type="tel" id="phone" maxlength="10" name="phone" onkeypress="return isNumber(event)" class="form-control rounded-0" required>
				   <i class="ti-user"></i>
			   </div>
			  
			   <div id="pass-info" class="clearfix"></div>
			   <button type="submit" class="btn_1 rounded full-width add_top_30 mt-5">Register Now!</button>
			   <div class="text-center add_top_10">Already have an acccount? <strong><a href="#" data-toggle="modal" data-target="#loginModal">Sign In</a></strong></div>
		   </form>
	   </div>
   </div>
    <!-- END SECTION LOGIN -->

        </div>
      
      </div>
      
    </div>
  </div>

    <!-- ARCHIVES JS -->
    <script src="/webapp-assets/js/jquery.min.js"></script>
    <script src="/webapp-assets/js/jquery-ui.js"></script>
    <script src="/webapp-assets/js/tether.min.js"></script>
    <script src="/webapp-assets/js/moment.js"></script>
    <script src="/webapp-assets/js/transition.min.js"></script>
    <script src="/webapp-assets/js/transition.min.js"></script>
    <script src="/webapp-assets/js/bootstrap.min.js"></script>
    <script src="/webapp-assets/js/fitvids.js"></script>
    <script src="/webapp-assets/js/jquery.waypoints.min.js"></script>
    <script src="/webapp-assets/js/jquery.counterup.min.js"></script>
    <script src="/webapp-assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="/webapp-assets/js/isotope.pkgd.min.js"></script>
    <script src="/webapp-assets/js/smooth-scroll.min.js"></script>
    <script src="/webapp-assets/js/lightcase.js"></script>
    @if(!Request::is('my-location/*'))
    <script src="/webapp-assets/js/search.js"></script>
    @endif
    <script src="/webapp-assets/js/slick.min.js"></script>
    <script src="/webapp-assets/js/slick3.js"></script>
    <script src="/webapp-assets/js/owl.carousel.js"></script>
    <script src="/webapp-assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/webapp-assets/js/ajaxchimp.min.js"></script>
    <script src="/webapp-assets/js/newsletter.js"></script>
    <script src="/webapp-assets/js/jquery.form.js"></script>
    <script src="/webapp-assets/js/jquery.validate.min.js"></script>
    <script src="/webapp-assets/js/searched.js"></script>
    <script src="/webapp-assets/js/forms-2.js"></script>
    <script src="/webapp-assets/js/color-switcher.js"></script>

    <!-- Slider Revolution scripts -->
    <script src="/webapp-assets/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="/webapp-assets/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script src="/webapp-assets/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="/webapp-assets/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
    <script src="/webapp-assets/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="/webapp-assets/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="/webapp-assets/revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="/webapp-assets/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="/webapp-assets/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="/webapp-assets/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="/webapp-assets/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <!-- Select2 -->
    <script src="/admin-assets/plugins/select2/js/select2.full.min.js"></script>
    
    <script src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/a549aa8780dbda16f6cff545aeabc3d71073911e/src/js/bootstrap-datetimepicker.js"></script>

<!-- Bootstrap4 Duallistbox -->
   <script src="/admin-assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>

    <script src="/admin-assets/plugins/inputmask/jquery.inputmask.min.js"></script>
     <!-- date-range-picker -->
    <script src="/admin-assets/plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Tempusdominus Bootstrap 4 -->
   <script src="/admin-assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!-- MAIN JS -->
    <script src="/webapp-assets/js/script.js"></script>
    <script src="/webapp-assets/js/main.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".paymentform").submit(function(e){
          e.preventDefault();
        //  console.log('update',$(this).find(".payment-amount").val());
        //  var totalAmount = $(this).attr("data-amount");
        //   var product_id =  $(this).attr("data-id");
          
           var payment_amount= $(this).find(".payment-amount").val();
           var name= $(this).find(".payment-name").val();
           var email= $(this).find(".payment-email").val();
           var phone= $(this).find(".payment-phone").val();
           var package_id= $(this).find(".package_id").val();
           var user_id= $(this).find(".user_id").val();
        //    var payment_id= $(this).find(".payment_id").val();
           var url='/payment/payment-success/'+user_id+'/'+package_id;
          var options = {
           "key": "{{$headersdata['headerwebsitedata']->razor_pay_key}}",
           "amount": payment_amount, // 2000 paise = INR 20
           "currency": "INR",
           "name": name,
           "description": "Payment",
           "image": "{{env('APP_URL')}}webapp-assets/logo.1634622181.svg",
           "handler": function (response){
               console.log('response',response);
               if(response.razorpay_payment_id == 'undefined' ||  response.razorpay_payment_id < 1){
                   window.location.href = '{{env('APP_URL')}}payment/payment-failed/'+user_id+'/'+package_id;
               }else{
                    window.location.href = '{{env('APP_URL')}}payment/payment-success/'+user_id+'/'+package_id;
               }
                 $.ajax({
                   url: url,
                   type: 'post',
                   dataType: 'json',
                   data: {
                    
                     payment_amount : payment_amount ,
                   }, 
                   
                   success: function (msg) {
                        console.log('msg',msg);
                       window.location.href = '{{env('APP_URL')}}payment/payment-success';
                   }
                   
               });
             
           },
          "prefill": {
               "contact": phone,
               "email":   email,
           },
           "theme": {
               "color": "#528FF0"
           }
         };
         var rzp1 = new Razorpay(options);
         rzp1.open();
         e.preventDefault();
         
        });


      
       
    </script>
</body>

</html>
