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
				<div class="product-item">
					<div class="pi-pic">
						<img src="./img/product/1.jpg" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>&#8358;20,000.00</h6>
						<p>Flamboyant Pink Top </p>
					</div>
				</div>
				<div class="product-item">
					<div class="pi-pic">
						<div class="tag-new">New</div>
						<img src="./img/product/2.jpg" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>&#8358;20,000.00</h6>
						<p>Black and White Stripes Dress</p>
					</div>
				</div>
				<div class="product-item">
					<div class="pi-pic">
						<img src="./img/product/3.jpg" alt="">
						<div class="pi-links">
							<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>&#8358;20,000.00</h6>
						<p>Flamboyant Pink Top </p>
					</div>
				</div>
				<div class="product-item">
						<div class="pi-pic">
							<img src="./img/product/4.jpg" alt="">
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>&#8358;20,000.00</h6>
							<p>Flamboyant Pink Top </p>
						</div>
					</div>
				<div class="product-item">
						<div class="pi-pic">
							<img src="./img/product/6.jpg" alt="">
							<div class="pi-links">
								<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
							<h6>&#8358;20,000.00</h6>
							<p>Flamboyant Pink Top </p>
						</div>
					</div>
			</div>
		</div>
	</section>
	<!-- new arrivals section end -->
	
@include('ad-banner')

  <?php
  $filterTitles = ['HOTTEST DEALS','BEST SELLERS','HOT CATEGORIES'];
  
  foreach($filterTitles as $ft)
  {
  	$filterTitle = $ft; 
  ?>
  
  @include("product-filter",['filterTitle' => $filterTitle])
  @if($filterTitle == "BEST SELLERS")
    @include('ad-banner')
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
