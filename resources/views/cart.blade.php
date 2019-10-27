@extends("layout")

@section('title',"Cart")


@section('content')
@include('generic-banner',['title' => "Cart"])

 	<!-- cart section -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
				<form action="{{url('update-cart')}}" method="post">
                	      {!! csrf_field() !!}
					<div class="cart-table">
						<h3>Your Cart</h3>
						<div class="cart-table-warp">
							<table>
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th class="quy-th">Quantity</th>
									<th class="size-th">Size</th>
									<th class="size-th">Color</th>
									<th class="total-th">Price</th>
									<th class="total-th">Actions</th>
								</tr>
							</thead>
							<tbody>
							  @if(count($cart) > 0)
                              @foreach($cart as $c) 
						      <?php
                                    $vid = "qty-".$c['id'];
                                     $deal = $c['deal'];
                                     if(count($deal) < 1){
                                   	$amount = 0;
                                       $qty = 0;
                                       $du = "#";
                                       $deal = ['name' => "<s>Deleted</s>",
                                                   'data' => ['amount'=> 0]
                                          ];
                                       $imgg = "img/no-image.png";
                                       $removeURL = url('remove-from-cart').'?asf='.$c['id'];
                                     }
                                     else{
                                        $data = $deal['data'];
                                        $pay = $data['amount'];
                                        
                                        if($c['type'] == "auction"){
                                        	$b = $c['bid'];
                                            if($b != null){
                                            	$pay = $b->pay;
                                            }
                                        }
                                        $images = $deal['images'];
                                        shuffle($images);
                                        $ird = $images[0]['url'];
										if($ird == "none") $imgg = "img/no-image.png"; 
                                        else $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$ird;
                                        $du = url('deal')."?sku=".$deal['sku'];
                                        $removeURL = url('remove-from-cart').'?asf='.$deal['sku'];
                                        }
                                    ?>
								<tr>
									<td class="product-col">
										<img src="{{$imgg}}" alt="" data-cli="{{$du}}">
										<div class="pc-title">
											<h4><a href="{{$du}}">{{$deal['name']}}</a></h4>
											<p></p>
										</div>
									</td>
									<td class="quy-col">
										<div class="quantity">
					                        <div class="pro-qty">
												<input type="text" id="{{$vid}}" name="quantity[]" value="{{$c['qty']}}">
											</div>
                    					</div>
									</td>
									<td class="size-col"><h4>{{$c['size']}}</h4></td>
									<td class="size-col"><h4>c['color']</h4></td>
									<td class="total-col"><h4>&#8358;{{number_format((float)$pay,2)}}</h4></td>
									<td class="total-col"><a href="{{$removeURL}}" class="btn btn-danger">Remove</a></td>
								</tr>
								
								@endforeach
								@endif
							</tbody>
							  <tfoot>
                                    <tr>
                                        <center><button type="submit" class="btn btn-success">Update cart</button></center>
                                    </tr>
                                </tfoot>
						</table>
						</div>
						 <?php
                                     $subtotal = $cartTotals['subtotal'];
                                     $delivery = $cartTotals['delivery'];
                                     $total = $cartTotals['total'];
                                    ?>
						<div class="total-cost">
							<h6>Subtotal: <span>&#8358;{{number_format((float)$subtotal,2)}}</span></h6>
							<h6>Delivery: <span>&#8358;{{number_format((float)$delivery,2)}}</span></h6>
							<h6>Total: <span>&#8358;{{number_format((float)$total,2)}}</span></h6>
						</div>
					</div>
					</form>
				</div>
				<div class="col-lg-4 card-right">
					<form class="promo-code-form">
						<input type="text" placeholder="Enter promo code">
						<button>Submit</button>
					</form>
					<a href="{{url('checkout')}}" class="site-btn">Proceed to checkout</a>
					<a href="{{url('top-deals')}}" class="site-btn sb-dark">Continue shopping</a>
				</div>
			</div>
		</div>
	</section>
	<!-- cart section end -->


	@include('more-products',['caption' => "CONTINUE SHOPPING",'deals' => $deals])

@stop