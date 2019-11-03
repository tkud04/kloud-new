@extends("asset_layout")

@section('title',$title)

@section('content')
<?php
$ct = (isset($category) && $category != null) ? " - ".$category : ""; 
$deals = (isset($store["deals"])) ? $store["deals"] : [];

$img = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$store['img'];
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
			   @foreach($deals as $d)
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
			
            <br>
			<center><a href="{{url('manage-my-store')}}" class="site-btn">Go to your store dashboard</a></center>
		</div>
	</section>
	<!-- deals section end -->
@stop