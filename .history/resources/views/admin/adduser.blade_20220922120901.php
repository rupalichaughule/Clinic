 @include('admin.layout.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             
            <h1>Add User</h1>
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
                
                <li class="breadcrumb-item active">Add User</li>
               
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <!-- <h3 class="card-title">Select2 (Default Theme)</h3>
 -->
  @if(session()->has('error'))
                                                    <div class="alert alert-danger m-auto text-center alert-dismissible">
                                                            <strong>Error!! </strong> {{ session()->get('error') }}
                                                            <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                                                        </div>
                                                    @endif
  @if(session()->has('message'))
                                                    <div class="alert alert-success m-auto text-center alert-dismissible">
                                                            <strong>Success!! </strong> {{ session()->get('message') }}
                                                            <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                                                        </div>
                                                    @endif
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
           <form method="POST" action="/savedoctor" enctype="multipart/form-data">
                {{ csrf_field() }}
          <div class="card-body">
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label>Name<span class="text-danger">*</span></label>
                  <input class="form-control" placeholder="Enter Name" type="text" name="name" required>
                </div> 
              </div>
              <input type="hidden" name="status" value="1">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Phone<span class="text-danger">*</span></label>
                  <input class="form-control" type="text" placeholder="Enter Phone" maxlength="10" name="phone" onkeypress="return isNumber(event)" required>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control" type="email" placeholder="Enter Email" name="email" >
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Photo<span class="text-danger">*</span></label>
                  <input class="form-control" type="file" name="user_photo" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>City<span class="text-danger">*</span></label>
                  <select name="city" class="form-control select2" style="width: 100%;" required>
                    <option value="" selected disabled>Select City</option>
                        @foreach($sources as $sourcesnew)
                           <option value="{{$sourcesnew->name}}">{{$sourcesnew->name}} </option>
                        @endforeach
                  </select>
                </div> 
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>State<span class="text-danger">*</span></label>
                  <!-- <input class="form-control" placeholder="Enter State" type="text" name="state" required> -->
                  <select class="form-control select2" id="state" name="state" required>
                                            <option value="" selected disabled>State</option>
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Assam">Assam</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chandigarh">Chandigarh</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                            <option value="Daman and Diu">Daman and Diu</option>
                                            <option value="Delhi">Delhi</option>
                                            <option value="Lakshadweep">Lakshadweep</option>
                                            <option value="Puducherry">Puducherry</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Meghalaya">Meghalaya</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Odisha">Odisha</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option>
                                            <option value="West Bengal">West Bengal</option>

                                        </select>
                </div> 
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Country<span class="text-danger">*</span></label>
                  <!-- <input class="form-control" placeholder="Enter State" type="text" name="state" required> -->
                  <select class="form-control select2" id="country" name="country" required>
                                            <option value="" selected disabled>Country</option>
                                                <option value="India">India</option>
                                        </select>
                </div> 
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Aadhar Card No<span class="text-danger">*</span></label>
                  <input class="form-control" type="text" placeholder="Enter Aadhar Card No" name="aadhar_card_no" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Aadhar Card Photo<span class="text-danger">*</span></label>
                  <input class="form-control" type="file" name="aadhar_card_photo" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Driving Licence No<span class="text-danger">*</span></label>
                  <input class="form-control" type="text" placeholder="Enter Driving Licence No" name="driving_licence_no" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Driving Licence Photo<span class="text-danger">*</span></label>
                  <input class="form-control" type="file" name="driving_licence_photo" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Pan Card No<span class="text-danger">*</span></label>
                  <input class="form-control" type="text" placeholder="Enter Pan Card No" name="pan_card_no" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Pan Card Photo<span class="text-danger">*</span></label>
                  <input class="form-control" type="file" name="pan_card_photo" required>
                </div>
              </div>

              <div class="col-md-6">
               
                <div class="form-group">
                  <label>Password<span class="text-danger">*</span></label>
                     <div style="position:relative;">
                          <div style="position:absolute;padding:10px 15px 9px;top:0;right:0">
                                              
                            <span toggle="#password-field" style="cursor: pointer;" class="fa fa-eye-slash field_icon toggle-password inside-input"></span>
                          </div>
                          <input type="password" class="form-control w-100 pass_log_id" name="password" id="pass_log_id" placeholder="Enter Password" required>
                      </div>
                  </div>

              </div>


              <div class="col-md-12">
                <div class="form-group">
                  <label>Address<span class="text-danger">*</span></label>
                  <textarea class="form-control" name="address"></textarea>
                </div>
              </div>


              

              <button style="margin: 0 auto;" type="submit" class="btn btn-primary">Add User</button>
              <!-- /.col -->

            </div>
            <!-- /.row -->

            <!-- /.row -->
          </div>
         
        </div>
        <!-- /.card -->
        </form>
        
        
       
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
   @include('admin.layout.footer')

   <script>
     $(document).on('click', '.toggle-password', function() {
  
  $(this).toggleClass("fa-eye fa-eye-slash");

  var input = $(".pass_log_id");
  input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
  </script>