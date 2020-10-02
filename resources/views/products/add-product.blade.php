@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
@if(Auth::user()->can('create_product'))

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Add Product Information </h1>
</section>

<!-- Main content -->
<section class="content col-sm-offset-3">
 <div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
	      <div class="box-header">
	          <h3 class="box-title">Add Product</h3><a href="{{ url('/manage-products') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
	        </div>
            <div class="box-body">
 			<div class="container-fluid">
				<section class="container">
 				<div class="col-lg-12">
				<form role="form" action="{{ url('/manage-products') }}" method="POST">
					{{ csrf_field() }} 
		           <div class="row">

	                <div class="col-lg-5 form-group">
	                	<label> Product Name:</label>
	                  <input type="text" name="productName" required="required" class="form-control" placeholder="eg: Pinpad">
	                </div>

	                <div class="col-lg-3 form-group">
	                	<label> Quantity:</label>
	                  <input type="number" name="productQuantity" class="form-control" placeholder="eg: 16">
	                </div>
	                 
	                 <div class="col-lg-5 form-group">
	                	<label> Product Model:</label>
	                  <input type="text" name="productModel" class="form-control" placeholder="eg: Pinpad-Deibord C297">
	                </div>


	                <div class="col-lg-5 form-group">
	                	<label> Store Name:</label>
						<select class="form-control" id="storeId"  data-dependent="categoryId"  required="required"  name="store_id">
							<option value="#">---Select Store---</option>
									@foreach($storePro as $store)
									<option value="{{ $store->id }}">{{ $store->store_name }}</option>
									@endforeach
						</select>
	                </div>

		            <div class="col-lg-5 form-group">
					  	<label> Product Description:</label>
		                    <textarea class="form-control" rows="3"  name="pro_descr" placeholder="eg: This is for deibord Noxdorf"></textarea>
		              </div>
				  	
		               <div class="col-lg-5 form-group">
							<label>Category Name: </label>
							<select class="form-control" id="categoryId" required="required" name="category_id">
								<option value="#">---Select Category---</option>
										 @foreach($categoriesPro as $category)
										
										<option value="{{ $category->id }}">{{ $category->category_name }}</option>
										@endforeach
							</select>
					  </div>
		              
					<div class="col-lg-3 form-group">
					  	<label>Product Condition: </label>
		                   <div class="radio">
		                    <label>
		                      <input type="radio" name="conditionRadios" id="goodRadios" value="good">
		                      Good
		                    </label>
		                   </div>

		                   <div class="radio">
		                    <label>
		                      <input type="radio" name="conditionRadios" id="badRadios" value="bad">
			                      Bad
		                    </label>
		                   </div>
	              	  </div>

	              	  
					<input type="text"  name="statusRadios" hidden="hidden" value="instock">
{{-- 
		              <div class="col-lg-3 form-group">
							<label>Product Status: </label>
		                   <div class="radio">
		                    <label>
		                      <input type="radio" name="conditionRadios" id="instoreRadios" value="instore">
		                      In Store
		                    </label>
		                   </div>

		                   <div class="radio">
		                    <label>
		                      <input type="radio" name="conditionRadios" id="leasedRadios" value="leased">
			                    Leased
		                    </label>
		                   </div>

		                   <div class="radio">
		                    <label>
		                      <input type="radio" name="conditionRadios" id="soldRadios" value="sold">
		                      Sold
		                    </label>
		                   </div>
					  </div> --}}
					  					  
	              	  </div>
				  </div>
				  <div class="form-group">
							<button type="submit" style="margin-left:auto;margin-right:auto; margin-top:5%; display:block;margin-bottom:0%" class="btn btn-primary">
								Save
							</button> 
						</div>
            	</form>	
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
		<strong>Sorry!! You have no privillege to Add Product</strong> 
	</div>

@endif
@endsection