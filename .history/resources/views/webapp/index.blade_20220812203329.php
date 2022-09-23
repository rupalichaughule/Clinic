@include('webapp.layout.header')

 <!-- STAR HEADER SEARCH -->
    <div id="map-container" class="fullwidth-home-map dark-overlay">
        <!-- Video -->
        <div class="video-container">
            <video poster="/webapp-assets/images/bg/video-poster.jpg" loop autoplay muted>
                <source src="/webapp-assets/video/4.mp4" type="video/mp4">
            </video>
        </div>
        <div id="hero-area" class="main-search-inner search-2 vid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hero-inner2">

                        @if(isset($_SESSION['userid']) && count($ads)>0)


                <!-- Carousel -->
                                <div id="ad-carousel" class="carousel slide" data-bs-ride="carousel" style="width: auto !important; margin:0 auto !important; text-align: center;">
                                    <!-- Indicators/dots -->
                                    <div class="carousel-indicators">
                                    @php $r=1;$banner_slide=0; @endphp
                                    
                                        @foreach($ads as $adsnew)
                                            @php $newcity=explode(",",$adsnew->locations); @endphp
                                                
                                            @if(isset($_SESSION['userid']) && $adsnew->locations=='All')
                                                <button type="button" data-bs-target="#ad-carousel" data-bs-slide-to="{{$banner_slide++}}" class="@if($r++==1) active @endif"></button>
                                            @elseif(isset($_SESSION['userid']) && (in_array($usercity, $newcity)))
                                            
                                                <button type="button" data-bs-target="#ad-carousel" data-bs-slide-to="{{$banner_slide++}}" class="@if($r++==1) active @endif"></button>
                                            @endif
                                            
                                        @endforeach
                                   
                                    </div>


                                <!-- The slideshow/carousel -->
                                <div class="carousel-inner">
                                        @php $l=1; @endphp
                                        
                                        @foreach($ads as $adsnew)
                                            @php $newcity=explode(",",$adsnew->locations); @endphp
                                        
                                            @if(isset($_SESSION['userid']) && $adsnew->locations=='All')
                                                
                                                    @if($adsnew->ad_type=='Image')
                                                   
                                                    <div class="carousel-item @if($l++==1) active @endif">
                                                    <a href="{{$adsnew->ad_link}}" target="_blank" class="">
                                                        <img class="img-responsive" src="/webapp-assets/ads/{{$adsnew->ad_banner}}" alt="" style="height:300px; width: 100%;">
                                                    </a>
                                                    </div>
                                                    @elseif($adsnew->ad_type=='Video')
                                                    <div class="carousel-item @if($l++==1) active @endif">
                                                    <a href="{{$adsnew->ad_link}}" target="_blank" class="">
                                                                        <video loop autoplay muted style="height:300px; width: 100%;">
                                                                            <source src="/webapp-assets/ads/{{$adsnew->ad_banner}}" type="video/mp4">
                                                                        </video>
                                                                </a>
                                                    </div>
                                                    @elseif($adsnew->ad_type=='Youtube')

                                                    <div class="carousel-item @if($l++==1) active @endif">
                                                    <a href="{{$adsnew->ad_link}}" target="_blank" class="">
                                                    {!!$adsnew->ad_banner!!}
                                                                </a>
                                                    </div>
                                                    
                                                    @endif
                                            @elseif(isset($_SESSION['userid']) && (in_array($usercity, $newcity)))

                                                @if($adsnew->ad_type=='Image')
                                                    
                                                    <div class="carousel-item @if($l++==1) active @endif">
                                                    <a href="{{$adsnew->ad_link}}" target="_blank" class="">
                                                        <img class="img-responsive" src="/webapp-assets/ads/{{$adsnew->ad_banner}}" alt="" style="height:300px; width: 100%;">
                                                    </a>
                                                    </div>
                                                    
                                                    @elseif($adsnew->ad_type=='Video')
                                                    <div class="carousel-item @if($l++==1) active @endif">
                                                    <a href="{{$adsnew->ad_link}}" target="_blank" class="">
                                                                        <video loop autoplay muted style="height:300px; width: 100%;">
                                                                            <source src="/webapp-assets/ads/{{$adsnew->ad_banner}}" type="video/mp4">
                                                                        </video>
                                                                </a>
                                                    </div>
                                                    @elseif($adsnew->ad_type=='Youtube')

                                                    <div class="carousel-item @if($l++==1) active @endif">
                                                    <a href="{{$adsnew->ad_link}}" target="_blank" class="">
                                                    {!!$adsnew->ad_banner!!}
                                                                </a>
                                                    </div>
                                                    
                                                    @endif

                                            @endif
                                            
                                    
                                        @endforeach
                                           
                                </div>

                                <!-- Left and right controls/icons -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#ad-carousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#ad-carousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                                </button>
                                </div>

                                    

                                @endif
    
           
                            <!-- Welcome Text -->
                            <div class="welcome-text" style="padding-top: 15px;">
                                <h1>Find Travel Mates</h1>
                               <p>
								   @if(isset($_SESSION['userid']))
                                    <a style="text-decoration: none; color:#fff;" href="/create-listing" class="btn_1 rounded">Add Listing</a>
                                    @else
                                    <a style="text-decoration: none; color:#fff;" href="#" data-toggle="modal" data-target="#loginModal" class="btn_1 rounded">Add Listing</a>
                                    @endif
								</p>
                            </div>
                            <!--/ End Welcome Text -->
                            <!-- Search Form -->
                            <div class="trip-search 3s">
                                <form class="form" method="GET" action="/all-listings">
                                   <!-- Form Location -->
                                   <div class="source form-group location">
                                        <div class="wide" tabindex="0">
                                            <!-- <span class="current"><i class="fa fa-map-marker"></i></span> -->
                                            <select class="list select2" name="source" id="sourcelist">
                                            <option value="" selected>From</option>
                                            @foreach($sources as $sourcesnew)
                                                   <option class="option" value="{{$sourcesnew->name}}" @if(isset($_GET['source']) && $_GET['source']==$sourcesnew->name) selected @endif>{{$sourcesnew->name}}</option>
                                             @endforeach
                                               
                                            </select>
                                        </div>
                                    </div>
                                    <!--/ End Form Location -->
                                    <!-- Form Location -->
                                    <div class="form-group location">
                                        <div class="wide" tabindex="0">
                                            <!-- <span class="current"><i class="fa fa-map-marker"></i>To</span> -->
                                            <select class="list select2" name="destination" id="destinationlist">
                                            <option value="" selected>To</option>
                                            @foreach($sources as $sourcesnew)
                                                   <option class="option" value="{{$sourcesnew->name}}" @if(isset($_GET['destination']) && $_GET['destination']==$sourcesnew->name) selected @endif>{{$sourcesnew->name}}</option>
                                             @endforeach
                                               
                                            </select>
                                        
                                        </div>
                                    </div>
                                    <!--/ End Form Location -->
                                    <!-- Form Categories -->
                                    <div class="form-group categories">
                                        <div class="wide" tabindex="0">
                                            <!-- <span class="current"><i class="fa fa-bus" aria-hidden="true"></i>All Vehicles</span> -->
                                            <select class="list select2" name="vehicle_type" id="vehicle_typelist">
                                            <option value="" selected>Vehicle Type</option>
                                            @foreach($vehicletypes as $vehicletypesnew)
                                                   <option class="option" value="{{$vehicletypesnew->id}}" @if(isset($_GET['vehicle_type']) && $_GET['vehicle_type']==$vehicletypesnew->vehicle_name) selected @endif>{{$vehicletypesnew->vehicle_name}}</option>
                                             @endforeach
                                               
                                            </select>
                                        <!-- <input type="hidden" id="vehicle_type" name="vehicle_type" value="">-->
                                            <!-- <ul class="list" name="vehicle_type" id="vehicletypelist">
                                             
                                                <li data-value="1" class="option selected ">Hotels</li>
                                                <li data-value="2" class="option">Restaurants</li>
                                                <li data-value="3" class="option">Events</li>
                                                <li data-value="3" class="option">Fitness</li>
                                                <li data-value="3" class="option">Cinema</li>
                                                <li data-value="3" class="option">Shops</li>
                                                <li data-value="3" class="option">Car Dealer</li>
                                            </ul> -->
                                        </div>
                                    </div>
                                    <!--/ End Form Categories -->
                                    <!-- Form Button -->
                                    <div class="form-group button">
                                        <button type="submit" class="btn">Search</button>
                                    </div>
                                    <!--/ End Form Button -->
                                </form>
                            </div>
                            <!--/ End Search Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END HEADER SEARCH -->

    @if(isset($_SESSION['userid']) && count($ads)>0)

        <!-- START SECTION HOW IT WORKS -->
        <section class="how-it-works">
                <div class="container">
                    <div class="row service-1">
                        <!-- Carousel -->
                        <div id="demo" class="carousel slide" data-bs-ride="carousel">

                            <!-- Indicators/dots -->
                            <div class="carousel-indicators">
                            @php $y=1;$slide=0; @endphp
                            @if(count($ads)>0)
                            @foreach($ads as $adsnew)
                                    @php $newcity=explode(",",$adsnew->locations); @endphp
                                        
                                    @if(isset($_SESSION['userid']) && $adsnew->locations=='All')
                                    
                                        <button type="button" data-bs-target="#demo" data-bs-slide-to="{{$slide++}}" class="@if($y++==1) active @endif"></button>
                                    @elseif(isset($_SESSION['userid']) && (in_array($usercity, $newcity)))
                                        <button type="button" data-bs-target="#demo" data-bs-slide-to="{{$slide++}}" class="@if($y++==1) active @endif"></button>
                                    @endif
                                    
                            @endforeach
                            @endif
                            </div>
    

    <!-- The slideshow/carousel -->
    <div class="carousel-inner" style="text-align: center;">
                @php $x=1; @endphp
                @if(count($ads)>0)
                @foreach($ads as $adsnew)
                    @php $newcity=explode(",",$adsnew->locations); @endphp
                   
                    @if(isset($_SESSION['userid']) && $adsnew->locations=='All')
                        
                            @if($adsnew->ad_type=='Image')
                            
                            <div class="carousel-item @if($x++==1) active @endif">
                            <a href="{{$adsnew->ad_link}}" target="_blank" class="">
                                <img class="img-responsive" src="/webapp-assets/ads/{{$adsnew->ad_banner}}" alt="" style="height:300px; width: 100%;">
                                </a>
                            </div>
                            
                            @elseif($adsnew->ad_type=='Video')
                            <div class="carousel-item @if($x++==1) active @endif">
                            <a href="{{$adsnew->ad_link}}" target="_blank" class="">
                                                <video loop autoplay muted style="height:300px; width: 100%;">
                                                    <source src="/webapp-assets/ads/{{$adsnew->ad_banner}}" type="video/mp4">
                                                </video>
                                        </a>
                            </div>
                            @elseif($adsnew->ad_type=='Youtube')

                                                    <div class="carousel-item @if($x++==1) active @endif">
                                                    <a href="{{$adsnew->ad_link}}" target="_blank" class="">
                                                    {!!$adsnew->ad_banner!!}
                                                                </a>
                                                    </div>
                            @endif
                    
                    @elseif(isset($_SESSION['userid']) && (in_array($usercity, $newcity)))
                   
                            @if($adsnew->ad_type=='Image')
                            
                            <div class="carousel-item @if($x++==1) active @endif">
                            <a href="{{$adsnew->ad_link}}" target="_blank" class="">
                                <img class="img-responsive" src="/webapp-assets/ads/{{$adsnew->ad_banner}}" alt="" style="height:300px; width: 100%;">
                                </a>
                            </div>
                            
                            @elseif($adsnew->ad_type=='Video')
                            <div class="carousel-item @if($x++==1) active @endif">
                            <a href="{{$adsnew->ad_link}}" target="_blank" class="">
                                                <video loop autoplay muted style="height:300px; width: 100%;">
                                                    <source src="/webapp-assets/ads/{{$adsnew->ad_banner}}" type="video/mp4">
                                                </video>
                                        </a>
                            </div>
                            @elseif($adsnew->ad_type=='Youtube')

                                                    <div class="carousel-item @if($x++==1) active @endif">
                                                    <a href="{{$adsnew->ad_link}}" target="_blank" class="">
                                                    {!!$adsnew->ad_banner!!}
                                                                </a>
                                                    </div>
                            @endif
                    
                    @endif
                    @endforeach
                    @endif
    
    </div>
    
    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
    </div>
    
            </div>
        </div>
    </section>
    <!-- END SECTION HOW IT WORKS -->

@endif

    

    <!-- START SECTION POPULAR LISTINGS -->
    <section class="popular portfolio freelancers">
        <div class="container">
            <div class="sec-title">
                <h2><span>Popular </span>Listings</h2>
                <p>What are you interested.</p>
            </div>
            <div class="portfolio col-xl-12">
                <div class="slick-lancers">
                @foreach($listings as $listingsnew)
                    <div class="agents-grid text-center">
                        <div class="landscapes">
                        <div class="project-single">
                        <!-- homes content -->
                        <div class="homes-content">
                           <!-- homes address -->
                           <a href="/listing/{{$listingsnew->id}}"><h3><i class="fa fa-map-marker"></i> {{$listingsnew->source}} to {{$listingsnew->destination}}</h3>
                           <p class="homes-address text-danger">
                                  {{$listingsnew->vehicle_name}} -
                                <em>({{$listingsnew->vehicletype}})</em></span>
                           </p>
                           <p class="homes-address text-warning">
                              Seats: {{$listingsnew->available_seats}}
                           </p>
                           <h3 class="pt-2">
                              Fare: ₹{{$listingsnew->fare}}
                           </h3>
                           <p class="homes-address">
                                 View Details
                           </p>
                           </a>
                           
                        </div>
							</div>
                        </div>
                    </div>
                 @endforeach
                    
                </div>
            </div>
        </div>
        <div class="bg-all">
            <a href="/all-listings" class="btn btn-outline-light">View All</a>
        </div>
    </section>
    <!-- END SECTION POPULAR LISTINGS -->

    <!-- START SECTION HOW IT WORKS -->
    <section class="how-it-works">
        <div class="container">
            <div class="sec-title">
                <h2><span>How </span>It Works</h2>
                <p>There are many variations of lorem of Lorem.</p>
            </div>
            <div class="row service-1">
                <article class="col-lg-4 col-md-6 col-xs-12 serv">
                    <div class="serv-flex">
                        <div class="art-1 img-1">
                            <img src="/webapp-assets/images/map.png" alt="">
                            <h3>Need To Travel? Find A Travel Buddy</h3>
                        </div>
                        <div class="service-text-p">
                            <p class="text-center">lorem ipsum dolor sit amet, consectetur pro adipisici consectetur debits adipisicing lacus consectetur Business Directory.</p>
                        </div>
                    </div>
                </article>
                <article class="col-lg-4 col-md-6 col-xs-12 serv">
                    <div class="serv-flex">
                        <div class="art-1 img-2">
                            <img src="/webapp-assets/images/contact.png" alt="">
                            <h3>Contact The Owner</h3>
                        </div>
                        <div class="service-text-p">
                            <p class="text-center">lorem ipsum dolor sit amet, consectetur pro adipisici consectetur debits adipisicing lacus consectetur Business Directory.</p>
                        </div>
                    </div>
                </article>
                <article class="col-lg-4 col-md-6 col-xs-12 serv mb-0 pt">
                    <div class="serv-flex arrow">
                        <div class="art-1 img-3">
                            <img src="/webapp-assets/images/user.png" alt="">
                            <h3>Make a Reservation</h3>
                        </div>
                        <div class="service-text-p">
                            <p class="text-center">lorem ipsum dolor sit amet, consectetur pro adipisici consectetur debits adipisicing lacus consectetur Business Directory.</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <!-- END SECTION HOW IT WORKS -->


    <!-- START SECTION PRICING -->
    <!-- <section class="pricing-table">
        <div class="container">
            <div class="sec-title">
                <h2><span>Pricing </span>Packages</h2>
                <p>There are many variations of lorem of Lorem.</p>
            </div>
            <div class="row">
            @foreach($packages as $packagesnew)
               
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <div class="plan text-center">
                        <span class="plan-name">{{$packagesnew->plan_name}} <small>{{$packagesnew->per_limit}} Days</small></span>
                        <p class="plan-price"><sup class="currency">₹</sup><strong>{{$packagesnew->new_price}}</strong><sub><del>₹{{$packagesnew->old_price}}</del></sub></p>
                        
                        {!!$packagesnew->description!!} 
                        
                        @if(isset($_SESSION['userid']))
                                                <form method="POST" class="paymentform">
                                                        {{ csrf_field() }}
                                                            
                                                            <input type="hidden" class="user_id" name="user_id" value="{{$_SESSION['userid']}}">
                                                            <input type="hidden" name="username" value="{{$_SESSION['username']}}" class="payment-name">
                                                            <input type="hidden" name="email" class="payment-email" value="{{$_SESSION['useremail']}}">
                                                            <input type="hidden" name="phone" class="payment-phone" value="<{{$_SESSION['userphone']}}">

                                                            <input type="hidden" class="package_id" name="package_id" value="{{$packagesnew->id}}">
                                                            
                                                            <input type="hidden" class="payment-amount" name="amount" value="{{$packagesnew->new_price*100}}">
                                                            
                                                            <button type="submit" class="btn btn-secondary btn-lg">Buy</button>
                                                        </form>   
                        @else
                        <a href="/login" class="btn btn-secondary btn-lg">Buy</a>
                        @endif                   
                        
                    </div>
                </div>
              
            @endforeach
               
            </div>
        </div>
    </section> -->
    <!-- END SECTION PRICING -->

    <!-- START SECTION TESTIMONIALS -->
    <section class="testimonials">
        <div class="container">
            <div class="sec-title">
                <h2><span>People </span>Says</h2>
                <p>There are many variations of lorem of Lorem.</p>
            </div>
            <div class="owl-carousel style1">
                <div class="test-1">
                    <p class="mb-3">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec.</p>
                    <img src="/webapp-assets/images/testimonials/ts-1.jpg" alt="">
                    <h3 class="mt-3">Lisa Smith</h3>
                    <h6>New York</h6>
                    <ul class="starts text-center">
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                    </ul>
                </div>
                <div class="test-1">
                    <p class="mb-3">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec.</p>
                    <img src="/webapp-assets/images/testimonials/ts-2.jpg" alt="">
                    <h3 class="mt-3">Jhon Morris</h3>
                    <h6>Los Angeles</h6>
                    <ul class="starts text-center">
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star-o"></i>
                        </li>
                    </ul>
                </div>
                <div class="test-1">
                    <p class="mb-3">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec.</p>
                    <img src="/webapp-assets/images/testimonials/ts-3.jpg" alt="">
                    <h3 class="mt-3">Mary Deshaw</h3>
                    <h6>Chicago</h6>
                    <ul class="starts text-center">
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                    </ul>
                </div>
                <div class="test-1">
                    <p class="mb-3">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec.</p>
                    <img src="/webapp-assets/images/testimonials/ts-4.jpg" alt="">
                    <h3 class="mt-3">Gary Steven</h3>
                    <h6>Philadelphia</h6>
                    <ul class="starts text-center">
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star-o"></i>
                        </li>
                    </ul>
                </div>
                <div class="test-1">
                    <p class="mb-3">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec.</p>
                    <img src="/webapp-assets/images/testimonials/ts-5.jpg" alt="">
                    <h3 class="mt-3">Cristy Mayer</h3>
                    <h6>San Francisco</h6>
                    <ul class="starts text-center">
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                    </ul>
                </div>
                <div class="test-1">
                    <p class="mb-3">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec.</p>
                    <img src="/webapp-assets/images/testimonials/ts-6.jpg" alt="">
                    <h3 class="mt-3">Ichiro Tasaka</h3>
                    <h6>Houston</h6>
                    <ul class="starts text-center">
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star-o"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION TESTIMONIALS -->

    
         @include('webapp.layout.footer')

<script>
   $("#sourcelist li").click(function(){
      $("#source").val($(this).attr("value"));
   });
   $("#destinationlist li").click(function(){
      $("#destination").val($(this).attr("value"));
   });
   $("#vehicletypelist li").click(function(){
      $("#vehicle_type").val($(this).attr("value"));
   });
@if(!isset($_SESSION['userid']))
	$(window).on('load', function() {
        $('#loginModal').modal('show');
    });
	@endif
</script>