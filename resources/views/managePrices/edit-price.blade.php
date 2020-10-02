@extends('layouts.app')

@section('title', 'Edit Price')

@section('content')
@if(Auth::user()->can('edit_price'))
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
     Edit Price Information
  </h1>
 
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
          <div class="box-header">
              <h3 class="box-title">Edit Price</h3><a href="{{ url('/manage-prices') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
          </div>
            <!-- /.box-header -->
            <div class="box-body">
			
				<div class="container-fluid">
					<section class="container col-sm-offset-3">
						<div class="container-page">
							<div class="col-sm-6">
								@foreach($price as $prices)
								<form role="form" id="sev" action="{{ url('/manage-prices/'.$prices->id) }}" method="POST" class="form-horizontal">

									{{ csrf_field() }} 
									{{ method_field('PATCH') }}
									
									<div class="col-lg-12 center-block">
										<div class=" form-group">
						                	<label> Product Name:</label>
											<select class="form-control" id="productId"  data-dependent="productId"  required="required"  name="product_id">
												<option value="{{ $prices->product_id }}"> {{ "  ".$prices->product_name }}</option>
														@foreach($products as $product)
														<option value="{{ $product->id }}">{{ $product->product_name }}</option>
														@endforeach
											</select>
						                </div>
										
										<div class="form-group">
											<label>Buying Price: </label>
											<input class="form-control" name="BuyingPrice" required="required" value="{{ isset($prices->buying_price) ? $prices->buying_price : old('BuyingPrice') }}">
										</div>
										<div class="form-group">
											<label>Minimum Selling Price: </label>
											<input class="form-control" name="minSellingPrice" required="required" value="{{ isset($prices->min_selling_price) ? $prices->min_selling_price : old('minSellingPrice') }}">
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-primary center-block">
												Update
											</button> 
										</div>
									</div>
								</form>
								@endforeach
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
		<strong>Sorry!! You have no privillege to Update Product Price</strong> 
	</div>

@endif
@endsection