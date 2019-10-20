@extends("layout")

@section('title',"User Guide")

@section('content')
@include('generic-banner',['title' => "User Guide"])

<!-- dashboard section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
               <div class="col-lg-12">
                 <div class="card text-center" style="">
                   <div class="card-body">         
				   
<?php
$g = [
        'dashboard' => "Your Dashboard",
        'deals' => "Deals",
        'auctions' => "Kloud Auctions",
        'kloud-pay' => "KloudPay",
        'transactions' => "Transactions",
        'orders' => "Orders & Invoices",
        'checkout' => "Carts & Checkout",
        #'Coupons' => "KloudTransact Coupons",
        
      ];
      
$gc = [
        'dashboard' => "<h3 class='text-primary'>Dashboard</h3><p>Your dashboard is where you can view and update your account information like name, phone number, email address etc.</p><p>You can also access your KloudPay wallet and view your past transactions all from your dashboard. </p><h4>View/Edit Account information</h4><ul><li>On the side menu, click <strong>Dashboard.</strong></li><li>On the Dashboard page, click <strong>View profile</strong>. This will take you to the Profile page. </li><li>Edit your information as you wish, then click <strong>Submit</strong> once you are done. </li></ul><br><h4>View Wallet</h4><ul><li>On the side menu, click <strong>Dashboard.</strong></li><li>On the Dashboard page, click <strong>Profile</strong>. This will take you to the Profile page. </li><li>Edit your information as you wish, then click <strong>Submit</strong> once you are done. </li></ul>",
     #   'dashboard' => "<h3 class='text-primary'>Dashboard</h3>",
        'deals' => "<h3 class='text-primary'>Deals</h3><p>Deals on KloudTransact can be accessed from the home page or by clicking <strong>Top Deals</strong> from the side menu</p><p>To view more details about a deal, click its image or the link underneath the price tag.</p><h4>Purchasing Deals</h4><ul><li>Click the <strong>Cart</strong> icon by the bottom right of each deal to add to cart.</li><li>Alternatively, click the <strong>Add to cart</strong> button on each deals page. </li></ul><br><h4>Rating Deals</h4><ul><li>On the deals page, click the <strong>Select rating</strong> dropdown.</li><li>Pick a rating, then click <strong>Submit</strong>. This will submit your rating which will be displayed on our website</li></ul>",
        'auctions' => "<h3 class='text-primary'>Kloud Auctions</h3><p>We are proud to bring to you <span class='text-primary'>Kloud Auctions</span>, your favorite auction platform where you can bid for your choice deals or better yet, place your own deals on auction! </p><p>Bidding is free, and when an auction ends it goes to the highest bidder.</p><p class='text-bold text-danger'>DISCLAIMER: In the event that you win an auction you are required by law to pay for it. Failure to do so may incur legal action.</p><h4>Viewing Auctions</h4><ul><li>To view all live auctions on the platform, click <strong>Kloud Auctions</strong> in the side menu by the left. </li><li>This will take you to the Auctions page. To view an auction click its image or the link by the bottom left. </li></ul><br><h4>Bidding on Auctions</h4><ul><li>On the deals page, click on <strong>Bid</strong> to place a bid. You can bid multiple times on an auction. When the time expires, the deal goes to the highest bidder. </li><li>To skip bidding and buy an auction, click on <strong>Buy it now for.. </strong>. This ends the auction and the deal goes to you. </li></ul>",
        'kloud-pay' => "<h3 class='text-primary'>KloudPay</h3><p><strong>KloudPay</strong> is your online wallet where you have monetary value to spend on any product on the kloudtransact platform. You get funded via Kloudpay when you sell/auction deals on the platform and also when another user transfers funds to your account</p><h4>Transfer Funds</h4><ul><li>On the side menu, click <strong>KloudPay.</strong></li><li>Click <strong>Transfer funds</strong>.</li><li>Enter the recipient email or phone number. Enter amount you wish to transfer, then click <strong>Make transfer</strong>.</li></ul><br><h4>View Your Wallet</h4><ul><li>On the side menu, click <strong>KloudPay.</strong></li><li>Click <strong>Go to your KloudPay Wallet</strong>.</li></ul><br><h4>Make a Deposit</h4><ul><li>On the side menu, click <strong>KloudPay.</strong></li><li>Click <strong>Go to your KloudPay Wallet</strong>.</li><li>Click <strong>Make a deposit</strong>.</li><li>Enter the amount you wish to deposit, then click <strong>Make a deposit</strong>.</li></ul><br><h4>Make a Withdrawal</h4><ul><li>On the side menu, click <strong>KloudPay.</strong></li><li>Click <strong>Go to your KloudPay Wallet</strong>.</li><li>Click <strong>Make a withdrawal</strong>.</li><li>Enter the amount you wish to deposit, then click <strong>Make a withdrawal</strong>.</li></ul><br>",
        'transactions' => "<h3 class='text-primary'>Transactions</h3><p>The <strong>Transactions</strong> section is where you can find a list of your past transactions on the site. This list is a way to keep track of how much you make (or spend) on our platform.<h4>View Transactions</h4><ul><li>On the side menu, click <strong>Transactions.</strong></li></ul><br>",
        'orders' => "<h3 class='text-primary'>Orders & Invoices</h3><p>The <strong>Orders</strong> section is where you can find your orders. Invoices for each order are made available for you. Coupled with your transactions list this is a great way to keep track of your orders on our platform.<h4>View Orders</h4><ul><li>On the side menu, click <strong>Orders.</strong></li></ul><br><h4>View Invoice</h4><ul><li>On the side menu, click <strong>Orders.</strong></li><li>Click <strong>Generate Invoice</strong> to view the invoice for each order.</li></ul><br>",
        'checkout' => "<h3 class='text-primary'>Carts & Checkout</h3><p>Your <strong>Shopping Cart</strong> is where all the deals you desire are kept till you are done shopping and ready to checkout. We have made it very easy for you to update your selected deals or remove them from your cart totally.<h4>View Cart</h4><ul><li>On the side menu, click <strong>Cart.</strong></li></ul><br><h4>Update cart</h4><ul><li>On the side menu, click <strong>Cart.</strong></li><li>Click on the quantity counter beside each deal you want to update.</li><li>When you are done, then click <strong>Update cart</strong> at the top.</li></ul><br><h4>Remove from cart</h4><ul><li>On the side menu, click <strong>Cart.</strong></li><li>Click <strong>Remove</strong> beside each deal you want to remove.</li><li>When you are done, then click <strong>Update cart</strong> at the top.</li></ul><br><h4>Checkout</h4><ul><li>On the side menu, click <strong>Cart.</strong></li><li>When you are done shopping and you are ready to checkout, click <strong>Checkout</strong> at the bottom.</li><li>Fill in your shipping details. If you have saved your shipping address before, you can skip this step.</li><li>Tick <em>I accept the terms</em> to indicate that you accept the <a href='#'>Terms and conditions</a>. for purchasing deals on KloudTransact.</li><li>Tick <em>I accept the terms</em> to save your shipping address for future use. This is optional.</li><li>To make payment with your <em>KloudPay wallet</em>, click <strong>Pay with KloudPay</strong></li><li>To make payment with your credit card, click <strong>Pay with credit card</strong></li></ul><br>",
        #'Coupons' => "<h3 class='text-primary'>Coupons on KloudTransact</h3>",
        
      ];
?>
				   
            <!--Start User Guide menu -->
       <ul class="nav nav-tabs" id="myTab" role="tablist">
       <li class="nav-item">
    <a class="nav-link active" id="introduction-tab" data-toggle="tab" href="#introduction" role="tab" aria-controls="introduction" aria-selected="true">Introduction</a>
  </li>
       <?php
  foreach($g as $key => $value){
  ?>
   
  <li class="nav-item">
    <a class="nav-link" id="{{$key}}-tab" data-toggle="tab" href="#{{$key}}" role="tab" aria-controls="{{$key}}" aria-selected="false">{{$value}}</a>
  </li>
  <?php
  }
  ?>  
</ul>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="introduction" role="tabpanel" aria-labelledby="introduction-tab">
  	<h3>Introduction</h3>
      <p>Welcome to Kloudtransact user guide. You can find help about any issues as pertaining to our website here. </p>
      <p>Feel free to click any of the tabs above for a detailed documentation of the website features.</p>
  </div>
  <?php
  foreach($gc as $key => $value){
  ?>   
  <div class="tab-pane fade" id="{{$key}}" role="tabpanel" aria-labelledby="{{$key}}-tab">
  	{!! $value !!}
  </div>
  <?php
  }
  ?>
</div>
     <!--End User Guide menu -->
                   </div>
                 </div>
              </div>
           </div>
		</div>
	</section>
	<!-- dashboard section end -->


@include('ad-space')

@stop