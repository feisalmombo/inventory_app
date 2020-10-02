@extends('layouts.app')

@section('title', 'Add Store')

@section('content')
@if(Auth::user()->can('create_store'))

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Add Store Information </h1>
</section>

<!-- Main content -->
<section class="content col-sm-offset-3">
 <div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
	      <div class="box-header">
	          <h3 class="box-title">Add Store</h3>
	          <a href="{{ url('/product-store') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
	        </div>
            <!-- /.box-header -->
            <div class="box-body">

				<div class="container-fluid">
					<section class="container col-sm-offset-3">
						<div class="container-page">
							<div class="center-block">
							<form role="form"  action="{{ url('/product-store') }}" method="POST">
								{{ csrf_field() }} 
								<div class="col-lg-12 ">
									<div class="row center-block">
										<div class="form-group col-lg-6">
											<label>Store Name: </label>
											<input class="form-control" name="storeName" required="required"  placeholder="eg: Umoja Headquater">
										</div>
									 </div>


									{{-- <div class="row center-block">
										<div class="form-group col-lg-6">
											<label>Slug: </label>
											<input type="text" class="form-control" required="required"  name="slugName" placeholder="eg: umoja_headquater">
										</div>
								    </div> --}}
									

									<div class="form-group col-lg-6">
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
		<strong>Sorry!! You have no privillege to Add Store</strong> 
	</div>
@endif
@endsection