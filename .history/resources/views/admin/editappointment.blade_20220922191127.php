@include('admin.layout.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
           
          <h1>Edit Appointment</h1>
          
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
              
              <li class="breadcrumb-item active">Edit Appointment</li>
             
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
         <form method="POST" action="/updatedoctor/{{$doctordata->id}}" enctype="multipart/form-data">
              {{ csrf_field() }}
        <div class="card-body">
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label>Name<span class="text-danger">*</span></label>
                <input class="form-control" placeholder="Enter Name" value="{{$doctordata->name}}" type="text" name="name" required>
              </div> 
            </div>
           
            <div class="col-md-6">
              <div class="form-group">
                <label>Phone<span class="text-danger">*</span></label>
                <input class="form-control" type="text" value="{{$doctordata->phone}}" placeholder="Enter Phone" maxlength="10" name="phone" onkeypress="return isNumber(event)" required>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" value="{{$doctordata->email}}" placeholder="Enter Email" name="email">
              </div>
            </div>

           
              <div class="col-md-6">
                <div class="form-group">
                  <label>Status<span class="text-danger">*</span></label>
                  <select name="status" class="form-control select2" style="width: 100%;" required>
                    <option value="" selected disabled>Select Status</option>
                                            <option @if($doctordata->status=='1') selected @endif value="1">Active</option>
                                            <option @if($doctordata->status=='0') selected @endif value="0">In-active</option>
                  </select>
                </div> 
              </div>

             

              <div class="col-md-6">
             
              <div class="form-group">
                <label>Password<span class="text-danger">*</span></label><br>
                <a class="btn btn-primary" data-toggle="modal" data-target="#changePassword{{$doctordata->id}}" href="javascript:void();" title="Change Password"><i class="fa fa-key"></i> Change Password</a>
                </div>

            </div>
            
            <button style="margin: 0 auto;" type="submit" class="btn btn-primary">Edit Appointment</button>
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
   
</script>