@extends("layout")

@section('title',"Practice")


@section('content')
@include('generic-banner',['title' => "Edit Deal"])

<!-- edit store section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <form class="checkout-form wow fadeInUp" action="{{url('practice')}}" enctype="multipart/form-data" method="post">
				{!!csrf_field()!!}
				    
						<div class="cf-title">Practice View</div>
						
						<div class="row address-inputs">
							<div class="col-md-3">
								<input type="file" name="img[]" id="img-1" class="form-control"  required>
							</div>
							<div class="col-md-3">
								<input type="file" name="img[]" id="img-2" class="form-control"  required>
							</div>
							<div class="col-md-3">
								<input type="file" name="img[]" id="img-3" class="form-control"  required>
							</div>
							<div class="col-md-3">
								<input type="file" name="img[]" id="img-4" class="form-control"  required>
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
 $('#ccolor').val(xcc);
});
</script>
@stop

@stop