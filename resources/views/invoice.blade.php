@extends("layout")

@section('title',"Invoice")

@section('content')
@include('generic-banner',['title' => "Invoice"])

<!-- invoice section -->
	<section class="top-letest-product-section">
		@if($alert)
 <div class="alert alert-<?=$alertClass?> alert-dismissible fade show" role="alert">
  <?=$alertText?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<?php
						 $company = ""; $address = ""; $city = ""; $state = ""; $zipcode = "";
						 
						 if(count($sd) > 0)
						 {
							 if(isset($sd['company'])) $company = $sd['company'];
							 if(isset($sd['address'])) $address = $sd['address'];
							 if(isset($sd['city'])) $city = $sd['city'];
							 if(isset($sd['zipcode'])) $zipcode = $sd['zipcode'];
							if(isset($sd[0]['state'])) $state = $sd[0]['state'];
						 } 
						?>
       <div class="container">
          <div class="row mt-5">
          	<div class="col-md-6">
          	   <h2>KloudTransact Invoice {{$invoice['number']}}</h2>
              </div>
              <div class="col-md-3">
              	
              </div>
              <div class="col-md-3">
              	<h4 class="pull-right">
              	  <strong>Invoice</strong> {{$invoice['number']}}<br>
                    <strong>Invoice Date</strong> {{$invoice['date']}}<br>
                    <strong>Due Date</strong> {{$invoice['date']}}
                  </h4>
              </div>
          </div>
          <div class="row mt-5">
          	<div class="col-md-5">
          	   <h4 class="pull-left">
              	  <strong>To</strong> {{$user->fname." ".$user->lname}}<br>
                    <strong>{{$address}}</strong><br>
                    <strong>{{$city}}</strong><br>
                    <strong>{{$state}}</strong><br>
                  </h4>
              </div>
              <div class="col-md-3">
              	<center>
              	  <h4> <strong>From: KloudTransact Ltd.</strong></h4><br>
                  </center>
              </div>
              <div class="col-md-4 text-right">
              	<h4 class="pull-right">
              	  <strong>Status: </strong> <span class="badge badge-<?=$alertClass?>"><?=$invoice['status']?></span><br><br>
                    <strong>Total: </strong><span class="badge badge-secondary">&#8358;{{number_format($invoice['amount'],2)}}</span><br>
                  </h4>
              </div>
          </div><br>
          <div class="row mt-5">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Invoice Details</h4>
                  <p class="card-category"> </p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          Deal
                        </th>
                        <th>
                          Taxed? 
                        </th>
                        
                        
                      </thead>
                      <tbody>
                        @foreach($invoice['totals']['md'] as $od)
                        
                        <tr>
                          <td>
                            <strong>{!! $od !!}</strong>
                          </td>
                          <td>
                            No
                          </td>
                                              
                        </tr>   
                        @endforeach
                        <tr>
                          <td>
                            <strong>Sub-total</strong>
                          </td>
                          <td class="text-primary">
                           &#8358;{{number_format($invoice['totals']['subtotal'],2)}}
                          </td>                     
                        </tr>
                        <tr>
                          <td>
                            <strong>Delivery fee</strong>
                          </td>
                          <td class="text-primary">
                           &#8358;{{number_format($invoice['totals']['delivery'],2)}}
                          </td>                     
                        </tr>
                        <tr style="border-top: 2px solid !important;">
                          <td>
                            <strong>Total</strong>
                          </td>
                          <td class="text-primary">
                           &#8358;{{number_format($invoice['totals']['total'],2)}}
                          </td>                     
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="row mt-5">
          	<div class="col-md-12">
          	  <a class="btn btn-lg btn-primary" href="{{url('invoices')}}">Go to Invoices</a>
          	</div>
          </div> -->
        </div>
	</section>
	<!-- invoice section end -->

@stop