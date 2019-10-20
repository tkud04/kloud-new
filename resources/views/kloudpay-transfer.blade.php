@extends("layout")

@section('title',"Transfer Money")

@section('content')
@include('generic-banner',['title' => "Transfer Funds to Other KloudPay Users"])

<!-- kloudpay section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <form class="checkout-form" action="{{url('kloudpay-transfer')}}" method="post">
				{!!csrf_field()!!}
						<div class="cf-title">Transfer money to other KloudPay users by filling the form below.. <strong style="color:red;">Minimum: &#8358;5,000.00</strong></div>
						
						<div class="row address-inputs">
							<div class="col-md-6">
							    <p class="form-control-plaintext"><i class="fa fa-phone"></i> Recipient email or phone number:</p><br>
                                <input type="text" class="form-control" name="phone" value="" placeholder="Enter recipient phone number" required><br>
							</div>
							<div class="col-md-6">
							    <p class="form-control-plaintext"><i class="fa fa-briefcase"></i> Enter amount to transfer:</p><br>
                                 <input type="number" class="form-control" name="amount" value="" placeholder="Enter amount" required><br>
							</div>
						</div>
		
                            	
						
						<button type="submit" class="site-btn submit-order-btn">Submit</button>
					</form>
          </div>
        </div>
		</div>
	</section>
	<!-- kloudpay section end -->
	

@include('ad-space')

@stop