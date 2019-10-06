@extends("layout")

@section('title',$title)

@section('content')
@include('generic-banner',['title' => $title])

<!-- Contact section -->
	<section class="contact-section">
		<div class="container">
			<div class="row">
			    <div class="col-lg-12 mx-auto text-center">
                     <iframe id='travelstartIframe-614d8e9d-b9c3-4b55-b22d-d3f56291045d' src="https://www.travelstart.com.ng" frameBorder='0'  style='margin: 0px; padding: 0px; border: 0px; width:100%; height: 600px; background-color: #fafafa;overflow:scroll'></iframe>
                </div>
			</div>
        </div>
    </section><br>
@stop