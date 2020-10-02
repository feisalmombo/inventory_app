@extends('layouts.app')

@section('title', 'Add Price')

@section('content')
@if(Auth::user()->can('create_price'))
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Add Product Price</h1>
</section>

<!-- Main content -->
<section class="content col-sm-offset-3">
	<div class="row">
		<div class="col-lg-12">
			@include('msgs.success')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Add Price</h3><a href="{{ url('/manage-prices') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
				</div>
			 <div class="box-body">

				<div class="container-fluid">
					<section class="container col-sm-offset-3">
						<div class="container-page">
							<div class="center-block">
							<form role="form"  action="{{ url('/manage-prices') }}" method="POST">
								{{ csrf_field() }}
								<div class="col-lg-12 ">
									<div class="row center-block">
										<div class="form-group col-lg-5">
											<label>Product Name: </label>
											<input class="form-control" disabled="disabled" name="productid" value="{{ isset($addPrice[0]->product_name) ? $addPrice[0]->product_name : old('productid') }}">
											<input name="product_id" hidden="hidden" value="{{ $addPrice[0]->id }}">
										</div>
									 </div>


									<div class="row center-block">
										<div class="form-group col-lg-5">
											<label> Buying Price:</label>
											<input type="number" name="buyingPrice" class="form-control" placeholder="eg: 100000">
										</div>
								    </div>

									<div class="row center-block">
										<div class="form-group col-lg-5">
											<label> Minimum Selling Price:</label>
											<input type="number" name="minSalePrice" class="form-control" placeholder="eg: 10000">
										</div>
								    </div>

								    <div class="row center-block">
										<div class="form-group col-lg-5">
											<label> Actual Selling Price:</label>
											<input type="number" name="actualSalePrice" class="form-control" placeholder="eg: 10000">
										</div>
								    </div>


									<div class="form-group col-lg-5">
										<button type="submit" class="btn btn-primary center-block">
											Save
										</button>
									</div>
								</div>
							</form>
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
		<strong>Sorry!! You have no privillege to Add Price</strong>
	</div>

@endif
@endsection
