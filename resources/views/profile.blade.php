@extends("layout")

@section('title',"My Profile")

@section('content')
@include('generic-banner',['title' => "My Profile"])

<script> let cdb = "deal";</script>
<!-- dashboard section -->
	<section class="top-letest-product-section">
		<div class="container">
		<div class="section-title">
				<h2>Personal Information</h2>
			</div>
			<div class="row">
            <div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <form class="checkout-form" action="{{url('profile')}}" method="post">
				{!!csrf_field()!!}
				<input type="hidden" name="ird" id="ird" value="" required>
                                   <input type="hidden" name="irdc" id="irdc" value="" required>
								   <?php
                      $balance = $account['wallet']['balance'];
                    ?>
						<div class="cf-title">View or edit your personal information.</div>
						
						<div class="row address-inputs">
							<div class="col-md-6">
							    <p class="form-control-plaintext"><i class="fa fa-suitcase"></i> First Name:</p><br>
                                <input type="text" class="form-control" name="fname" value="{{$account['fname']}}" placeholder="Enter first name" required><br>
							</div>
							<div class="col-md-6">
							    <p class="form-control-plaintext"><i class="fa fa-tag"></i> Last name:</p><br>
                                 <input type="text" class="form-control" name="lname" value="{{$account['lname']}}" placeholder="Enter last name" required><br>
							</div>
							<div class="col-md-4">
							    <p class="form-control-plaintext"><i class="fa fa-inbox"></i> Email:</p><br>
                                 <input type="text" class="form-control" name="email" value="{{$account['email']}}" placeholder="Enter email address" required><br>
							</div>
							<div class="col-md-4">
							    <p class="form-control-plaintext"><i class="fa fa-phone"></i> Phone:</p><br>
                                 <input type="tel" class="form-control" name="phone" value="{{$account['phone']}}" placeholder="Enter phone number" required><br>
							</div>
							<div class="col-md-4">
							    <p class="form-control-plaintext"><i class="fa fa-inbox"></i> Current KloudPay balance:</p><br>
                                 <input type="text" class="form-control" value="&#8358;{{number_format($balance,2)}}" readonly><br>
							</div>
						</div>
		
                            	
						
						<button type="submit" class="site-btn submit-order-btn">Submit</button>
					</form>
          </div>
        </div>
        </div>

		
		</div>
	</section>
	<!-- dashboard section end -->

@stop