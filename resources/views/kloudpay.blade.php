@extends("layout")

@section('title',"KloudPay")

@section('content')
@include('generic-banner',['title' => "KloudPay"])


	<!-- kloudpay section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>Shopping Made Easy!</h2>
			</div>
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <p>KloudPay is your online wallet where you have monetary value to spend on any product on the <strong class="text-primary">KloudTransact</strong> platform.</p>
            <br>
            <div class="row">
            	<div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card text-center" style="">
         <div class="card-body">         
            <div class="text-primary">
            <h5 class="card-title"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></h5>
            <p class="card-text">Buy Deals Easily</p>
            <a href="{{url('top-deals')}}" class="btn btn-primary text-white">Buy Top Deals Now</a>
            </div>
         </div>
       </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card text-center" style="">
         <div class="card-body">         
            <div class="text-warning">
            <h5 class="card-title"><i class="fa fa-money fa-2x" aria-hidden="true"></i></h5>
            <p class="card-text">Send Funds To Your Friends</p>
            <a href="{{url('kloudpay-transfer')}}" class="btn btn-primary text-white">Transfer Funds</a>
            </div>
         </div>
       </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card text-center" style="">
         <div class="card-body">         
            <div class="text-primary">
            <h5 class="card-title"><i class="fa fa-hourglass fa-2x" aria-hidden="true"></i></h5>
            <p class="card-text">Bid on Auctions</p>
            <a href="{{url('auctions')}}" class="btn btn-primary text-white">Bid Now</a>
            </div>
         </div>
       </div>
            </div>
            </div>
            <br>
            	<center><a href="{{url('wallet')}}" class="site-btn sb-dark">Go to your KloudPay Wallet</a></center>
          </div>
        </div>
		</div>
	</section>
	<!-- kloudpay section end -->
	
	
@stop