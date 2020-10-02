@extends('layouts.app')

@section('title', 'Category')

@section('content')
@if(Auth::user()->can('edit_category'))
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
     Edit Category Information
  </h1>
 
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
          <div class="box-header">
              <h3 class="box-title">Edit Category</h3><a href="{{ url('/product-categories') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
          </div>
            <!-- /.box-header -->
            <div class="box-body">
			
				<div class="container-fluid">
					<section class="container col-sm-offset-3">
						<div class="container-page">
							<div class="col-sm-6">
								<form role="form" id="sev" action="{{ url('/product-categories/'.$category[0]->id) }}" method="POST" class="form-horizontal">

									{{ csrf_field() }} 
									{{ method_field('PATCH') }}
									
									<div class="col-lg-12 center-block">
										<div class="form-group">
											<label>Category Name: </label>
											<input class="form-control" name="categoryName"  value="{{ isset($category[0]->category_name) ? $category[0]->category_name : old('categoryName') }}">
										</div>
										<div class="form-group">
											<label>Store Name: </label>

											{{-- <input name="id_store" hidden="hidden" value="{{ $category[0]->store_id }}">  --}}
											<?php $selectedvalue = $category[0]->store_id; ?>

											<select class="form-control"  required="required" name="store">
												<option> --- Select store ---</option>
												@foreach($stock as $store)
													<option value="{{ $store->id }}" {{ $selectedvalue == $store->id ? 'selected = "selected"' : '' }}>{{ $store->store_name }}</option>
												@endforeach
											</select>
										</div>

										<div class="form-group">
											<label>Category Description: </label>
											<textarea class="form-control"  name="descr">{{ isset($category[0]->description) ? $category[0]->description : old('descr') }}</textarea>
										</div>
										<div class="form-group">
											<button type="submit" class="btn btn-primary center-block">
												Update
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
		<strong>Sorry!! You have no privillege to Update Category</strong> 
	</div>

@endif
@endsection