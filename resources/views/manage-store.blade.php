@extends("layout")

@section('title',"Manage Store")

@section('content')
@include('generic-banner',['title' => "Manage Store"])


	<!-- kloudpay section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>Store Dashboard</h2>
			</div>
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <p>Manage your store information, import your products and keep track of your auctions.</p>
            <br>
            <div class="row">
            	<div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card text-center" style="">
         <div class="card-body">         
            <div class="text-primary">
            <h5 class="card-title"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></h5>
            <p class="card-text">View/edit store info</p>
            <a href="{{url('edit-store')}}" class="btn btn-primary text-white">Manage store info</a>
            </div>
         </div>
       </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
              <div class="card text-center" style="">
         <div class="card-body">         
            <div class="text-warning">
            <h5 class="card-title"><i class="fa fa-money fa-2x" aria-hidden="true"></i></h5>
            <p class="card-text">Manage deals</p>
            <a href="{{url('my-deals')}}" class="btn btn-primary text-white">Go to deals</a>
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
            <a href="{{url('my-auctions')}}" class="btn btn-primary text-white">Bid Now</a>
            </div>
         </div>
       </div>
            </div>
            </div>
            <br>
			   <?php $vurl = url('stores')."/".$store["flink"]; ?>
            	<center><a href="{{$vurl}}" class="site-btn sb-dark" target="_blank">View store as a visitor</a></center>
          </div>
        </div>
		</div>
	</section>
	<!-- kloudpay section end -->
	
	
@stop