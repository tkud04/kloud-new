@extends("layout")

@section('title',"My Deals")

@section('styles')
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
@stop


@section('content')
@include('generic-banner',['title' => "My Deals"])

<!-- my deals section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
          <div class="col-lg-12 mx-auto text-center">
		    <a href="{{url('deal-new')}}" class="site-btn">Add New Deal</a>
            <div class="table-responsive m-t-40 wow fadeInUp">
                	   <table class="table kloud-data-table" id="dealsTable">
                      <thead class=" text-primary">
                        <th>
                          Deal
                        </th>
                        <th>
                          SKU
                        </th>  
                        <th>
                          Rating
                        </th>  
                        <th>
                          Status
                        </th>  
                        <th>
                          Actions
                        </th>
                      </thead>
                      <tbody>
                        @foreach($deals as $d)
                        <?php
                    $images = $d['images'];
                         shuffle($images);
                         if(count($images) < 1) { $imggs = ["img/no-image.png"]; }
                                      else{                                     	
                                      	for($x = 0; $x < count($images); $x++)
										  {
											$ird =$images[$x]['url'];
											if($ird == "none")
										    {
											  $imgg = "img/no-image.png";
										    }
                                      	   else
                                             {
                                      	    $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$ird;
                                             }
                                             array_push($imggs,$imgg); 
                                          }
                                      }
                    $du = url('edit-deal')."?sku=".$d['sku'];
                  ?>
                        <tr>
                          <td>
                            <center>
                                <img src="{{$imggs[0]}}" width="100" height="155" class="cli" data-cli="{{$du}}" alt="">
                                
                                </center><br>
                                <a href="{{$du}}">{{$d['name']}}</a>
                          </td>
                          <td>
                            {{$d['sku']}}
                          </td>
                          <td>
                            @for($u = 0; $u < $d['rating']; $u++)
                            	<i class="material-icons text-primary">star</i>
                            @endfor
                          </td>
                          <td class="text-info">
                           {{$d['data']['in_stock']}}
                          </td>
                          <td>
                           <a class="btn btn-success" href="{{$du}}"> View</a>
                           <a class="btn btn-warning" href="{{url('delete-deal').'?xf='.$d['sku']}}"> Delete</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    </div>
          </div>
        </div>
		</div>
	</section>
	<!-- my deals section end -->
	
	

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