@extends("layout")

@section('title',"Edit Store")

@section('kojo')
 <script>
    addEditor($(".kojo-control"),"estore","description");
	$('#estore').html(`{!!$store['description']!!}`);
  </script>
@stop


@section('content')
@include('generic-banner',['title' => "Edit Store"])

<?php 
#$ct = (isset($category) && $category != null) ? " - ".$category : ""; 
$deals = count($store["deals"]);
$status = $store["status"];
$sc = "text-warning";
if($status == "disabled") $sc = "text-danger";
else if($status == "success") $sc = "text-success";

$img = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$store['img'];
 if($store['img'] == "none") $img = "https://via.placeholder.com/150";
?>
<script> let cdb = "store";</script>

<!-- edit store section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <form class="checkout-form wow fadeInUp" action="{{url('edit-store')}}" enctype="multipart/form-data" method="post">
				{!!csrf_field()!!}
				 <input type="hidden" name="img" id="img" value="{{$store['img']}}" required>
                                   <input type="hidden" name="irdc" id="irdc" value="" required>
                                   <input type="hidden" name="description" id="description" value="{{$store['description']}}" required>
						<div class="cf-title">View/edit information about your store</div>
						<div class="row address-inputs">
							<div class="col-md-6">
								 <p class="form-control-plaintext text-left mb-1">
                                          <img src="{{$img}}" class="img-fluid"alt=""><br>
                                          <?php
                                           if($store['img'] == "none"){                                       	
                                          ?>
                                          <p class="form-control-plaintext text-left"><i class="fa fa-store"></i> Upload your store logo</p><br>
                                          <input type="file" name="img" id="img-1" class="form-control"  required>
                                          <?php
                                           }
                                           else{
                                           $dri = url('dri')."?loc=edit-store&ird=".$store['img'];
                                          ?>
                                          <a href="{{$dri}}" class="site-btn mb-3">Delete image</a>
                                          <?php
                                           }
                                          ?>
                                        </p>
							</div>
							<div class="col-md-6">
							   <p class="form-control-plaintext text-left"><i class="fa fa-store"></i> Store name</p><br>
								<input type="text" class="form-control" name="name" value="{{$store['name']}}" placeholder="Store name" required>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-6">
								<p class="form-control-plaintext text-left"><i class="fa fa-user"></i> Managed by</p><br>
                                        <input type="text" class="form-control" value="{{$store['user']}}" disabled>
							</div>
							<div class="col-md-6">
								 <p class="form-control-plaintext text-left"><i class="fa fa-star"></i> Rating</p><br>
                                        @for($s = 0; $s < $store['rating']; $s++)
                                          <i class="fa fa-star fa-2x" aria-hidden="true"></i>
                                        @endfor
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-3">
                                        <h4 class="form-control-plaintext text-primary text-left"><i class="fa fa-briefcase"></i> Total Deals: {{$deals}}</h4>
                                        <small class="form-control-plaintext text-left">Last updated: {{$store['last_updated']}}</small>
							</div>
							<div class="col-md-6">
								<p class="form-control-plaintext text-left"><i class="fa fa-link"></i> Friendly URL</p><br>
                                        <input type="text" class="form-control" placeholder="Friendly store url e.g for Tobi's Stores: tobi-stores" name="flink" value="{{$store['flink']}}" required>
							</div>
							<div class="col-md-3">
                                        <p class="form-control-plaintext text-left"><i class="fa fa-briefcase"></i> Status</p><br>
                                        <p class="form-control-plaintext {{$sc}} text-left"><i class="fa fa-briefcase"></i> {{$status}}</p><br>
                                        <a href="{{url('delete-store').'?xf='.$store['id']}}" class="btn btn-primary">Delete store</a>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<p class="form-control-plaintext text-left"><i class="fa fa-store"></i> Store pickup address<
                                <textarea class="form-control" name="pickup_address" placeholder="Enter pickup address (Number, Street, City, State)" required>{{$store['pickup_address']}}</textarea>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<p class="form-control-plaintext text-left"><i class="fa fa-pencil"></i> Description</p><br>
                                        <div class='kojo-control'>
                            	
                                        </div>
							</div>
						</div>
						<button type="submit" class="site-btn submit-order-btn">Submit</button>
					</form>
          </div>
        </div>
		</div>
	</section>
	<!-- edit store section end -->
	

@stop