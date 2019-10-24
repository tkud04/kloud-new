@extends("layout")

@section('title',"Checkout")


@section('content')
@include('generic-banner',['title' => "Checkout"])

	<!-- checkout section  -->
	<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
					<form class="checkout-form" id="checkout-form">
					    {!! csrf_field() !!}
						<div class="cf-title">Billing Info</div>
						<div class="row">
							<div class="col-md-7">
								<p>*Confirm Your Billing Information</p>
							</div>
							<div class="col-md-5">
								<div class="cf-radio-btns address-rb">
									<div class="cfr-item">
										<input type="radio" name="pm" id="one">
										<label for="one">Use my regular address</label>
									</div>
									<div class="cfr-item">
										<input type="radio" name="pm" id="two">
										<label for="two">Use a different address</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-6">
                                        <input type="text" class="form-control" id="first_name" name="fname" value="{{$user->fname}}" data-default="{{$user->fname}}" placeholder="First Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="last_name" name="lname" value="{{$user->lname}}" data-default="{{$user->lname}}" placeholder="Last Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="company" name="company" placeholder="Company Name" value="{{$sd['company']}}" data-default="{{$sd['company']}}">
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
								 <input type="text" class="form-control" id="street_address" name="address" placeholder="Address" value="{{$sd['address']}}" data-default="{{$sd['address']}}">
							</div>
							<div class="col-md-6">
								   <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{$sd['city']}}" data-default="{{$sd['city']}}">
							</div>
							<div class="col-md-6">
                                        <select class="form-control w-100" name="state" style="margin-bottom: 10px;">
                                        <option value="none">Select state</option>
                                        <?php 
                                          foreach($states as $key => $value){
                                          	$selectedText = ($key == $sd['state']) ? "selected='selected'" : "";                                           
                                        ?>
                                        <option value="<?=$key?>" <?=$selectedText?> ><?=$value?></option>
                                        <?php 
                                          }
                                        ?>
                                    </select>
									</div>
							<div class="col-md-6">
								  <input type="text" class="form-control" id="zipCode" name="zip" placeholder="Zip Code" value="{{$sd['zipcode']}}" data-default="{{$sd['zipcode']}}">
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
						<div class="cf-title">Delievery Info</div>
						<div class="row shipping-btns">
							<div class="col-6">
								<h4>Standard</h4>
							</div>
							<div class="col-6">
								<div class="cf-radio-btns">
									<div class="cfr-item">
										<input type="radio" name="shipping" id="ship-1">
										<label for="ship-1">Free</label>
									</div>
								</div>
							</div>
							<div class="col-6">
								<h4>Next day delievery  </h4>
							</div>
							<div class="col-6">
								<div class="cf-radio-btns">
									<div class="cfr-item">
										<input type="radio" name="shipping" id="ship-2">
										<label for="ship-2">$3.45</label>
									</div>
								</div>
							</div>
						</div>
						<div class="cf-title">Payment</div>
						<ul class="payment-list">
							<li>Paypal<a href="#"><img src="img/paypal.png" alt=""></a></li>
							<li>Credit / Debit card<a href="#"><img src="img/mastercart.png" alt=""></a></li>
							<li>Pay when you get the package</li>
						</ul>
						<button class="site-btn submit-order-btn">Place Order</button>
					</form>
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Your Cart</h3>
						<ul class="product-list">
							<li>
								<div class="pl-thumb"><img src="img/cart/1.jpg" alt=""></div>
								<h6>Animal Print Dress</h6>
								<p>$45.90</p>
							</li>
							<li>
								<div class="pl-thumb"><img src="img/cart/2.jpg" alt=""></div>
								<h6>Animal Print Dress</h6>
								<p>$45.90</p>
							</li>
						</ul>
						<ul class="price-list">
							<li>Total<span>$99.90</span></li>
							<li>Shipping<span>free</span></li>
							<li class="total">Total<span>$99.90</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- checkout section end -->

@stop