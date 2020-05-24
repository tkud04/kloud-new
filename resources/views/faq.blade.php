@extends("layout")

@section('title',"FAQ")

@section('content')
@include('generic-banner',['title' => "Frequently Asked Questions"])

<?php
$faqs = [
   'How does KloudTransact work?' => "Customers can shop on kloudtransact for items such as general groceries, fresh produce, beauty products, medicines, office supplies, books & magazines, tools & hardware and everything else you?ll find. When customers add items to their order basket, they have the choice of selecting their preferred delivery window from multiple options. The website is user-friendly and the service is interactive; we keep customers updated at every stage of the processing of their order.",
];
?>

<!-- kloudpay section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <div id="accordion">
			  @foreach($faqs as $key => $value)
                 <div class="card">
					 <div class="card-header" id="heading-1">
					     <h5 class="mb-0">
						     <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">{{$key}}</button>
                         </h5>
					 </div>

					 <div id="collapse-1" class="collapse" aria-labelledby="heading-1" data-parent="#accordion">
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