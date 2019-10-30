@extends("layout")

@section('title',"Register")

@section('content')
@include('generic-banner',['title' => "Register"])

<!-- kloudpay section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <form class="checkout-form" action="{{url('mregister')}}" method="post">
				{!!csrf_field()!!}
				<input type="hidden" name="dcd" value="jax" required>
									<input type="hidden" name="ird" id="ird" value="" required>
									
					<?php
								 $fname = ""; $lname = ""; $email = "";
								 $phone = "";
								 
								 if(isset($user) && $user !== null){
									 $fname = $user->fname; $lname = $user->lname; $email = $user->email;
								     $phone = $user->phone;
								 }
								?>
						<div class="cf-title">Creating your own store is super easy! Just fill in the details below and we are good to go.</div>
						<div class="row address-inputs">
							<div class="col-md-6">
								 <input type="text" class="form-control" name="fname" value="{{$fname}}" placeholder="First name" required>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lname" value="{{$lname}}" placeholder="Last name" required>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{$email}}" placeholder="Valid email address" required>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" name="phone" value="{{$phone}}" placeholder="Phone number" required>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
												<input type="text" class="form-control" name="sname" value="" placeholder="Your store name" required><br>
                                        <textarea class="form-control" name="description" value="" placeholder="Enter store description" required></textarea>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
                                 <textarea class="form-control" name="pickup_address" value="" placeholder="Enter pickup address (Number, Street, City, State)" required></textarea>
							</div>
						</div>
                        <div class="row address-inputs">
							<div class="col-md-6">
								 <input type="text" class="form-control" name="flink" value="" placeholder="Friendly URL" required>
							</div>
							<div class="col-md-6">
	<button id="store-upload" class="cloudinary-button">Upload</button>
                                       <span id="cloudinary-loading">It usually takes a few minutes to upload images so please be patient when you click Upload above :)</span>
							</div>
						</div>
						 @if($user == null)
						<div class="row address-inputs">
							<div class="col-md-6">
								 <input type="password" class="form-control" name="pass" value="" placeholder="Password" required>
							</div>
							<div class="col-md-6">
								<input type="password" class="form-control" name="pass_confirmation" value="" placeholder="Confirm password" required>
							</div>
						</div>
						@endif

						<button type="submit" class="site-btn submit-order-btn">Submit</button>
					</form>
          </div>
        </div>
		</div>
	</section>
	<!-- kloudpay section end -->
	

@stop