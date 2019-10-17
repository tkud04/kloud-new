@extends("layout")

@section('title',"Withdraw To Your Bank Account")

@section('content')
@include('generic-banner',['title' => "Withdraw Funds From Your KloudPay Wallet"])

<!-- kloudpay section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <form class="checkout-form" action="{{url('withdraw')}}" method="post">
				{!!csrf_field()!!}
						<div class="cf-title">Withdraw funds from your KloudPay wallet by filling the form below.. <strong style="color:red;">Minimum: &#8358;5,000.00</strong></div>
						
						<div class="row address-inputs">
							<div class="col-md-12">
								  <p class="form-control-plaintext"><i class="fa fa-briefcase"></i> Current balance: &#8358;{{number_format($wallet['balance'], 2)}}</p><br>
                               <input type="number" class="form-control" name="amount" id="amount" value="" placeholder="Enter amount" min="5000" required><br>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
							    <p class="form-control-plaintext"><i class="fa fa-money"></i> Withdrawal fee: &#8358;{{number_format((float)$fee,2)}}</p><br>
								 <p class="form-control-plaintext">Powered by <img class="img img-responsive" src="img/ps.jpg"/></p>
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