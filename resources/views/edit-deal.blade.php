@extends("layout")

@section('title',"Edit Deal")

@section('kojo')
 <script>
    addEditor($(".kojo-control"),"edeal","description");
	$('#edeal').html(`{!!$deal['data']['description']!!}`);
  </script>
@stop

@section('pickr')
<!-- One of the following themes -->
<link rel="stylesheet" href="lib/pickr/themes/classic.min.css"/> <!-- 'classic' theme -->

<!-- Modern or es5 bundle -->
<script src="lib/pickr/pickr.min.js"></script>
<script src="lib/pickr/pickr.es5.min.js"></script>
@stop

@section('content')
@include('generic-banner',['title' => "Edit Deal"])


<?php 
#$ct = (isset($category) && $category != null) ? " - ".$category : ""; 
$data = $deal['data'];
$imgg = $deal['images'];
 if($imgg[0]['url'] == "none") $img = "https://via.placeholder.com/150";
 else $img = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$imgg[0]['url'];
?>
<script> let cdb = "deal";</script>

<!-- edit store section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <form class="checkout-form wow fadeInUp" enctype="multipart/form-data" action="{{url('edit-deal')}}" method="post">
				{!!csrf_field()!!}
				 <input type="hidden" name="ird" id="ird" value="{{$imgg[0]['url']}}" required>
                                   <input type="hidden" name="irdc" id="irdc" value="{{$imgg[0]['irdc']}}" required>
                                   	<input type="hidden" name="sku" id="sku" value="{{$deal['sku']}}" required>
                 <input type="hidden" name="description" id="description" value="{{$data['description']}}" required>
                 <input type="hidden" name="color" id="ccolor" value="{{$data['colors']}}" required>
              				   
						<div class="cf-title">Add a new deal to the system<br>Only deals that are approved will be displayed on our platform</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<button id="deal-upload" class="cloudinary-button">Upload Photos</button><br>
                                <span id="cloudinary-loading"><strong>TIP: <em>You can upload multiple photos by clicking this button.</em></strong><br>It usually takes a few minutes to upload photos so please be patient when you click <em>Upload</em>.</span> 
							</div>
							
						</div>
						<div class="row address-inputs">
							<div class="col-md-6">
								<p class="form-control-plaintext text-left"><i class="fa fa-asterik"></i> Name</p><br>
                                <input type="text" class="form-control" placeholder="e. g Samsung Galaxy S9 Edge" name="name" value="{{$deal['name']}}" required>
							</div>
							<div class="col-md-6">
								 <p class="form-control-plaintext text-left"><i class="fa fa-asterik"></i> Category</p><br>
                                        <select class="form-control" name="category" required>
                                        	<option value="none">Select deal category</option>
                                            @foreach($c as $key => $value)
											<?php $ss = ($deal['category'] == $key) ? 'selected="selected"' : ''; ?>
                                            <option value="{{$key}}" {{$ss}}>{{$value}}</option>
                                            @endforeach
                                       </select><br>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-6">
								<p class="form-control-plaintext text-left"><i class="fa fa-asterik"></i> Color</p><br>
								<div style="background: {{$data['colors']}}"> Current color  </div><br>
                                <span>Click the box to specify product color</span>
								<div class="color-picker"></div>
							</div>
							<div class="col-md-6">
								 <p class="form-control-plaintext text-left"><i class="fa fa-asterik"></i> Size</p><br>
								       <div>Available sizes: {{$data['sizes']}}</div><br>
                                        <select class="form-control" name="size-1" id="size-1" required>
                                        	<option value="none">Select size</option>
											<?php
											 $sizes = ['XS' => "Extra Small",
											           'S' => "Small",
											           'M' => "Medium",
											           'L' => "Large",
											           'XL' => "Extra Large",
											           'XXL' => "Extra extra Large",
											           'other' => "Other(multiple sizes)"
													  ];
											?>
                                            @foreach($sizes as $key => $value)
                                            <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                       </select><br>
									   <input type="text" class="form-control" id="size-2" name="size-2" value="" placeholder="Enter sizes (separate with commas)">
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-4">
                                        <h4 class="form-control-plaintext text-primary text-left"><i class="fa fa-asterik"></i> Price(&#8358;):</h4>
                                        <input type="number" class="form-control" name="amount" id="amount" value="{{$data['amount']}}" placeholder="Enter amount" required>
							</div>
							<div class="col-md-4">
								<p class="form-control-plaintext text-left"><i class="fa fa-link"></i> SKU</p><br>
                                        <input type="text" class="form-control" value="{{$deal['sku']}}" disabled>
							</div>
							<div class="col-md-4">
                                        <p class="form-control-plaintext text-left"><i class="fa fa-asterik"></i> Inventory Status</p><br>
                                        <select class="form-control" name="in_stock" required>
                                     	  <option value="none">Select inventory status</option>
                                          <?php 
                              $iss = ['yes' => 'In stock','new' => 'New!','no' => 'Out of Stock'];                           
                              foreach($iss as $key => $value){ 
                              	$ss = ($deal['data']['in_stock'] == $key) ? 'selected="selected"' : ''; 
                              ?>
                              <option value="<?=$key?>" <?=$ss?>><?=$value?></option>
                              <?php } ?>
                                        </select>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<p class="form-control-plaintext text-left"><i class="fa fa-asterik"></i> Description</p><br>
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
	
@section('scripts')
<script>
// Simple example, see optional options for more configuration.
const pickr = Pickr.create({
    el: '.color-picker',
    theme: 'classic', // or 'monolith', or 'nano'

    swatches: [
        'rgba(244, 67, 54, 1)',
        'rgba(233, 30, 99, 0.95)',
        'rgba(156, 39, 176, 0.9)',
        'rgba(103, 58, 183, 0.85)',
        'rgba(63, 81, 181, 0.8)',
        'rgba(33, 150, 243, 0.75)',
        'rgba(3, 169, 244, 0.7)',
        'rgba(0, 188, 212, 0.7)',
        'rgba(0, 150, 136, 0.75)',
        'rgba(76, 175, 80, 0.8)',
        'rgba(139, 195, 74, 0.85)',
        'rgba(205, 220, 57, 0.9)',
        'rgba(255, 235, 59, 0.95)',
        'rgba(255, 193, 7, 1)'
    ],

    components: {

        // Main components
        preview: true,
        opacity: true,
        hue: true,

        // Input / output Options
        interaction: {
            hex: true,
            rgba: true,
            hsla: true,
            hsva: true,
            cmyk: true,
            input: true,
            clear: true,
            save: true
        }
    }
});

pickr.on('save', (color, instance) => {
 //   console.log('save', color, instance);
 let ccc = pickr.getColor();
 let xcc = ccc.toRGBA().toString();
 console.log(`ccc to rgba string: ${xcc}`);
 
 $('#ccolor').val(xcc);
});



</script>
@stop

@stop