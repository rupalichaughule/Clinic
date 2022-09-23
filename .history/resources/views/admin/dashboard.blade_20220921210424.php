@include('admin.layout.header')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">

      <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
              <div class="inner">
                <h3>
                {{$totalusers}}
                </h3>

                <p>Doctors</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            <a href="/admin/users" class="small-box-footer">View Info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                {{$totallistings}}
                </h3>

                <p>Patients</p>
              </div>
              <div class="icon">
                <i class="fas fa-th-large"></i>
              </div>
            <a href="/admin/listings" class="small-box-footer">View Info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                {{$opentotallistings}}
                </h3>

                <p>Appointments</p>
              </div>
              <div class="icon">
                <i class="fas fa-th-large"></i>
              </div>
            <a href="/admin/listings" class="small-box-footer">View Info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
              <div class="inner">
                <h3>
                {{$closetotallistings}}
                </h3>

                <p>Close Listings</p>
              </div>
              <div class="icon">
                <i class="fas fa-th-large"></i>
              </div>
            <a href="/admin/listings" class="small-box-footer">View Info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        
  
        


       
      </div>
      <!-- /.row -->
      
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

 @include('admin.layout.footer')