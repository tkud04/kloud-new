@extends("layout")

@section('title',"Checkout")


@section('content')
@include('generic-banner',['title' => "Checkout"])

<?php
echo "<script>";
echo "let sds = {";
if(count($sd) > 0)
{
  foreach($sd as $s)
  {
	  $addressText = "";
	  if($s['address'] != "")	$addressText = $s['address'].",".$s['city'].",".$s['state'].",".$s['zipcode'];
	  echo $s['id'].": '".$addressText."',";
  }
}
echo "};</script>";
?>
	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
					<form class="checkout-form" id="checkout-form" method="post">
					    {!! csrf_field() !!}
						<input type="hidden" name="sd" id="_sd" value="none"/>
						<div class="cf-title">Billing Info</div>
						<div class="row">
							<div class="col-md-7">
								<p>*Confirm Your Billing Information</p>
							</div>
							<div class="col-md-5">
								<div class="address-rb">
								    <p class="form-plaintext">Which shipping address do you want to use?</p>
									<select class="form-control" id="sd">
									   
									   @if(count($sd) > 0)
									   @foreach($sd as $s)
									   <?php
									     if(isset($sdd['address']) && $s['address'] != "")
										 {
											 $addd = $s['address'].", ".$s['city'].", ".$s['state'];
										 
									   ?>
									   <option value="{{$s['id']}}">{{$addd}}</option>
									   <?php
										 }
									   ?>
									   @endforeach
									   @endif
									   <option value="none">Add new shipping address</option>
									</select>
								</div>
							</div>
						</div>
						<?php
						 $company = ""; $address = ""; $city = ""; $state = ""; $zipcode = "";
						 
						 if(count($sd) > 0 && count($sdd) > 0)
						 {
							 if(isset($sdd['company'])) $company = $sdd['company'];
							 if(isset($sdd['address'])) $address = $sdd['address'];
							 if(isset($sdd['city'])) $city = $sdd['city'];
							 if(isset($sdd['zipcode'])) $zipcode = $sdd['zipcode'];
							if(isset($sd[0]['state'])) $state = $sd[0]['state'];
						 } 
						?>
						<div class="row address-inputs">
							<div class="col-md-6">
                                        <input type="text" class="form-control" id="first_name" name="fname" value="{{$user->fname}}" data-default="{{$user->fname}}" placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="last_name" name="lname" value="{{$user->lname}}" data-default="{{$user->lname}}" placeholder="Last Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="company" name="company" placeholder="Company Name" value="{{$company}}" data-default="{{$company}}">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}" data-default="{{$user->email}}">
                                    </div>
                                    <div class="col-md-12">
                                        <select class="form-control w-100" id="country" style="margin-bottom: 10px;">
                                           <option value="ng">Nigeria</option>
                                        </select>
                                    </div>
                                    
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								 <input type="text" class="form-control" id="street_address" name="address" placeholder="Address" value="{{$address}}" data-default="{{$address}}">
							</div>
							<div class="col-md-6">
								   <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{$city}}" data-default="{{$city}}">
							</div>
							<div class="col-md-6">
                                        <select class="form-control w-100" id="state" name="state" style="margin-bottom: 10px;">
                                        <option value="none">Select state</option>
                                        <?php 
                                          foreach($states as $key => $value){
                                          	$selectedText = ($key == $state) ? "selected='selected'" : "";                                           
                                        ?>
                                        <option value="<?=$key?>" <?=$selectedText?> ><?=$value?></option>
                                        <?php 
                                          }
                                        ?>
                                    </select>
									</div>
							<div class="col-md-6">
								  <input type="text" class="form-control" id="zipCode" name="zip" placeholder="Zip Code" value="{{$zipcode}}" data-default="{{$zipcode}}">
							</div>
							<div class="col-md-6">
                                <input type="text" class="form-control" id="phone_number" name="phone" min="0" placeholder="Phone No" value="{{$user->phone}}" data-default="{{$user->phone}}">
                            </div>
							<div class="col-md-12">
                                        <div class="custom-control custom-checkbox d-block mb-2">
                                            <input type="checkbox" class="custom-control-input" id="customCheck2" name="terms">
                                            <label class="custom-control-label" for="customCheck2">I accept <a href="#">terms and conditions</a></label>
                                        </div>
                                        <div class="custom-control custom-checkbox d-block">
                                            <input type="checkbox" class="custom-control-input" name="ssa" id="customCheck3">
                                            <label class="custom-control-label" for="customCheck3">Save this address</label>
                                        </div>
                            </div>
						</div>
						            <?php
                                     $subtotal = $cartTotals['subtotal'];
                                     $delivery = $cartTotals['delivery'];
                                     $total = $cartTotals['total'];
                                     $md = $cartTotals['md'];
                                     $md['type'] = 'checkout';
                                    ?>
                         
						 <input type="hidden" id="cod-action" value="{{url('checkout')}}">
                            	<input type="hidden" id="card-action" value="{{url('pay')}}">
                            	
                             <script>
                             	let mc = {
                             	                'type': 'checkout',
                                                 'comment': '',
                                                 'company': "{{$company}}",
                                                 'address': "{{$address}}",
                                                 'city': "{{$city}}",
                                                 'state': "{{$state}}",
                                                 'zip': "{{$zipcode}}",
                                                 'ssa': "off"
                                             };
                             
                             </script>
                            <!-- payment form -->
                            	<input type="hidden" name="email" value="{{$user->email}}"> {{-- required --}}
                            	<input type="hidden" name="amount" value="{{$total * 100}}"> {{-- required in kobo --}}
                            	<input type="hidden" name="metadata" id="nd" value="" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                            
                                <input type="hidden" id="meta-comment" value="">  
                            <!-- End payment form -->
							
						 
						<button id="pay-cod" class="site-btn submit-order-btn" style="margin-bottom: 10px;">Pay with KloudPay</button><br>
						<button id="pay-card" class="site-btn submit-order-btn">Pay with Credit card</button>
					</form>
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Your Cart</h3>
						
						<ul class="product-list">
						   @if(count($cart) > 0)
                           @foreach($cart as $c)
					       <?php
						     $deal = $c['deal'];
                                     if(count($deal) < 1){
                                   	      $pay = 0;
                                       
                                       $deal = ['name' => "<s>Deleted</s>",
                                                   'data' => ['amount'=> 0]
                                          ];
                                       $imgg = "img/no-image.png";
                                     
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
                                        else $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$ird;
                                        
                                        }
						   ?>
							<li>
								<div class="pl-thumb"><img src="{{$imgg}}" alt="{{$deal['name']}}"></div>
								<h6>{{$deal['name']}}</h6>
								<p>&#8358;{{number_format((float)$pay,2)}}</p>
							</li>
							@endforeach
							@endif
						</ul>
						<?php
                                     $subtotal = $cartTotals['subtotal'];
                                     $delivery = $cartTotals['delivery'];
                                     $total = $cartTotals['total'];
                                    ?>
						<ul class="price-list">
							<li>Subtotal<span>&#8358;{{number_format((float)$subtotal,2)}}</span></li>
							<li>Delivery<span>&#8358;{{number_format((float)$delivery,2)}}</span></li>
							<li class="total">Total<span>&#8358;{{number_format((float)$total,2)}}</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- checkout section end -->

@stop

@section('scripts')
<script>
console.log(sds);
$('#sd').change(function(){
	let sdVal = $(this).val();
	let city = "", state = "", address = "", zipcode = "";
	if(sdVal == "none"){
		
	}
	else{
	   let selectedAddress = sds[sdVal];
	   console.log(`sa: ${selectedAddress}`);
	
	   if(selectedAddress == ""){
		
	   }
	   else{
		   let saArray = selectedAddress.split(',');
		   console.log(saArray);
		   if(saArray.length > 3){
		     address = saArray[0], city = saArray[1], state = saArray[2], zipcode = saArray[3];
		   }
	   }
	}
	
	$('#street_address').val(address);
	$('#city').val(city);
	$('#state').val(state);
	$('#zipCode').val(zipcode);
	
	$('#_sd').val(sdVal);
});
</script>
@stop