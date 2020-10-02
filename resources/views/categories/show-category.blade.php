@extends('layouts.app')

@section('title', 'Category')

@section('content')
@if(Auth::user()->can('view_category'))

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Category Information
	</h1>

</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-lg-12"> 
			@include('msgs.success')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Show Category</h3><a href="{{ url('/product-categories') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="container-fluid">
						<section class="container col-sm-offset-3">
							<div class="container-page">
							<div class="col-sm-6">
								@foreach($categories as $category)
																
								<div class="modal-body">
											<div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Category Name: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $category->category_name }}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											  <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Store Name: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $category->store_name }}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											  <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Desciption: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $category->description }}
													</div>
												</div>
											    </div>
											  </div>
											
											  @endforeach
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
		<strong>Sorry!! You have no privillege to View more details about Category</strong> 
	</div>
@endif
@endsection