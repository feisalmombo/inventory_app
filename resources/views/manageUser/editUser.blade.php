@extends('layouts.app')

@section('title', 'Users')

@section('content')

@if(Auth::user()->can('edit_user'))

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
     Edit User Information
  </h1>
 
</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
          <div class="box-header">
              <h3 class="box-title">Edit User</h3><a href="{{ url('/manage-users') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
          </div>
            <!-- /.box-header -->
            <div class="box-body">
			
				<div class="container-fluid">
					<section class="container col-sm-offset-3">
						<div class="container-page">
							<div class="col-sm-6">
								<form role="form" id="sev" action="{{ url('/manage-users/'.$userInfo->id) }}" method="POST" class="form-horizontal">

									{{ csrf_field() }} 
									{{ method_field('PATCH') }}
									
									<div class="col-lg-12 center-block">
										<div class="form-group">
											<label>First Name: </label>
											<input class="form-control" name="fname"  value="{{ isset($userInfo->first_name) ? $userInfo->first_name : old('fname') }}">
										</div>
										<div class="form-group">
											<label>Last Name: </label>
											<input class="form-control" name="lname"  value="{{ isset($userInfo->last_name) ? $userInfo->last_name : old('lname') }}">
										</div>
										<div class="form-group">
											<label>Email: </label>
											<input class="form-control" name="useremail"  value="{{ isset($userInfo->email) ? $userInfo->email : old('useremail') }}">
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


	<!-- <div class="container-page">
	 	<div class="col-sm-6">
			<form role="form"  action="{{-- url('/manage-users/'.$userInfo->id) --}}" method="POST" class="form-horizontal">
				{{--c --srf_field()-- }} 
				{{--m --ethod_field('PATCH') --}}
									
				<div class="col-lg-12 center-block">
					<h2 style="text-align: center;">User Information</h2>
						<div class="form-group">
							<label>First Name: </label>
							<input class="form-control" name="first_name"  value="{{-- isset($userInfo->first_name) ? $userInfo->first_name : old('first_name') }}">
						</div>
						<div class="form-group">
							<label>Last Name: </label>
							<input class="form-control" name="last_name"  value="{{ isset($userInfo->last_name) ? $userInfo->last_name : old('last_name') }}">
						</div>
	
						<div class="form-group">
							<label>Email: </label>
							<input class="form-control" name="email"  value="{{ isset($userInfo->email) ? $userInfo->email : old('email') --}}">
						</div>
												
						<div class="form-group">
							<button type="submit" class="btn btn-primary center-block">
								Update
							</button> 
						</div>
				</div>
			</form>
		</div>
	</div> -->
</section>
@else

	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Sorry!! You have no privillege to Update User</strong> 
	</div>

@endif
@endsection