@extends('layouts.app')

@section('title', 'Show Price')

@section('content')
@if(Auth::user()->can('view_price'))
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Product price Information
	</h1>

</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-12"> 
			@include('msgs.success')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Show Product Price</h3><a href="{{ url('/manage-prices') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="container-fluid">
						<section class="container col-sm-offset-3">
							<div class="container-page">
							<div class="col-sm-8">
								@foreach($prices as $price)
																
								<div class="modal-body">
											<div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Product Name: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $price->product_name }}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											  <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Buying Price: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $price->buying_price }}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											  <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Minimum Selling Price: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $price->min_selling_price }}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											
											  @endforeach
								  </div>
								
							</div>
						</div>
						<div class="row">
									<div class="pull-right col-lg-8">
										
										<div class="col-lg-2">
											<form action="{{url('/manage-prices/pdf/downloadPdf')}}" method="POST"> 
														{{ csrf_field() }}
											<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($prices)); ?>" name="tad">
											<div class="col-lg-9">
												<button class="btn btn-info" type="submit" name="submit">
													<span class="fa fa-file-pdf-o" aria-hidden="true"> Download PDF</span>
												</button>
											</div>
											</form>
											
										</div>	
									   <div class="col-lg-1"></div>
										<div class="col-lg-2">

											<form action="{{url('/manage-prices/excel/download/xlsx')}}" method="POST"> 
														{{ csrf_field() }}
											<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($prices)); ?>" name="tadas">
											<div class="col-lg-9">
												<button class="btn btn-success" type="submit" name="submit">
													<span class="fa fa-file-excel-o" aria-hidden="true"> Download Excel</span>
												</button>
											</div>
											</form>
											
										</div>
									</div>
								</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@else
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Sorry!! You have no privillege to View more details about Price</strong> 
	</div>
@endif
@endsection