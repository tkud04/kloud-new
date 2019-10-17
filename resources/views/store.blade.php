@extends("asset_layout")

@section('title',$title)

@section('content')
<?php
$ct = (isset($category) && $category != null) ? " - ".$category : ""; 
$deals = (isset($store["deals"])) ? $store["deals"] : [];

$img = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$store['img'];
 if($store['img'] == "none") $img = "https://via.placeholder.com/150";
?>

@include('generic-banner',['title' => $title.$ct])


		<!-- deals section -->
	<section class="top-letest-product-section">
		<div class="container">
		<div class="row">
			   <div class="col-lg-12 text-center">
			     <marquee>{!! $store['description'] !!}</marquee>
			   </div>
			</div><br><br>
			<div class="section-title">
				<h2>Top Deals</h2>
			</div>
			<div class="product-slider owl-carousel">
				<div class="product-item">
					<div class="pi-pic">
						<img src="{{asset('./img/product/1.jpg')}}" alt="">
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
						<img src="{{asset('./img/product/2.jpg')}}" alt="">
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
						<img src="{{asset('./img/product/3.jpg')}}" alt="">
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
							<img src="{{asset('./img/product/4.jpg')}}" alt="">
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
							<img src="{{asset('./img/product/6.jpg')}}" alt="">
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
			</div><br>
			<center><a href="{{url('manage-my-store')}}" class="site-btn">Go to your store dashboard</a></center>
		</div>
	</section>
	<!-- deals section end -->
@stop