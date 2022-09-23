@include('admin.layout.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
           
          <h1>Edit Doctor</h1>
          
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
              
              <li class="breadcrumb-item active">Edit Doctor</li>
             
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
         <form method="POST" action="/updatedoctor/{{$userdata->id}}" enctype="multipart/form-data">
              {{ csrf_field() }}
        <div class="card-body">
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label>Name<span class="text-danger">*</span></label>
                <input class="form-control" placeholder="Enter Name" value="{{$userdata->name}}" type="text" name="name" required>
              </div> 
            </div>
            <input type="hidden" name="status" value="1">
            <div class="col-md-6">
              <div class="form-group">
                <label>Phone<span class="text-danger">*</span></label>
                <input class="form-control" type="text" value="{{$userdata->phone}}" placeholder="Enter Phone" maxlength="10" name="phone" onkeypress="return isNumber(event)" required>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" value="{{$userdata->email}}" placeholder="Enter Email" name="email">
              </div>
            </div>

           
              <div class="col-md-6">
                <div class="form-group">
                  <label>Status<span class="text-danger">*</span></label>
                  <select name="status" class="form-control select2" style="width: 100%;" required>
                    <option value="" selected disabled>Select Status</option>
                                            <option @if($userdata->status=='1') selected @endif value="1">Active</option>
                                            <option @if($userdata->status=='0') selected @endif value="0">In-active</option>
                  </select>
                </div> 
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Country<span class="text-danger">*</span></label>
                  <select class="form-control rounded-0 select" id="country" name="country" required>
                                            <option value="" selected disabled>Country</option>
                                                <option value="India" @if($userdata->country=='India') selected @endif>India</option>
                                        </select>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label>Aadhar Card No<span class="text-danger">*</span></label>
                  <input class="form-control" type="text" value="{{$userdata->aadhar_card_no}}" placeholder="Enter Aadhar Card No" name="aadhar_card_no" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Aadhar Card Photo<span class="text-danger">*</span></label>
                  <input class="form-control" type="file" name="aadhar_card_photo">
                  @if(!empty($userdata->aadhar_card_photo))
                  <a target="_blank" href="/webapp-assets/images/user-aadharcard/{{$userdata->aadhar_card_photo}}">view</a>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Driving Licence No<span class="text-danger">*</span></label>
                  <input class="form-control" type="text" value="{{$userdata->driving_licence_no}}" placeholder="Enter Driving Licence No" name="driving_licence_no" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Driving Licence Photo<span class="text-danger">*</span></label>
                  <input class="form-control" type="file" name="driving_licence_photo">
                  @if(!empty($userdata->driving_licence_photo))
                  <a target="_blank" href="/webapp-assets/images/user-licence/{{$userdata->driving_licence_photo}}">view</a>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Pan Card No<span class="text-danger">*</span></label>
                  <input class="form-control" type="text" value="{{$userdata->pan_card_no}}" placeholder="Enter Pan Card No" name="pan_card_no" required>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Pan Card Photo<span class="text-danger">*</span></label>
                  <input class="form-control" type="file" name="pan_card_photo">
                  @if(!empty($userdata->pan_card_photo))
                  <a target="_blank" href="/webapp-assets/images/user-pancard/{{$userdata->pan_card_photo}}">view</a>
                  @endif
                </div>
              </div>


              <div class="col-md-6">
             
              <div class="form-group">
                <label>Password<span class="text-danger">*</span></label><br>
                <a class="btn btn-primary" data-toggle="modal" data-target="#changePassword{{$userdata->id}}" href="javascript:void();" title="Change Password"><i class="fa fa-key"></i> Change Password</a>
                </div>

            </div>


              <div class="col-md-12">
                <div class="form-group">
                  <label>Address<span class="text-danger">*</span></label>
                  <textarea class="form-control" name="address">{{$userdata->address}}</textarea>
                </div>
              </div>

            
            <button style="margin: 0 auto;" type="submit" class="btn btn-primary">Edit User</button>
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

<!-- The Modal -->
<div class="modal" id="changePassword{{$userdata->id}}">
                                                   <div class="modal-dialog">
                                                      <div class="modal-content">
                                                         <!-- Modal Header -->
                                                         <div class="modal-header">
                                                            <h4 class="modal-title">Change Password ({{$userdata->name}})</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                         </div>
                                                         <!-- Modal body -->
                                                         <div class="modal-body">
                                                           
                                                            <form method="POST" action="/changepassword" id="changepasswordform">
                                                            {{ csrf_field() }}
                                                               <div class="form-group">
                                                                  <label for="email">New Password:</label>
                                                                  <input type="password" class="form-control" id="password" placeholder="Enter New Password" name="password" required>
                                                               </div>
                                                               <input type="hidden" name="userid" value="{{$userdata->id}}">
                                                               <div class="form-group">
                                                                  <label for="pwd">Confirm Password:</label>
                                                                  <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password" required>
                                                               </div>
                                                               <button type="submit" class="btn btn-primary">Change</button>
                                                            </form>
                                                         </div>
                                                         <!-- Modal footer -->
                                                         <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>


 @include('admin.layout.footer')

 <script>
   
</script>