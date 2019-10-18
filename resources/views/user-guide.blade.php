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

@stop