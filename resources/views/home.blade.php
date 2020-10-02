@extends('layouts.app')

@section('title', 'Home')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
      Dashboard
  </h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-4">
			<a href="{{ url('/manage-products') }}">
			<div class="info-box">
	        <!-- Apply any bg-* class to to the icon to color it -->
	        <span class="info-box-icon bg-green"><i class="fa fa-cart-plus"></i></span>
	        <div class="info-box-content">
	          <span class="info-box-text">Product in Store</span>
	          <span class="info-box-number">{{ $instock[0]->countInstoke }}</span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	      </a>
		</div>
		@if(Auth::user()->hasRole('administrator') || Auth::user()->hasRole('stock_manager'))
			@if(Auth::user()->can('confirm_request'))
			<div class="col-lg-4">
				<a href="{{ url('/manage-request') }}">
				<div class="info-box">
		        <!-- Apply any bg-* class to to the icon to color it -->
		        <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
		        <div class="info-box-content">
		          <span class="info-box-text">Un-Confirmed Request</span>
		          <span class="info-box-number">{{ $reqCo[0]->request_count }}</span>
		        </div><!-- /.info-box-content -->
		      </div><!-- /.info-box -->
		  	 </a>
			</div>
			@endif

		<div class="col-lg-4">
			<a href="{{ url('/manage-requests/confirmed-requests') }}">
			<div class="info-box">
	        <!-- Apply any bg-* class to to the icon to color it -->
	        <span class="info-box-icon bg-purple"><i class="fa fa-archive"></i></span>
	        <div class="info-box-content">
	          <span class="info-box-text">Confirmed Request</span>
	          <span class=" info-box-number">{{ $confCo[0]->conf_count }}</span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	  	 </a>
		</div>
		@endif


		<div class="col-lg-4">
			<a href="{{ url('/manage-prices/create') }}">
			<div class="info-box">
	        <!-- Apply any bg-* class to to the icon to color it -->
	        <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>
	        <div class="info-box-content">
	          <span class="info-box-text">Product with no price</span>
	          <span class="info-box-number">{{ $price[0]->priceCount }}</span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	      </a>
		</div>

		@if(Auth::user()->hasRole('administrator'))
		<div class="col-lg-4">
			<a href="{{ url('/manage-permissions/all-permissions') }}">
			<div class="info-box">
	        <!-- Apply any bg-* class to to the icon to color it -->
	        <span class="info-box-icon bg-light-blue"><i class="fa fa-universal-access"></i></span>
	        <div class="info-box-content">
	          <span class="info-box-text">System Permission</span>
	          <span class="info-box-number">{{ $permissionCount[0]->permissionCount }}</span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	     </a>
		</div>

		<div class="col-lg-4">
			<a href="{{ url('/manage-users') }}">
			<div class="info-box">
	        <!-- Apply any bg-* class to to the icon to color it -->
	        <span class="info-box-icon bg-blue"><i class="fa fa-user-o"></i></span>
	        <div class="info-box-content">
	          <span class="info-box-text">System users</span>
	          <span class="info-box-number">{{ $userCount[0]->userCount }}</span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	  	 </a>
		</div>
	 @endif
	</div>
	<br>
	<br>
	<br>

	<div class="row">
		<div class="col-lg-12">
			@if(($goodCount[0]->goodCon>0) && ($badCount[0]->badCon>0) && ($leasedCount[0]->leasedCount>0) && ($soldCount[0]->soldCount>0) && ($instockCount[0]->instockCount>0))
			<table class="table table-striped">
				<thead>
					<tr>
						<th></th>
						<th>Product Good Condition</th>
						<th>Product Bad Condition</th>
						<th>Leased Product </th>
						<th>Sold Product</th>
						<th>In Store Product</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Number:</td>

						<td>
							{{ $goodCount[0]->goodCon }}</td>
						<td>{{ $badCount[0]->badCon }}</td>
						<td>{{ $leasedCount[0]->leasedCount }}</td>
						<td>{{ $soldCount[0]->soldCount }}</td>
						<td>{{ $instockCount[0]->instockCount }}</td>
					</tr>
					<tr>
						<td>Percent (%)</td>
						<td>
							 <?php
							 if(($goodCount[0]->goodCon>0) && ($badCount[0]->badCon>0) && ($leasedCount[0]->leasedCount>0) && ($soldCount[0]->soldCount>0) && ($instockCount[0]->instockCount>0)){
							  $perN = (($goodCount[0]->goodCon)/($goodCount[0]->goodCon + $badCount[0]->badCon)) * 100 ?>
							{{ number_format($perN,2).'%'  }}</td>
						<td>
							 <?php $perM = (($badCount[0]->badCon)/($goodCount[0]->goodCon + $badCount[0]->badCon)) * 100 ?>
							{{ number_format($perM,2).'%' }}
						</td>
						<td>
							 <?php $perf = (($leasedCount[0]->leasedCount)/($leasedCount[0]->leasedCount +  $soldCount[0]->soldCount + $instockCount[0]->instockCount)) * 100 ?>
							{{ number_format($perf,2).'%' }}
						</td>
						<td>
							 <?php $peru = (($soldCount[0]->soldCount)/($leasedCount[0]->leasedCount +  $soldCount[0]->soldCount + $instockCount[0]->instockCount )) * 100 ?>
							{{ number_format($peru,2).'%' }}
						</td>
						<td>
							<?php $perg = (($instockCount[0]->instockCount)/($leasedCount[0]->leasedCount +  $soldCount[0]->soldCount + $instockCount[0]->instockCount)) * 100 ?>
							{{ number_format($perg,2).'%' }}
						</td>
						<?php }?>
					</tr>
				</tbody>
			</table>
			@else
				<div class="alert alert-info col-lg-12">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>No Product with business status found in Store </strong>
				</div>
			@endif
		</div>
	</div>

</section>

@endsection
