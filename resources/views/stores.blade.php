@extends("layout")

@section('title',"Stores")

@section('content')
<?php $ct = (isset($category) && $category != null) ? " - ".$category : ""; ?>
@include('generic-banner',['title' => "Stores"])


	<!-- featured stores section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>Featured</h2>
			</div>
			<div class="product-slider owl-carousel">
			 @if(count($stores) > 0)
                   @foreach($stores as $s)
                      <?php
                         $img = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$s['img'];
                         if($s['img'] == null || $s['img'] == "none") $img = "img/no-image.png";
                         $flink = $s['flink'];
                         $dn = $s['name'];
                         $deals = $s['deals'];
                         $status = $s['status'];
                         $uu = url("stores")."/".$flink;
						 
						 if($s['rating'] < 1) $ratingCount = 5;
						 else $ratingCount = $s['rating'];
                      ?>
				<div class="product-item">
					<div class="pi-pic">
					   @if($status == "verified")
						  <div class="tag-new"><i class="fa fa-check fa-2x text-center"></i></div>
					   @endif
						<img src="{{$img}}" alt="">
						<div class="pi-links">
							<a href="{{$uu}}" class="add-card"><i class="flaticon-store"></i><span>GO TO STORE</span></a>
						</div>
					</div>
					<div class="pi-text">
						<h6>{{$dn}}</h6>
						<p>                   
                        @for($x = 0; $x < $ratingCount; $x++)
                          <i class="fa fa-star-o" aria-hidden="true"></i>
                        @endfor
						</p>
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</section>
	<!-- new arrivals section end -->
	
   @include('ad-banner')
	
	<!-- all stores section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>All Stores</h2>
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
	<!-- all stores section end -->
	
	
@stop