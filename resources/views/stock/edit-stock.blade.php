@extends('layouts.app')

@section('title', 'Store')

@section('content')
@if(Auth::user()->can('edit_store'))
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
     Edit Store Information
  </h1>
 
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
          <div class="box-header">
              <h3 class="box-title">Edit Store</h3><a href="{{ url('/product-store') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
          </div>
            <!-- /.box-header -->
            <div class="box-body">
			
				<div class="container-fluid">
					<section class="container col-sm-offset-3">
						<div class="container-page">
							<div class="col-sm-6">
								<form role="form" id="sev" action="{{ url('/product-store/'.$store->id) }}" method="POST" class="form-horizontal">

									{{ csrf_field() }} 
									{{ method_field('PATCH') }}
									
									<div class="col-lg-12 center-block">
										<div class="form-group">
											<label>First Name: </label>
											<input class="form-control" name="storeName"  value="{{ isset($store->store_name) ? $store->store_name : old('storeName') }}">
										</div>
										{{-- <div class="form-group">
											<label>Slug: </label>
											<input class="form-control" name="slugName"  value="{{ isset($store->store_slug) ? $store->store_slug : old('slugName') }}">
										</div> --}}
										
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
		<strong>Sorry!! You have no privillege to Update Store</strong> 
	</div>

@endif
@endsection