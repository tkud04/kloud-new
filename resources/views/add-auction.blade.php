@extends("layout")

@section('title',"Add New Auction")

@section('kojo')
 <script>
    addEditor($(".kojo-control"),"edeal","description");
	$('#edeal').html(``);
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
@include('generic-banner',['title' => "Add New Auction"])


<script> let cdb = "deal";</script>

<!-- edit store section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <form class="checkout-form wow fadeInUp" action="{{url('add-auction')}}" method="post">
				{!!csrf_field()!!}
				  <input type="hidden" name="xf" value="{{$deal['id']}}" required>
                  <input type="hidden" name="irdc" id="irdc" value="" required>
                 
              				   
						<div class="cf-title">Adds a new auction listing to the system<br>Only auctions that are approved will be displayed on our platform</div>
						
						<div class="row address-inputs">
							<div class="col-md-4">
                                        <p class="form-control-plaintext text-left"> Days</p>
                                        <input type="number" class="form-control" id="i-d" name="days" required>
							</div>
							<div class="col-md-4">
								  <p class="form-control-plaintext text-left">Hours</p>
                                        <input type="number" class="form-control" id="i-h" name="hours" required>
							</div>
							<div class="col-md-4">
                                       <p class="form-control-plaintext text-left">Minutes</p>
                                        <input type="number" class="form-control" id="i-m" name="minutes" required>    
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-6">
								<p class="form-control-plaintext text-left">Auction Price (Leave blank if it's the same with deal price) </p>
                                        <input type="number" class="form-control" name="auction_price">   
							</div>
							<div class="col-md-6">
								<p class="form-control-plaintext text-left">Buy it Now Price (Leave blank if it's the same with deal price) </p>
                                        <input type="number" class="form-control" name="buy_price"> 
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