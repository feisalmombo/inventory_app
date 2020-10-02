@extends('layouts.app')

@section('title', 'Add User')

@section('content')
@if(Auth::user()->can('create_user'))
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Add User Information </h1>
</section>

<!-- Main content -->
<section class="content col-sm-offset-3">
 <div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
	      <div class="box-header">
	          <h3 class="box-title">Add User</h3><a href="{{ url('/manage-users') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
	        </div>
            <!-- /.box-header -->
            <div class="box-body">

				<div class="container-fluid">
					<section class="container col-sm-offset-3">
						<div class="container-page">
							<div class="center-block">
							<form role="form"  action="{{ url('/manage-users') }}" method="POST">
								{{ csrf_field() }} 
								<div class="col-lg-12 ">
									<div class="row center-block">
										<div class="form-group col-lg-6">
											<label>First Name: </label>
											<input class="form-control" name="fname" required="required"  placeholder="eg: Neema">
										</div>
									 </div>


									<div class="row center-block">
										<div class="form-group col-lg-6">
											<label>Last Name</label>
											<input type="text" class="form-control" required="required"  name="lname" placeholder="eg: Alson">
										</div>
								    </div>
									
									<div class="row center-block">
										<div class="form-group col-lg-6">
											<label>Privilege</label>
											<select class="form-control"  required="required" name="privilege">
													<option> --- Select user role ---</option>
												@foreach($roles as $role)
													<option value="{{ $role->id }}">{{ $role->role_name }}</option>
												@endforeach
											</select>
										</div>
								    </div>


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
		<strong>Sorry!! You have no privillege to Add User</strong> 
	</div>

@endif
@endsection