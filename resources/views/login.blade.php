@extends("layout")

@section('title',"Log in")

@section('content')
@include('generic-banner',['title' => "Log in"])

<!-- kloudpay section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <form class="checkout-form" action="{{url('login')}}" method="post">
				{!!csrf_field()!!}
				<input type="hidden" name="return" value="{{$return}}"/>
						<div class="cf-title">Log in to continue..</div>
						<div class="row address-inputs">
							<div class="col-md-6">
								  <input type="text" class="form-control" name="id" value="" placeholder="Email or phone number" required>
							</div>
							<div class="col-md-6">
								 <input type="password" class="form-control" name="pass" value="" placeholder="Password" required>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<input type="checkbox" name="remember" id="remember">
								<label for="remember">Remember me</label><br>
								<a href="#">Forgot password?</a>
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