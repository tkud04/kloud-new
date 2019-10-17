@extends("layout")

@section('title',"My Orders")

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
                	<div class="table-responsive m-t-40">
                	   <table id="transactions-table" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
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

@stop