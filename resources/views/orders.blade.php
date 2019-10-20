@extends("layout")

@section('title',"My Orders")

@section('styles')
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
@stop


@section('content')
@include('generic-banner',['title' => "My Orders"])

<script> let cdb = "deal";</script>
<!-- dashboard section -->
	<section class="top-letest-product-section">
		<div class="container">
		<div class="section-title">
				<h2>All orders</h2>
			</div>
			<div class="row">
			<div class="col-lg-12">
			<div class="card">
            <div class="card-body">
                	<div class="table-responsive m-t-40 wow fadeInUp">
                	   <table id="orders-table" class="kloud-data-table table" cellspacing="0" width="100%">
                	     <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@if($orders != null && count($orders) > 0)
                                              @foreach($orders as $o)
                                                <?php
                                                  $url = url('invoice').'?on='.$o['number']; 
                                                ?>
                                                 <tr>
                                                  <td>{{$o['number']}}</td>
                                                  <td>&#8358;{{number_format($o['amount'],2)}}</td>
                                                  <td>{{$o['status']}}</td>
                                                  <td><a class="btn btn-primary" href="{{$url}}" target="_blank">View Invoice</a></td>
                                                 </tr>
                                              @endforeach
                                            @endif
                                        </tbody>
                       </table>
                    </div>
                   </div>
            </div>
            </div>

		
		</div>
	</section>
	<!-- dashboard section end -->

@include('ad-space')
@stop



@section('scripts')
    <!-- DataTables js -->
       <script src="lib/datatables/js/datatables.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="lib/datatables/js/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="lib/datatables/js/datatables-init.js"></script>
@stop