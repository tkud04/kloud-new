@extends("layout")

@section('title',"FAQ")

@section('content')
@include('generic-banner',['title' => "Frequently Asked Questions"])

<?php
$faqs = [
   'How does KloudTransact work?' => "Customers can shop on <b>Kloudtransact</b> for items such as general groceries, fresh produce, beauty products, medicines, office supplies, books & magazines, tools & hardware and everything else you?ll find.<br><br> When customers add items to their order basket, they have the choice of selecting their preferred delivery window from multiple options. The website is user-friendly and the service is interactive; we keep customers updated at every stage of the processing of their order.",
   'Will You Deliver To My Area?' => "With our partnership with a top notch logistics company, we are able to cover deliveries in a huge part of the country. If your preferred delivery address is not within our current coverage area, you may provide an alternative delivery address that is centrally located (perhaps your office or the home of a relative or friend that you visit frequently).",
   'When Will I Receive My Order?' => "At checkout, you are able to select a preferred time when you will like your order delivered. We deliver 7 days a week from 12pm to 9pm and can be at your door in as early as 3 hours after you order. See our Terms for more details on our delivery service.",
   'Do Item Images Reflect Exactly What I Will Receive?' => "While most items show actual images of what will be delivered, some images may differ slightly from what is displayed on the website. This may occur for a variety of reasons including but not limited to a new/temporary packaging design by the manufacturer, promotional items, same content but different version of an item (e.g. different editions of books or varied book cover design depending on country of print).<br><br> Some images may also be for illustration purposes only and may not exactly reflect the colour, size and shape of actual item; this is particularly relevant for fruits, vegetables and other fresh produce.",
   'How Are Weighed Items Priced?' => "Prices of items that need to be weighed (e.g. fruits, vegetables, deli/cold cuts, meat) may be guide prices or approximated to enable you make a buying decision. However, you will only be billed for the actual weight purchased; any difference in guide to actual price will be credited/debited to your kloudPay wallet as the case may be. Actual price of weighed items will be clearly stated on your invoice.",
   'What If An Item Is Unavailable?' => "We go to great lengths to ensure we always find all items in your order. This often necessitates us checking as many as 6 retail outlets before concluding your order. If after checking multiple retailers, the item is still unavailable; our well-trained Personal Shoppers will contact you to offer suitable replacements. You are not obliged to accept the replacements and we will only purchase them after receiving a go-ahead from you.",
   'What Do You Consider \'A Suitable Replacement\'?' => "Replacements will typically be a different flavour to what you selected (e.g. apple juice instead of pineapple juice) OR a different brand of a similar quality item OR items with similar function to what you ordered (e.g. mint chewing gum instead of mint sweets).",
   'Do I Pay For Delivery If Items Are Unavailable?' => "While we make every effort to display an accurate list of items that are in stock at the stores we partner with, these stores are ultimately responsible for maintaining their invetory levels. In the normal course of a business day, the stores may occasionally run out of some items.<br><br> You will not be obliged to pay for any unavailable item. If you are not satisfied with the replacement suggested to you by the Personal Shopper, we will refund the monetary value of the item to your KloudPay wallet.",
   'What Is KloudPay Wallet?' => "Your KloudPay wallet is your online account where you have monetary value to spend on any product on the kloudtransact platform. We may debit or credit your wallet for various reasons including: refunding you for an unavailable item, reconciling the difference between guide and actual price for a weighed item, promotional offers, discounts and rebates.",
   'What About Refunds?' => "If an item you ordered is unavailable, we will continue to check for the item until it is back in stock. If, after our checks, the item remains out of stock, any credit due to you will be added to your KloudPay Wallet. We do not process refunds to bank accounts.<br><br>In instances where your address is not within our delivery coverage locations or we later receive a payment which did not reflect in our account at the time you made it, we may process a refund to your account after deducting relevant bank charges.",
   'Can I Return Items?' => "If we deliver an incorrect or damaged item (damage that has been caused by us), we will happily replace the item at no additional cost to you. For us to replace such items, customers will need to notify the delivery driver of their observation at the point of delivery. Once customers have taken delivery of their order and signed confirming this, they take ownership of the items and kloudtransact will be unable to accept any returns.",
   'Can I Cancel My Order?' => "When we receive customer orders, we begin processing them immediately. And because we do not hold our own inventory and we only purchase from supermarkets and retail outlets when customers place orders, as soon as customers pay for their orders, we start purchasing their selected products. The retailers we buy from have a no-return policy so, we in turn, are unable to return any items customers purchase from us to the retailers. Thus, once an order has been placed and paid for, kloudtransact is unable to accept a cancellation of the order.",
   'How Can I Contact You?' => "We are always happy to hear from you. If your question has not been covered in our FAQ page, please contact us at support@kloudtransact.com and we will respond immediately.",
];

$counter = 0;
?>

<!-- kloudpay section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <div id="accordion">
			  @foreach($faqs as $key => $value)
			  <?php
			  ++$counter;
			  ?>
                 <div class="card">
					 <div class="card-header" id="heading-{{$counter}}">
					     <h5 class="mb-0">
						     <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{$counter}}" aria-expanded="true" aria-controls="collapse-{{$counter}}">{{$key}}</button>
                         </h5>
					 </div>

					 <div id="collapse-{{$counter}}" class="collapse" aria-labelledby="heading-{{$counter}}" data-parent="#accordion">
					     <div class="card-body">
						 {!! $value !!}
						 </div>
					 </div>
				 </div>
                 @endforeach				 
			</div>
          </div>
        </div>
		</div>
	</section>
	<!-- kloudpay section end -->
	


@include('ad-space')

@stop