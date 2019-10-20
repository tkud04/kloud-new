@extends("layout")

@section('title',"Transactions")

@section('styles')
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
@stop


@section('content')
@include('generic-banner',['title' => "Transactions"])

<!-- transactions section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <div class="table-responsive m-t-40 wow fadeInUp">
                	   <table class="table kloud-data-table" id="dealsTable">
                      <thead class=" text-primary">
                            <th>Type</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                                <th>Date</th>
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
		</div>
	</section>
	<!-- my auctions section end -->
	

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