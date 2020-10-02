@extends('layouts.app')

@section('title', 'Products')

@section('content')
@if(Auth::user()->can('edit_product'))
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
     Edit Product Information
  </h1>
 
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
          <div class="box-header">
              <h3 class="box-title">Edit Product</h3><a href="{{ url('/manage-products') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
          </div>
            <!-- /.box-header -->
            <div class="box-body">
			
				<div class="container-fluid">
					<section class="container ">
							<div class="col-sm-12">
								@foreach($proData as $pro)
								<form role="form" id="sev" action="{{ url('/manage-products/'.$pro->id) }}" method="POST">

									{{ csrf_field() }} 
									{{ method_field('PATCH') }}
									
									<div class="row">
										<div class="col-lg-5 form-group">
											<label>Product Name: </label>
											<input class="form-control" name="productName"  value="{{ isset($pro->product_name) ? $pro->product_name : old('productName') }}">
										</div>

										<div class="col-lg-3 form-group">
											<label>Quantity: </label>
											<input class="form-control" name="productQuantity"  value="{{ isset($pro->quantity) ? $pro->quantity : old('productQuantity') }}">
										</div>

										<div class="col-lg-5 form-group">
											<label>Product Model: </label>
											<input class="form-control" name="productModel"  value="{{ isset($pro->product_model) ? $pro->product_model : old('productModel') }}">
										</div>


										{{-- <div class="col-lg-4 form-group">
											<label>Stock Name: </label>
											<select class="form-control"  required="required" name="store">
												<option> --- Select store ---</option>
												{{-- @foreach($stock as $store)
													<option value="{{ $store->id }}" {{ $selectedvalue == $store->id ? 'selected = "selected"' : '' }}>{{ $store->store_name }}</option>
												@endforeach --}}
											{{-- </select>
										</div>

										<div class="col-lg-4 form-group">
											<label>Category: </label>
											<select class="form-control"  required="required" name="store">
													<option> --- Select Category ---</option>
												{{-- @foreach($categoryPro as $store)
													<option value="{{ $store->id }}">{{ $store->category_name }}</option>
												@endforeach --}}
											{{--</select>
										</div> --}}


										<div class="col-lg-5 form-group">
						                	<label> Store Name:</label>&nbsp;&nbsp;{{ "  ".$pro->store_name }}
											<select class="form-control" id="storeId"  data-dependent="categoryId"  required="required"  name="store_id">
												<option value="#">---Select Store---</option>
														@foreach($stores as $store)
														<option value="{{ $store->id }}">{{ $store->store_name }}</option>
														@endforeach
											</select>
						                </div>


										
										 
						                <div class="col-lg-5 form-group">

										 	<?php $selectedStatus = $pro->pstatus_id; ?>
						                	<label> Product Status:</label>
											<select class="form-control" required="required"  name="pro_status_id">
												<option value="#">---Select Status---</option>
														@foreach($proStatus as $status)
														<option value="{{ $status->id }}" {{ $selectedStatus == $status->id ? 'selected = "selected"' : '' }}>{{ $status->pro_status_name }}</option>
														@endforeach
											</select>
										</div>

						                <div class="col-lg-5 form-group">
												<label>Category Name:  </label>&nbsp;&nbsp;{{ "  ".$pro->category_name }}
												<select class="form-control" id="categoryId" required="required" name="categoryId">
												</select>
										  </div>

										 

										<div class="col-lg-5 form-group">
											<label>Product Description: </label>
											<textarea class="form-control" name="productDescr">{{ isset($pro->content) ? $pro->content : old('productDescr') }}</textarea>
										</div>


										

										 <div class="col-lg-5 form-group">

						                	@if($pro->pro_status_name == 'InStock')
						                		<label> Bank Name:</label>
												<input class="form-control" disabled="disabled" value="{{ isset($pro->bank_name) ? $pro->bank_name : old('bankId') }}">

												<input hidden="hidden" name="bankId"  value="{{ $pro->bank_id }}">
						                	@else
										 	<?php $selectedBank = $pro->bank_id; ?>
						                	<label> Bank Name:</label>
											<select class="form-control" required="required"  name="bankId">
												<option value="#">---Select Bank---</option>
														@foreach($bank as $ba)
														<option value="{{ $ba->id }}" {{ $selectedBank == $ba->id ? 'selected = "selected"' : '' }}>{{ $ba->bank_name }}</option>
														@endforeach
											</select>
											@endif
										</div>


			
										<div class="col-lg-5 form-group">
										 	<?php $selectedCondition = $pro->condition_id; ?>
										  	<label>Product Condition: </label>
							                   <div class="radio">
							                    <label>
							                      <input type="radio" name="conditionRadios" id="goodRadios" value="1" {{ $selectedCondition == 1 ? 'checked = "checked"' : '' }}>
							                      Good
							                    </label>
							                   </div>

							                   <div class="radio">
							                    <label>
							                      <input type="radio" name="conditionRadios" id="badRadios" value="2" {{ $selectedCondition == 2 ? 'checked = "checked"' : '' }}>
								                      Bad
							                    </label>
							                   </div>
						              	  </div>
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary center-block">
											Update
										</button> 
									</div>
								</form>
								@endforeach
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
		<strong>Sorry!! You have no privillege to Update Product</strong> 
	</div>

@endif
@endsection