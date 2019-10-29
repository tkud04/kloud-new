@extends("layout")

@section('title',$deal['name'])


@section('content')
<?php
$rupture = "Not Available";
if($deal['status'] == "approved") $rupture = $deal['name'];
?>
@include('generic-banner',['title' => $rupture])

 <?php
                                      $images = $deal['images'];
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
                                      
                                      $data = $deal['data'];
                                     
                                    ?>

	<!-- product section -->
	<section class="product-section">
		<div class="container">
		@if($deal['status'] == "approved")
			<div class="back-link">
				<a href="{{url('top-deals')}}"> &lt;&lt; Go to Top deals</a>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="product-pic-zoom">
						<img class="product-big-img" src="{{$imggs[0]}}" alt="{{$deal['name']}}">
					</div>
					<div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
						<div class="product-thumbs-track">
						    <?php
							for($gmi = 0; $gmi < count($imggs); $gmi++)
							{
								$pi = $imggs[$gmi];
								$sxt = "";
								if($gmi == 0) $sxt = " active";
							?>
							<div class="pt {{$sxt}}" data-imgbigurl="{{$pi}}"><img src="{{$pi}}" alt=""></div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
				<div class="col-lg-6 product-details">
				<?php
                                 $kp = $data['amount']; $op = "";
                                 $auction = $deal['auction'];
                                 if(count($auction) > 0 && $auction['status'] == "live"){
									 $kp = $auction['auction_price'];
									 $op = "<p class='avaibility'><i class='fa fa-times-circle'></i> <s>&#8358;".number_format($data['amount'],2)."</s></p>";
									 if($auction['status'] == "ended") $frf = "frf";
					                 else if($auction['status'] == "live") $frf = "wyret";
								 }	
                                ?>
					<h2 class="p-title">{{$deal['name']}}</h2>
					<h3 class="p-price">&#8358;{{number_format($kp,2)}} {!! $op !!}</h3>
					 <?php 
                              $iss = ['yes' => 'In stock','new' => 'New!','no' => 'Out of Stock'];
                                $ss = "Unavailable"; 
                                $ii = $data['in_stock'];								
                              	if(isset($iss[$ii])) $ss = $iss[$ii];
                              ?>
					<h4 class="p-stock">Available: <span>{{$ss}}</span></h4>
					<div class="p-rating">
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o fa-fade"></i>
					</div>
					<div>
					  <br>
                                        <h6>Rate this product:</h6>
                                        <form action="{{url('rate-deal')}}" method="post">
                                        	{!! csrf_field() !!}
                                           <input type="hidden" name="xf" value="{{$deal['id']}}">
                                        <select name="rating" class="form-control">
                                        	<option value="none">Select rating</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                        <button type="submit" class="mt-4 btn btn-primary">Submit</button>
                                        </form>
					</div><br>
					<div class="p-review">
						<a href="">3 reviews</a>|<a href="#">Add your review</a>
					</div>
					<div class="fw-size-choose">
					  <?php
					    $sizes = explode(",",$data['sizes']);
						if(count($sizes) < 2) $sizes = [$data['sizes']];				    
					  ?>
						<p>Size</p>
						<input type="hidden" id="sss" value="undefined"/>
						
						@for($x = 0; $x < count($sizes); $x++)
						<div class="sc-item">
							<input type="radio" name="sc" id="size-{{$x}}" onclick="var sss = document.getElementById('sss'); sss.value = '{{$sizes[$x]}}';">
							<label for="size-{{$x}}">{{$sizes[$x]}}</label>
						</div>
						@endfor
					</div>
					<div class="quantity">
						<p>Quantity</p>
                        <div class="pro-qty"><input type="text" name="qty" id="qqq" value="1"></div>
                    </div>
					<?php
                                  $cartURL = url("add-to-cart")."?sku=".$deal['sku']."&qty=";
                                  $cartText = "Add to cart";
                                  $auction = $deal['auction'];
                                  
                                 # $watchURL = url("watch")."?sku=".$deal['sku'];                                                                    
                                  $aurl = "";
                                  
                                  if(isset($mine) && $mine == "yes"){
                                  	$aurl = url('add-auction')."?xf=".$deal['id'];
                                  }
                                  if($deal['type'] == "deal"){
                                 ?>
					<a href="#" class="site-btn" onclick="var effect = document.getElementById('qqq'); var qty = effect.value; var sss = document.getElementById('sss').value; if( !isNaN( qty )) window.location = '{{$cartURL}}' + qty + '&sz=' + sss;return false;">{{$cartText}}</a>
					<?php
                                }
                                else if($deal['type'] == "auction")
                                  {
                                    $bidURL= url("bid")."?sku=".$deal['sku']."&qty=";
                                    $bidText = "Place bid";
                                    $buyURL = url("buy")."?sku=".$deal['sku']."&qty=1";
                                    $bp = "&#8358;".number_format($auction['buy_price'],2);
                                 ?>
                                 <a href="#" class="site-btn" onclick="var effect = document.getElementById('qqq'); var qty = effect.value; var sss = document.getElementById('sss').value; if( !isNaN( qty )) window.location = '{{$bidURL}}' + qty + '&sz=' + sss;return false;">{{$bidText}}</a>
                                 <a href="#" class="site-btn" onclick="var effect = document.getElementById('qqq'); var qty = effect.value; var sss = document.getElementById('sss').value; window.location = '{{$buyURL}}'+ '&sz=' + sss;return false;">Buy it now for {!! $bp !!}</a>
                                 <?php
                                 }
                                 ?>
								  @if(isset($mine) && $mine == "yes" && count($auction) < 1)
									<a href="#" class="site-btn" onclick="window.location = '{{$aurl}}';return false;">Auction this now</a>
                                @endif
					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
								{!! $data['description'] !!}
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-header" id="headingThree">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">shipping & Returns</button>
							</div>
							<div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
								<div class="panel-body">
									<h4>7 Days Returns</h4>
									<p>Cash on Delivery Available<br>Home Delivery <span>3 - 4 days</span></p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-header" id="headingTwo">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">reviews</button>
							</div>
							<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="panel-body">
									<img src="./img/cards.png" alt="">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
								</div>
							</div>
						</div>						
					</div>
					<div class="social-sharing">
						<a href=""><i class="fa fa-google-plus"></i></a>
						<a href=""><i class="fa fa-pinterest"></i></a>
						<a href=""><i class="fa fa-facebook"></i></a>
						<a href=""><i class="fa fa-twitter"></i></a>
						<a href=""><i class="fa fa-youtube"></i></a>
					</div>
				</div>
			</div>
			@else
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-primary">This deal is awaiting approval and will be uploaded once approved by KloudTransact. <br><br></p>
                    </div>
                </div>
           @endif
		</div>
	</section>
	<!-- product section end -->



	@include('more-products',['caption' => "RELATED DEALS",'deals' => $deals])

@stop