@extends("layout")

@section('title',$title)

@section('content')
<?php $ct = (isset($category) && $category != null) ? " - ".$category : ""; $product="deals"; ?>
@include('generic-banner',['title' => $title.$ct])


	<!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">
			 <input type="hidden" id="q" value="{{$q}}"/>
				@include('deals-filter')

				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
				  <div class="row">
				  @if(count($deals) > 0)
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
                                      	   $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$images[$x]['url'];
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
						<div class="col-lg-4 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
									<div class="tag-sale">{{strtoupper($ttag)}}</div>
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
						</div>
				  @endforeach
				    @if(count($deals) > 0)
						<div class="text-center w-100 pt-3">
							<button class="site-btn sb-line sb-dark">LOAD MORE</button>
					    </div>
				    @endif
                  @else
                  <div class="col-lg-12">
			        <p class="text-primary">No deals at the moment. Check back later? </p>
				  </div>
                  @endif
			     </div>
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->
@stop