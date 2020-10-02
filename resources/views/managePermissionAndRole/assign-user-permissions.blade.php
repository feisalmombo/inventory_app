@extends('layouts.app')

@section('title', 'Permissions')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Assign Permisssions to User</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
          	<div class="box-header">
              <h3 class="box-title">User Permissions</h3>
              <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<form role="form"  action="{{ url('/manage-permissions/user-permissions-save') }}" method="POST">
					{{ csrf_field() }} 
					<div class="center-block"> 
					<div class="row">                       
						<div class="form-group col-lg-4">
							<h4>Select User</h4>	
	                        <select name="users" id="user" class="form-control text-center" >
								<option value=""> ---Select User to Entrust--- </option>
			                        @foreach($users as $user)
			                            <option id="" value="{{$user->id}}">{{$user->first_name}}&nbsp;{{$user->last_name}}</option>
			                        @endforeach
	                         </select>
						</div>
						

						<div class="form-group col-lg-8">
	                        <div class="form-group" id="permission">
								
							</div>
						</div>
					</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary center-block">
								Save
							</button> 
						</div>
					</div>
				</form>
            </div>
		</div>
	</div>
	</div>
</section>
@endsection