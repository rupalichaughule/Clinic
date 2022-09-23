@include('webapp.layout.header')

 
<section class="headings">
	   <div class="text-heading text-center">
		   <div class="container">
			   <h1>Register</h1>
			   <h2><a href="/">Home </a> &nbsp;/&nbsp; Register</h2>
		   </div>
	   </div>
   </section>
   <!-- END SECTION HEADINGS -->

   <!-- START SECTION REGISTER -->
   <div id="login">
   @if(session()->has('phoneerror'))
                <div class="alert alert-danger m-auto text-center alert-dismissible">
                      <strong>Error!! </strong> {{ session()->get('phoneerror') }}
                        <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                </div>
              @endif
                            @if(session()->has('error'))
                            <div class="alert alert-danger m-auto text-center alert-dismissible" style="">
                                    <strong>Error!! </strong> {{ session()->get('error') }}
                                    <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                                </div>
                            @endif
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
			   <div class="text-center add_top_10">Already have an acccount? <strong><a href="/login">Sign In</a></strong></div>
		   </form>
	   </div>
   </div>
   <!-- END SECTION REGISTER -->


  @include('webapp.layout.footer')

<script>
 function isNumber(evt) {
	 evt = (evt) ? evt : window.event;
	 var charCode = (evt.which) ? evt.which : evt.keyCode;
	 if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	   return false;
	 }
	 return true;
   }
</script>