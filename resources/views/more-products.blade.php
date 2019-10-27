<!-- RELATED PRODUCTS section -->
	<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2>{{$caption}}</h2>
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
                                      	  for($x = 0; $x < $images[0]['irdc']; $x++)
										  {
                                      	   $jara = "";
                                           if($x > 0) $jara = "-".($x + 1);
                                      	   $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$ird.$jara;
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
	<!-- RELATED PRODUCTS section end -->