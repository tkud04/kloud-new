@extends("layout")

@section('title',"Dashboard")

@section('content')
@include('generic-banner',['title' => "Dashboard"])

<!-- dashboard section -->
	<section class="top-letest-product-section">
		<div class="container">
			<div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card text-center" style="">
         <div class="card-body">         
            <div class="">
            <h5 class="card-title"><i class="fa fa-briefcase fa-2x" aria-hidden="true"></i></h5>
            <p class="card-text">&#8358;{{number_format($wallet['balance'],2)}}</p>
            <a href="{{url('wallet')}}" class="btn btn-primary">Go to wallet</a>
            </div>
         </div>
       </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card text-center" style="">
         <div class="card-body">         
            <div class="">
            <h5 class="card-title"><i class="fa fa-check-square-o fa-2x" aria-hidden="true"></i></h5>
            <p class="card-text text-success">Account Verified</p>
            <a href="{{url('profile')}}" class="btn btn-primary">View profile</a>
            </div>
         </div>
       </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card text-center" style="">
         <div class="card-body">         
            <div class="">
            <h5 class="card-title"><i class="fa fa-shopping-bag fa-2x" aria-hidden="true"></i></h5>
            <p class="card-text text-success">0 unpaid orders</p>
            <a href="{{url('orders')}}" class="btn btn-primary">View orders</a>
            </div>
         </div>
       </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card text-center" style="">
         <div class="card-body">         
            <div class="">
            <h5 class="card-title"><i class="fa fa-hourglass-half fa-2x" aria-hidden="true"></i></h5>
            <p class="card-text">No ongoing auctions</p>
            <a href="{{url('my-auctions')}}" class="btn btn-primary">Go to auctions</a>
            </div>
         </div>
       </div>
            </div>
        </div>
		<br><br>
		<div class="row mb-5">
          <div class="col-lg-12 mx-auto text-center">
            <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Notifications</h4>
                  <p class="card-category">as at <?=date("jS F, Y")?> <a class="btn btn-success pull-right" href="{{url('transactions')}}">View more</a></p>                 
                </div>
                <div class="card-body kloud-data-table table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                                                <th>Type</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                    </thead>
                    <tbody>
                      @if($transactions != null && count($transactions) > 0)
                       <?php
                         $tmax = (count($transactions) >= 5) ? 5 : count($transactions); 
                       ?>
                                              @for($i = 0; $i < $tmax; $i++)
                                              <?php
                                               $t = $transactions[$i]; 
                                              ?>
                                                 <tr>
                                                  <td><span class="badge {{$t['badgeClass']}} text-uppercase">{{$t['type']}}</span></td>
                                                  <td>{!! $t['description'] !!}</td>
                                                  <td>&#8358;{{number_format($t['amount'],2)}}</td>
                                                 </tr>
                                              @endfor
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