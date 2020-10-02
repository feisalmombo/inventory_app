@extends('layouts.app')

@section('title', 'Add Price')

@section('content')
@if(Auth::user()->can('create_price'))
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1> Add Product Price </h1>
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
										<div class="form-group col-lg-4">
											<label>Product Name: </label>
											<select class="form-control"  required="required" name="product_id">
												<option value="#">---Select Category---</option>
												@foreach($products as $product)
												<option value="{{ $product->id }}">{{ $product->product_name }}</option>
												@endforeach
											</select>
										</div>
									 </div>


									<div class="row center-block">
										<div class="form-group col-lg-4">
											<label> Buying Price:</label>
											<input type="number" name="buyingPrice" class="form-control" placeholder="eg: 100000">
										</div>
								    </div>
									
									<div class="row center-block">
										<div class="form-group col-lg-4">
											<label> Minimum Selling Price:</label>
											<input type="number" name="minSalePrice" class="form-control" placeholder="eg: 10000">
										</div>
								    </div>


									<div class="form-group col-lg-4">
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