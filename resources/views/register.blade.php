@extends("layout")

@section('title',"Register")

@section('content')
@include('generic-banner',['title' => "Register"])

<!-- kloudpay section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <form class="checkout-form" action="{{url('register')}}" method="post">
				{!!csrf_field()!!}
				<input type="hidden" name="dcd" value="xaj" required>
						<div class="cf-title">Sign up now to enjoy all of KloudTransact by filling the form below. All fields are required</div>
						<div class="row address-inputs">
							<div class="col-md-6">
								 <input type="text" class="form-control" name="fname" value="" placeholder="First name" required>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lname" value="" placeholder="Last name" required>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="" placeholder="Valid email address" required>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" name="phone" value="" placeholder="Phone number" required>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-6">
								 <input type="password" class="form-control" name="pass" value="" placeholder="Password" required>
							</div>
							<div class="col-md-6">
								<input type="password" class="form-control" name="pass_confirmation" value="" placeholder="Confirm password" required>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<input type="checkbox" name="remember" id="remember">
								<label for="remember">Remember me</label>
							</div>
							<div class="col-md-12">
								<input type="checkbox" name="sub" id="sub">
								<label for="sub">Send me useful bidding tips and other promotional offers</label>
							</div>
						</div>
						<button type="submit" class="site-btn submit-order-btn">Submit</button>
					</form>
          </div>
        </div>
		</div>
	</section>
	<!-- kloudpay section end -->
	

@stop