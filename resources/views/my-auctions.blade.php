@extends("layout")

@section('title',"My Auctions")

@section('styles')
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
@stop


@section('content')
@include('generic-banner',['title' => "My Auctions"])

<!-- my auctions section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <div class="table-responsive m-t-40 wow fadeInUp">
                	   <table class="table kloud-data-table" id="dealsTable">
                      <thead class=" text-primary">
                           <th>Auction</th>
                                                <th>Amount</th>
                                                <th>Total bids</th>
                                                <th>Time left</th>
                                                <th>Status</th>
                                                <th>Highest bidder</th>
                                                <th>Date created</th>
                                                <th>Actions</th>
                      </thead>
                        <tbody>
                                        	@if($auctions != null && count($auctions) > 0)
                                              @foreach($auctions as $a)
                                              <?php
                    $deal = $a['deal'];
                    $images = $deal['images'];
                         shuffle($images);
                        if(count($images) < 1) { $imggs = ["img/no-image.png"]; }
                                      else{
                                      	$ird = $images[0]['url'];
										if($ird == "none")
										{
											$imggs = ["img/no-image.png"];
										}
										else
										{
                                      	  for($x = 0; $x < $images[0]['irdc']; $x++)
										  {
                                      	   $jara = "";
                                           if($x > 0) $jara = "-".($x + 1);
                                      	   $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$ird.$jara;
                                           array_push($imggs,$imgg); 
                                          }
										}
                                      }
                    $du = url('deal')."?sku=".$deal['sku'];
                    $bp = "&#8358;".number_format($a['auction_price'],2);
                    $hb = "Unknown";
                    $hbb = (isset($a['hb'])) ? $a['hb'] : "no";
                    if($hbb != "no") $hb = $hbb->fname." ".$hbb->lname;
                    $eu = url('end-auction')."?xf=".$a['id'];
                    $deu = url('delete-auction')."?xf=".$a['id'];
					if($a['status'] == "ended") $frf = "frf";
					else if($a['status'] == "live") $frf = "wyret";
                  ?>
                                                 <tr>
                                                  <td>
                                                  	<center>
                                <img src="{{$imggs[0]}}" width="100" height="155" class="cli" data-cli="{{$du}}" alt="">
                                
                                </center><br>
                                <a href="{{$du}}">{{$deal['name']}}</a>
                                                  </td>
                                                  <td>{!! $bp !!}</td>
                                                  <td>{{$a['total-bids']}}</td>
                                                  <td>
                                                    <div id="cdc-{{$a['id']}}"></div>
                                                    <script>
													    ertyw = "{{$frf}}";
	                                                    nq = new Date("{{$a['ed']}}");
                                                        getcd(nq,"cdc-{{$a['id']}}");
                                                    </script>
                                                  </td>
                                                  <td>
                                                  	@if($a['status'] == "live")
                                                  	<span class="text-primary text-bold">Live</span>
                                                      @elseif($a['status'] == "ended")
                                                      <span class="text-danger text-bold">Ended</span>
                                                      @endif
                                                  </td>	
                                                  <td>{{$hb}}</td>
                                                  <td>{{$a['date']}}</td>
                                                  <td>
                                                  	@if($a['status'] == "live")
                                                  	<a href="{{$eu}}" class="btn btn-primary btn-lg">End now</a>
                                                      @endif
                                                      <a href="{{$deu}}" class="btn btn-danger btn-lg">Delete</a>
                                                  </td>	
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