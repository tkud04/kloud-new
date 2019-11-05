<!DOCTYPE html>
<html lang="en-US">
<head>
	<title>@yield('title') - KLOUD TRANSACT - BUY || SELL || PAY - Ecommerce, Online Auctions & ePayment Platform</title>
	<meta charset="UTF-8">
	<meta name="description" content="Kloudtransact is an online auction and ePayment platform. Our mission is to become the engine of trade, payment and commerce Africa." />
<meta name="keywords" content="Phones & Tablets, TV & Electronics, Fashion, Computers, Groceries, Unique Bundles, Health & Beauty, Home & Office, Babies, Kids & Toys, Games & Consoles, Watches & Sunglasses, Men's fashion, women's fashion, mobile phones, Laptop, Bags, shoes, wristwatches
" />
<meta name="author" content="kloudtransact/">
<meta name="robots" content="index, follow">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="../img/kloudlogo.PNG" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Styles -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/flaticon.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="css/custom.css"/>
	
   <!-- kojo editor -->
	<link rel="stylesheet" href="lib/kojo/style.css"> <!-- Core -->
    
	@yield('styles')
	
	@yield('pickr')

	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	
	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	    <script src="js/helper.js"></script>
	<script src="lib/sweet-alert/all.js"></script>
</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="{{url('/')}}" class="site-logo">
							<img src="img/kloudlogo.PNG" alt="">
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
						<form class="header-search-form">
							<input type="text" placeholder="Search on KloudTransact....">
							<button><i class="flaticon-search"></i></button>
						</form>
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
						   <?php
						      $cc = (isset($cart)) ? count($cart) : 0;
						   ?>
						   @if($user != null)
							<div class="up-item">
								<i class="flaticon-profile"></i>
								<a href="{{url('dashboard')}}">Welcome, {{$user->fname}}</a>
							</div>
						   @else
							<div class="up-item">
								<i class="flaticon-profile"></i>
								<a href="#" id="register-btnn" style="color: #f51167;">Register</a> or <a href="#" id="login-btnn" style="color: #f51167;">Login</a>
							</div>
						   @endif
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<span>{{$cc}}</span>
								</div>
								<a href="{{url('cart')}}">Cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="{{url('/')}}">Home</a></li>
					<li><a href="{{url('top-deals')}}">Top Deals <span class="new">New</span></a></li>
					<li><a href="{{url('auctions')}}">Kloud Auctions </a></li>
					<li><a href="{{url('bundle')}}">Bundle Products</a></li>
					<li><a href="{{url('stores')}}">Stores</a></li>
					<li><a href="{{url('kloudpay')}}">KloudPay</a></li>
					<li><a href="#">Account</a>
						<ul class="sub-menu">
						  @if($user != null) 
							<li><a href="{{url('dashboard')}}">Dashboard</a></li>
						    @if($user->verified == "vendor")
							  <li><a href="{{url('my-store')}}">My Store</a></li>
						    @else
							  <li><a href="{{url('mregister')}}">Merchant Register</a></li>
						    @endif
							<li><a href="{{url('my-bids')}}">My Bids</a></li>
							<li><a href="{{url('transactions')}}">Transactions</a></li>
							<li><a href="{{url('orders')}}">Orders</a></li>
							<li><a href="{{url('logout')}}">Log out</a></li>
					      @else
							<li><a href="{{url('register')}}">Register</a></li>
						    <li><a href="{{url('login')}}">Log in</a></li>
							<li><a href="{{url('mregister')}}">Merchant Register</a></li>							
							<li><a href="{{url('login')}}">Merchant Log in</a></li>
							<li><a href="{{url('enterprise')}}">Enterprise</a></li>
						  @endif						
						</ul>
					</li>
					<li><a href="{{url('userguide')}}">User Guide</a></li>
					<li><a href="{{url('blog')}}">Blog</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Header section end -->
	 <!--------- Cookie consent-------------->
        	@include('cookie-consent')
        
        <!--------- Session notifications-------------->
        	<?php
               $pop = ""; $val = "";
               
               if(isset($signals))
               {
                  foreach($signals['okays'] as $key => $value)
                  {
                    if(session()->has($key))
                    {
                  	$pop = $key; $val = session()->get($key);
                    }
                 }
              }
              
             ?> 

                 @if($pop != "" && $val != "")
                   @include('session-status',['pop' => $pop, 'val' => $val])
                 @endif
        	<!--------- Input errors -------------->
                    @if (count($errors) > 0)
                          @include('input-errors', ['errors'=>$errors])
                     @endif 
	
	
	@yield('content')
	
	<?php
	 shuffle($layoutAd);
	 $if(count($layoutAd) > 0) $ll = $layoutAd[0];
	 else $ll = [];
	?>
    @include('ad-banner',['data' => $ll])


	<!-- Footer section -->
	<section class="footer-section">
		<div class="container">
			<div class="footer-logo text-center">
				
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>About</h2>
						<p>Kloudtransact is an online auction and ePayment platform. Our mission is to become the engine of trade, payment and commerce in Africa</p>
						
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>Links</h2>
						<ul>
							<li><a href="{{url('about')}}">About Us</a></li>
							<li><a href="{{url('faq')}}">FAQ</a></li>
							<li><a href="{{url('returns')}}">Returns</a></li>
							
							<li><a href="{{url('shipping')}}">Shipping</a></li>
							
						</ul>
						<ul>
							<li><a href="#">Enterprise</a></li>
							<li><a href="{{url('blog')}}">Blog</a></li>
							<li><a href="{{url('terms')}}">Terms of Use</a></li>
							<li><a href="#">Sitemap</a></li>
							
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<img src="../img/kloudlogo.PNG" alt="">
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget contact-widget">
						<h2>Questions</h2>
						<div class="con-info">
							<span>C.</span>
							<p>KloudTransact Ltd </p>
						</div>
						<div class="con-info">
							<span>B.</span>
							<p>Abuja, Nigeria</p>
						</div>
						
						<div class="con-info">
							<span>E.</span>
							<p>support@kloudtransact.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="social-links-warp">
			<div class="container">
				<div class="social-links">
					<a href="#" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
					
					<a href="#" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a>
					<a href="#" class="twitter"><i class="fa fa-twitter"></i><span>twitter</span></a>
					
				</div>

<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0.
<p class="text-white text-center mt-5">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
 Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
 <p class="text-white text-center mt-5">Copyright &copy;<script>document.write(new Date().getFullYear());</script> <a href="{{url('/')}}">KloudTransact</a> - <a href="{{url('faq')}}">FAQ</a> | <i class="fa fa-lightning" aria-hidden="true"></i> powered by <a href="http://www.disenado.com.ng" target="_blank">Disenado NG</a></p>

			</div>
		</div>
	</section>
	<!-- Footer section end -->



	<!--====== Scripts ======-->
	<script src="js/bootstrap.min.js"></script>
	<!-- wow js -->
	<script src="js/wow.js"></script>
              <script>
              new WOW().init();
              </script>
			  
    <!-- Kojo editor -->
  <script src="lib/kojo/helpers.js"></script>
       @yield('kojo')
  <script src="lib/kojo/main.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
	<script src="js/scrollup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/main.js"></script>

<script>
$('#register-btnn').click(function(e){
e.preventDefault();

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-warning'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Register',
  text: "Select an action to continue",
  type: 'info',
  showCancelButton: true,
  confirmButtonText: 'Register as user',
  cancelButtonText: 'Register as merchant',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
    window.location = "register";
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    window.location = "mregister";
  }
})

});

$('#login-btnn').click(function(e){
e.preventDefault();

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-warning'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Login',
  text: "Select an action to continue",
  type: 'info',
  showCancelButton: true,
  confirmButtonText: 'Login as user',
  cancelButtonText: 'Login as merchant',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
    window.location = "login";
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    window.location = "login";
  }
})

});
</script>

    <!-- Cloudinary js -->
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
    <script type="text/javascript">  
		let loadingg = document.getElementById("cloudinary-loading");
		let trdc = 0;
		console.log(loadingg);
		//if(loadingg != null) loadingg.style.display = "none";
    function createUploadWidget(dt){
		loadingg.style.display == "inline";
		loadingg.innerHTML = "Please wait..";
		
    var myWidget = cloudinary.createUploadWidget({
        cloudName: 'kloudtransact', 
       uploadPreset: 'gjbdj9bt',
       publicId: dt}, (error, result) => { 
    if (!error && result && result.event === "success") { 
      console.log('Done! Here is the image info: ', result.info); 
      document.getElementById("ird").value = dt;
      
      if(cdb == "deal"){
      	trdc = parseInt(document.getElementById("irdc").value);
          if(isNaN(trdc)) trdc = 1;
          else if(Number.isInteger(trdc)) ++trdc; 
      	document.getElementById("irdc").value = trdc;
      }
      
      //console.log(document.getElementById("irdc").value);
	 loadingg.innerHTML = "<span style='color: green;'>Image(s) uploaded.</span>";
    }
  });
  return myWidget; 
}

function getRandInt(a,b){
	let min = Math.ceil(a);
	let max = Math.floor(b);
	return Math.floor(Math.random() * (max - min)) + min;
}

function getIRD(sird){
	let nd = new Date();
	return sird + "_" + nd.getHours() + "_" + nd.getDay() + "_" + getRandInt(1,8253272) + "_kampl";
}

if(typeof(cdb) === 'undefined' || cdb === null){}

else{
if(cdb == "blog"){
document.getElementById("blog-upload").addEventListener("click", function(){
	let bdd = getIRD("kloudblog");
	let blogWidget = createUploadWidget(bdd);
    blogWidget.open();
  }, false);
}

if(cdb == "store"){
  document.getElementById("store-upload").addEventListener("click", function(e){
	 e.preventDefault();
	let sdd = getIRD("my_store");
	let storeWidget = createUploadWidget(sdd);
    storeWidget.open();
  }, false);
}

if(cdb == "deal"){
  document.getElementById("deal-upload").addEventListener("click", function(e){
	 e.preventDefault();
	let sdd = getIRD("my_deal");
	let dealWidget = createUploadWidget(sdd);
    dealWidget.open();
  }, false);
}
}
</script>

    @yield('scripts')
	</body>
</html>
