@extends("layout")

@section('title',"Make a Deposit")

@section('content')
@include('generic-banner',['title' => "Fund Your KloudPay Wallet"])

<!-- kloudpay section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <form class="checkout-form" id="checkout-form" action="" method="post">
				{!!csrf_field()!!}
				<input type="hidden" name="return" value="deposit"/>
						<div class="cf-title">Add funds to your KloudPay wallet by filling the form below..</div>
						
						<div class="row address-inputs">
							<div class="col-md-12">
								  <p class="form-control-plaintext"><i class="fa fa-briefcase"></i> Current balance: &#8358;{{number_format($wallet['balance'], 2)}}</p><br>
                               <input type="number" class="form-control" name="orig-amount" id="amount" value="" placeholder="Enter amount" min="1000" required><br>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								 <p class="form-control-plaintext">Powered by <img class="img img-responsive" src="img/ps.jpg"/></p>
							</div>
						</div>
						
						<script>
                             	let mc = {
                             	                'type': 'kloudpay'
                                             };
                             
                             </script>
                            <!-- payment form -->
                            	<input type="hidden" name="email" value="{{$user->email}}"> {{-- required --}}
                            	<input type="hidden" name="amount" id="meta-amount" value=""> {{-- required in kobo --}}
                            	<input type="hidden" name="metadata" id="nd" value="" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                            	
                            <!-- End payment form -->
                            	
                            <input type="hidden" id="card-action" value="{{url('pay')}}">
                            	
						
						<button type="submit" class="site-btn submit-order-btn">Submit</button>
					</form>
          </div>
        </div>
		</div>
	</section>
	<!-- kloudpay section end -->
	

@include('ad-space')

@stop