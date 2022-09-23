 @include('admin.layout.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Doctors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class=""><a class="btn btn-primary" href="/adddoctor">Add New Doctor</a> &nbsp;&nbsp;</li>
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Doctors</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
                @if(session()->has('message'))
                    <div class="alert alert-success m-auto text-center alert-dismissible">
                        <strong>Success!! </strong> {{ session()->get('message') }}
                            <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                    </div>
                @endif
                @if(session()->has('error'))
                    <div class="alert alert-danger m-auto text-center alert-dismissible">
                        <strong>Error!! </strong> {{ session()->get('error') }}
                            <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                    </div>
                @endif

            <div class="card">
              <!--<div class="card-header">-->
              <!--  <h3 class="card-title">DataTable with default features</h3>-->
              <!--</div>-->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    
                    <th>Name</th>
                    
                    <th>Phone</th>
                    <th>Email</th>
                   
                    <th class="all">Action</th>
                  </tr>
                  </thead>

                  <tbody>
                    @php $x=1; @endphp
                  @foreach($users as $usersnew)
                  <tr>
                    <td>{{$x++}}</td>
                    
                    <td>{{$usersnew->name}}</td>
                   
                    <td>{{$usersnew->phone}}</td>
                    <td>{{$usersnew->email}}</td>
                    
                    <td>
                      
                      <a class="btn btn-warning btn-sm" href="/edituser/{{$usersnew->id}}"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-danger btn-sm" href="#" onclick="confirm_doctordelete_modal('/deleteuser/{{$usersnew->id}}');"><i class="fa fa-trash"></i></a>
                      
                      @if($usersnew->status=='0') 
                            <div class="btn-group mr-2 mb-2" data-toggle="tooltip" data-animation="false" data-original-title="Change Status">
                                <span aria-expanded="false" aria-haspopup="true" class="btn btn-danger btn-sm lighten dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" id="dropdownMenuButton4">In-active</span>

                                <div style="padding: 0;min-width: 60px;margin: 0;" aria-labelledby="dropdownMenuButton4" class="dropdown-menu">
                                    <a class="btn btn-success btn-sm lighten dropdown-item" onclick="active_modal('/activestatus/{{$usersnew->id}}');" href="#"> Active</a>
                                </div>
                            </div>
                            @else
                            <div class="btn-group mr-2 mb-2" data-toggle="tooltip" data-animation="false" data-original-title="Change Status">
                                <span aria-expanded="false" aria-haspopup="true" class="btn btn-success btn-sm lighten dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" id="dropdownMenuButton4">Active</span>

                                <div style="padding: 0;min-width: 60px;margin: 0;" aria-labelledby="dropdownMenuButton4" class="dropdown-menu">
                                    <a class="btn btn-danger btn-sm lighten dropdown-item" onclick="inactive_modal('/inactivestatus/{{$usersnew->id}}');" href="#"> In-active</a>
                                </div>
                            </div>
                            @endif
                            
                    </td>
                  </tr>
                  @endforeach
                  </tbody>

                  <tfoot>
                  <tr>
                  <th>#</th>
                    
                    <th>Name</th>
                    
                    <th>Phone</th>
                    <th>Email</th>
                   
                    <th class="all">Action</th>
                  </tr>
                  </tfoot>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  
<!-- Info delete Modal -->
<div id="doctordelete-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-information h1 text-info"></i>
                    <h4 class="mt-2">Delete Doctor!</h4>
                    <p class="mt-3">Are you sure?</p>
                    <button type="button" class="btn btn-info my-2" data-dismiss="modal">Cancel</button>
                    <a href="#" id="update_doctor_link" class="btn btn-danger my-2">Continue</a>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

   @include('admin.layout.footer')

   <script>
       function confirm_doctordelete_modal(delete_url)
        {
            jQuery('#doctordelete-alert-modal').modal('show', {backdrop: 'static'});
            document.getElementById('update_doctor_link').setAttribute('href' , delete_url);
        }
  </script>