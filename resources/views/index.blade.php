@extends("layout")

@section('title',"Home")

@section('content')
@include('hero',['sliders' => $sliders])
<!-- Features section -->
	<section class="features-section wow fadeInUp">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/1.png" alt="#">
						</div>
						<h2>Fast Secure Payments</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/2.png" alt="#">
						</div>
						<h2>Premium Products</h2>
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/3.png" alt="#">
						</div>
						<h2>Fast Delivery</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Features section end -->
   <br>
   <!-- Inner categories menu -->
   <section class="product-filter-section wow fadeInUp">
     <div class="container">
   	<ul class="product-filter-menu">
	            <?php
				foreach($c as $key => $value)
				{
				  $u = url('deals').'?q='.$key;
				?>
				<li><a href="{{$u}}"><?=$value?></a></li>
				<?php
				}
				?>
			</ul>
		</div>
   </section>
   <!-- Inner categories menu end -->
   	
	<!-- Upsell section -->
		<section class="features-section wow fadeInUp">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 p-0 feature">
					<div class="">
					    <a href="{{url('airtime')}}">
						   <img class="img img-fluid img-upsell" src="img/bills.png" alt="#">
                        </a>						
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="">
					    <a href="{{url('hotels')}}">
						   <img class="img img-fluid img-upsell" src="img/hotel.jpg" alt="#">	
						</a>  
					</div>
				</div>
				<div class="col-md-4 p-0 feature">
					<div class="">
					    <a href="{{url('travelstart')}}">
						   <img class="img img-fluid img-upsell" src="img/travel.jpg" alt="#">	'
                        </a>						   
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Upsell section end -->
   <br>
   
	<!-- new arrivals section -->
	<section class="top-letest-product-section wow fadeInUp">
		<div class="container">
			<div class="section-title">
				<h2>New Arrivals</h2>
			</div>
			<div class="product-slider owl-carousel">
				@foreach($na as $d)
			   <?php
					  $images = $d['images'];
                                      $imggs = [];
                                      shuffle($images);
                         
                                      if(count($images) < 1) { $imggs = ["img/no-image.png"]; }
                                      else{
                                      	$ird = $images[0]['url'];
										if($ird == "none")
										{
											$imggs = ["img/no-image.png"];
										}
										else
										{
                                      	  for($x = 0; $x < count($images); $x++)
										  {
                                      	   $jara = "";
                                           if($x > 0) $jara = "-".($x + 1);
                                      	   $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$ird;
                                           array_push($imggs,$imgg); 
                                          }
										}
                                      } 
                                    
									   $data = $d['data'];
									   $iss = ['yes' => 'In stock','new' => 'New!','no' => 'Out of Stock'];
                                       $inStock = $data['in_stock'];									   
									   $ttag = $iss[$inStock];
									   
                                       $dealURL = url("deal")."?sku=".$d['sku'];
                                       $cartURL = url("add-to-cart")."?sku=".$d['sku']."&qty=1";
									   
									   $kp = $data['amount'];
                                       $auction = $d['auction'];
                                       if(count($auction) > 0 && $auction['status'] == "live") $kp = $auction['auction_price'];
					                ?>
				<div class="product-item">
					<div class="pi-pic">
						<img src="{{$imggs[0]}}" class="cli" data-cli="{{$dealURL}}" alt="{{$d['name']}}">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>&#8358;{{number_format((float)$kp,2)}}</h6>
						<p>{{$d['name']}}</p>
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- new arrivals section end -->
	
@include('ad-banner',['data' => $indexAd])

  <?php
  $filters = ['HOTTEST DEALS' => $hd, 'BEST SELLERS' => $bs, 'HOT CATEGORIES' => $hc];
  
  foreach($filters as $key => $value)
  {
  	$filterTitle = $key; 
      shuffle($value);
  ?>
  
  @include("product-filter",['filterTitle' => $key,'deals' => $value])
  @if($filterTitle == "BEST SELLERS")
    @include('ad-banner',['data' => $indexAd])
  @endif
  <?php
  }
  ?>

<!-- Features section -->
	<section class="features-section wow fadeInUp">
		<div class="container-fluid">
			<div class="row">
				
				<div class="col-md-12 p-0 feature">
					<div class="feature-inner">
						<div class="feature-icon">
							<img src="img/icons/2.png" alt="#">
						</div>
						<h2>100% Guarantee On All Deals!</h2>
					</div>
				</div>
				
			</div>
		</div>
	</section><br>
	<!-- Features section end -->
@stop
