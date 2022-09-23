@include('admin.layout.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
           
          <h1>Edit Package</h1>
          
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
              
              <li class="breadcrumb-item active">Edit Package</li>
             
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
         <form method="POST" action="/admin/updatepackage/{{$packagedata->id}}" enctype="multipart/form-data">
              {{ csrf_field() }}
        <div class="card-body">
          <div class="row">
         
            <div class="col-md-6">
              <div class="form-group">
                <label>Package Name<span class="text-danger">*</span></label>
                <input class="form-control" placeholder="Enter Package Name" value="{{$packagedata->plan_name}}" type="text" name="plan_name" required>
              </div> 
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label> Days Limit<span class="text-danger">*</span></label>
                <input class="form-control" placeholder="Enter Days Limit" onkeypress="return isNumber(event)" value="{{$packagedata->per_limit}}" type="text" name="per_limit" required>
              </div> 
            </div>
            

            <div class="col-md-4">
              <div class="form-group">
                <label>Old Price<span class="text-danger">*</span></label>
                <input class="form-control" onkeypress="return isNumber(event)" placeholder="Enter Old Price" value="{{$packagedata->old_price}}" type="text" name="old_price" required>
              </div> 
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label>New Price<span class="text-danger">*</span></label>
                <input class="form-control" onkeypress="return isNumber(event)" placeholder="Enter New Price" value="{{$packagedata->new_price}}" type="text" name="new_price" required>
              </div> 
            </div>

            <!-- <div class="col-md-4">
              <div class="form-group">
                <label>GST<span class="text-danger">*</span></label>
                <input class="form-control" placeholder="Enter GST" type="text" name="gst" value="{{$packagedata->gst}}" required>
              </div> 
            </div> -->

            <div class="col-md-4">
                <div class="form-group">
                  <label>Listing Creation Limit<span class="text-danger">*</span></label>
                  <input class="form-control" onkeypress="return isNumber(event)" placeholder="Enter Limit" value="{{$packagedata->gst}}" type="number" name="listing_limit" required>
                </div> 
              </div>

          
            <div class="col-md-12">
              <div class="form-group">
                <label>Description<span class="text-danger">*</span></label>
                <textarea class="form-control froalaEditor" name="description" rows="2">{{$packagedata->description}}</textarea>
              </div>
            </div>
            
            <button style="margin: 0 auto;" type="submit" class="btn btn-primary">Edit Package</button>
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

function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
      }
      return true;
    }
</script>