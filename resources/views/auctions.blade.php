@extends("layout")

@section('title',$title)

@section('content')
<?php $ct = (isset($category) && $category != null) ? " - ".$category : ""; $product="auctions"; ?>
@include('generic-banner',['title' => $title.$ct])

<script>let nq = "";</script>
	<!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">
			 <input type="hidden" id="q" value="{{$q}}"/>
				@include('deals-filter')

				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row">
					@if(count($auctions)  > 0)
                     @foreach($auctions as $a)
				      <?php
                    $deal = $a['deal'];
                    $data = $deal['data'];
                    $images = $deal['images'];
                         shuffle($images);
                         $imggs = [];
                         
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
                    $du = url('deal')."?sku=".$deal['sku'];
					
					if($a['status'] == "ended") $frf = "frf";
					else if($a['status'] == "live") $frf = "wyret";
                  ?>
						<div class="col-lg-4 col-sm-6 wow fadeInUp">
							<div class="product-item">
							  <div class="row">
							     <div class="col-lg-9 col-xs-9"><div class="deal-clock" id="cdc-{{$a['id']}}"></div></div>
							     <div class="col-lg-3 col-xs-3"><span class="inline text-left">{{$a['total-bids']}} bids</span></div>
							   </div>
							          <script>
	ertyw = "{{$frf}}";
	nq = new Date("{{$a['ed']}}");
    getcd(nq,"cdc-{{$a['id']}}");
</script>
								<div class="pi-pic">
									<div class="tag-sale">LIVE</div>
									<img src="{{$imggs[0]}}" class="cli" data-cli="{{$du}}" alt="{{$deal['name']}}">
									<div class="pi-links">
									<?php
									      $bidURL= url("bid")."?sku=".$deal['sku'];
                                          $buyURL = url("buy")."?sku=".$deal['sku']."&qty=1";
                                          $bp = number_format((float)$a['buy_price'],2);
                                         ?>
										<a href="{{$bidURL}}" class="add-card"><i class="flaticon-bag"></i><span>PLACE BID</span></a>
										<a href="{{$buyURL}}" class="add-card"><i class="flaticon-credit-card"></i><span>BUY: &#8358;{{$bp}}</span></a>
									</div>
								</div>
								<div class="pi-text">
									<h6>&#8358;{{number_format((float)$a['auction_price'], 2)}}</h6>
									<p>{{$deal['name']}}</p>
								</div>
							</div>
						</div>
						 @endforeach
                  @else
					<div class="col-lg-12 wow fadeInUp">
                      <p class="text-primary">No auctions at the moment. Check back later? </p>
					</div>
                  @endif
				  @if(count($auctions) > 12)
						<div class="text-center w-100 pt-3">
							<button class="site-btn sb-line sb-dark">LOAD MORE</button>
						</div>
				  @endif
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Category section end -->
@stop