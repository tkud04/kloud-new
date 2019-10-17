@extends("layout")

@section('title',"My Wallet")

@section('styles')
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
@stop

@section('content')
@include('generic-banner',['title' => "My Wallet"])


	<!-- kloudpay section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>KloudPay Wallet</h2>
			</div>
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <h4><i class="fa fa-briefcase"></i> Balance: &#8358;{{number_format($wallet['balance'],2)}}</h4>
            <br>
            <div class="row">
               <div class="col-lg-4 col-md-6 col-sm-6">
                  <a href="{{url('deposit')}}" class="btn btn-primary btn-lg text-white">Make a Deposit</a>
               </div>
			   <div class="col-lg-4 col-md-6 col-sm-6">
                  <a href="{{url('withdraw')}}" class="btn btn-primary btn-lg text-white">Make a Withdrawal</a>
               </div>
			   <div class="col-lg-4 col-md-6 col-sm-6">
                  <a href="{{url('kloudpay-transfer')}}" class="btn btn-primary btn-lg text-white">Transfer Money</a>
               </div>
           
            </div>
            <br>
            	
          </div><br><br>
		  <div class="col-lg-12 mx-auto text-center" style="margin-top: 20px;">
		    <div class="card border-0">
                <div class="card-title">
                   <h4>Recent Transactions</h4>                  
                </div>
                <div class="card-body">
                	<div class="table-responsive m-t-5">
                	   <table id="" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                	     <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @if($transactions != null && count($transactions) > 0)
                                              @foreach($transactions as $t)
                                                 <tr>
                                                  <td><span class="badge {{$t['badgeClass']}} text-uppercase">{{$t['type']}}</span></td>
                                                  <td>{!! $t['description'] !!}</td>
                                                  <td>&#8358;{{number_format($t['amount'],2)}}</td>
                                                  <td>{{$t['date']}}</td>
                                                 </tr>
                                              @endforeach
                                            @endif	
                                        </tbody>
                       </table>
                    </div>
                </div>
                                    </div>
              <br>
            	<center><a href="{{url('transactions')}}" class="site-btn sb-dark">See more</a></center>
		  </div>
        </div>
		</div>
	</section>
	<!-- kloudpay section end -->
	
	
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