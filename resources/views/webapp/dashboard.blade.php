@include('webapp.layout.header')

<section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Dashboard</h1>
                <h2><a href="/">Home </a> &nbsp;/&nbsp; Dashboard</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION DASHBOARD -->
    <section class="user-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-xs-12">
                    <div class="user-profile-box">
                        <div class="header clearfix">
                            <h2>{{$data->name}}</h2>
                            <h4>Active User</h4>
                            <img src="/webapp-assets/images/user-images/{{$data->user_photo}}" alt="avatar" class="img-fluid profile-img">
                        </div>
                        <div class="detail clearfix">
                            <ul>
                                <li>
                                    <a class="active" href="/dashboard">
                                        <i class="fa fa-home"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="" href="#">
                                        <i class="fa fa-star"></i>Packages
                                    </a>
                                </li>
                                <li>
                                    <a class="" href="/my-packages">
                                        <i class="fa fa-star"></i>My Packages
                                    </a>
                                </li>
                                <li>
                                    <a href="/my-profile/{{$data->id}}">
                                        <i class="fa fa-user"></i>My Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="/my-listings">
                                        <i class="fa fa-list" aria-hidden="true"></i>My Listings
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="/create-listing">
                                        <i class="fa fa-list" aria-hidden="true"></i>Create New Listings
                                    </a>
                                </li>
                                <li>
                                    <a href="/change-password">
                                        <i class="fa fa-lock"></i>Change Password
                                    </a>
                                </li>
                                <li>
                                    <a href="/logout">
                                        <i class="fas fa-sign-out-alt"></i>Log Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-xs-12">
                    <div class="dashborad-box">
                        <h4 class="title">Manage Dashboard</h4>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="item">
                                        <div class="icon">
                                            <i class="fa fa-list" aria-hidden="true"></i>
                                        </div>
                                        <div class="info">
                                            <h6 class="number">{{count($listings)}}</h6>
                                            <p class="type ml-1">Listing</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="item">
                                        <div class="icon">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="info">
                                            <h6 class="number">{{count($activepackages)}}</h6>
                                            <p class="type ml-1">Active Plans</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="item">
                                        <div class="icon">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div class="info">
                                            <h6 class="number">{{count($expiredpackages)}}</h6>
                                            <p class="type ml-1">Expired Plans</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="item">
                                        <div class="icon">
                                            <i class="fa fa-list"></i>
                                        </div>
                                        <div class="info">
                                            @if(isset($activepackages[0]))
                                                <h6 class="number">{{$activepackages[0]->pending_listings}}</h6>
                                            @else
                                                 <h6 class="number">0</h6>
                                            @endif
                                            <p class="type ml-1">Pending Listings</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-4">
                                    <div class="item mb-0">
                                        <div class="icon">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                        <div class="info">
                                            <h6 class="number">223</h6>
                                            <p class="type ml-1">Messages</p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="dashborad-box">
                        <h4 class="title">Listing</h4>
                        <div class="section-body listing-table">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Vehicle</th>
                                            <th>From-To</th>
                                            <th>Fare</th>
                                            <th>Seats</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $x=1; @endphp
                                    @foreach($listings as $listingsnew)
                                        <tr>
                        
                                        <td>{{$listingsnew->vehicle_name}}<br><em>{{$listingsnew->vehicletype}}</em></td>
                                        <td>{{$listingsnew->source}}-{{$listingsnew->destination}}</td>
                                        <td>{{$listingsnew->fare}}</td>
                                        <td>{{$listingsnew->available_seats}}</td>
                                        <td>@if($listingsnew->status=='1')
                                            <span class='text-success'>Open</span>
                                            @else
                                            <span class='text-danger'>Closed</span>
                                            @endif
                                        </td>
                                        
                                        </tr>
                                  @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="dashborad-box mb-0">
                    @if(count($listings)>0)
                        <div class="section-inforamation text-center">
                            <a href="/my-listings" class="text-center">View All</a>
                        </div>
                    @else
                        <div class="section-inforamation text-center">
                            <a href="/create-listing" class="text-center"><i class="fa fa-plus"></i> Add Listing</a>
                        </div>
                    @endif 

                    </div>

                            
                        </div>
                        
                    </div>

                    
                    
                   
                    <!-- <div class="dashborad-box mb-0">
                        <h4 class="heading pt-0">Personal Information</h4>
                        <div class="section-inforamation">
                            <form>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" placeholder="Enter your First name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" placeholder="Enter your Last name">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="text" class="form-control" placeholder="Ex: example@domain.com">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" placeholder="Ex: +1-800-7700-00">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" class="form-control" placeholder="Write your address here"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>About Yourself</label>
                                            <textarea name="address" class="form-control" placeholder="Write about userself"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="password-section">
                                    <h6>Update Password</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" class="form-control" placeholder="Write new password">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Repeat Password</label>
                                                <input type="password" class="form-control" placeholder="Write same password again">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg mt-2">Submit</button>
                            </form>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION DASHBOARD -->

@include('webapp.layout.footer')

