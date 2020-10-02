@extends('layouts.app')

@section('title', 'Products')

@section('content')
@if(Auth::user()->can('view_product'))
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Product Information
	</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-12"> 
			@include('msgs.success')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Show Product</h3><a href="{{ url('/manage-products') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="container-fluid">
						<section class="container col-sm-offset-3">
							<div class="container-page">
							<div class="col-sm-8">
								@foreach($showInfo as $value)
																
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
														{{ $value->product_name }}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											  <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Product Model:  </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $value->product_model }}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											   <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Product Quantity:  </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $value->quantity }}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											  <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Product Category: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{  $value->category_name }}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											  <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Store: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $value->store_name}}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											  <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Condition: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $value->condition_name}}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											   <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Status: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $value->pro_status_name}}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											   <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Product Desciption: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $value->content}}
													</div>
												</div>
											    </div>
											  </div>

											  <div class="row">
											  	<div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Product History: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $value->updated_at}}
													</div>
												</div>
												 <div class="center-block">
													<div class="form-group">
														<a href="{{ url('manage-products/product-history/'.$value->id) }}"> <button type="button" class="btn btn-warning"><i class="fa fa-history" arial-hidden="true"></i> Archive</button></a>
													</div>
												</div>


										@endforeach

											  </div>
								  </div>
								
							</div>
						</div>
						<div class="row">
									<div class="pull-right col-lg-8">
										
										<div class="col-lg-2">
											<form action="{{url('/manage-products/pdf/downloadPdf')}}" method="POST"> 
														{{ csrf_field() }}
											<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($showInfo)); ?>" name="tad">
											<div class="col-lg-9">
												<button class="btn btn-info" type="submit" name="submit">
													<span class="fa fa-file-pdf-o" aria-hidden="true"> Download PDF</span>
												</button>
											</div>
											</form>
											
										</div>	
									   <div class="col-lg-1"></div>
										<div class="col-lg-2">

											<form action="{{url('/manage-products/excel/download/xlsx')}}" method="POST"> 
														{{ csrf_field() }}
											<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($showInfo)); ?>" name="tadas">
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
		<strong>Sorry!! You have no privillege to View more details about Product</strong> 
	</div>
@endif
@endsection