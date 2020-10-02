@extends('layouts.app')

@section('title', 'Permissions')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> Assign Permisssions to Role</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
          	<div class="box-header">
              <h3 class="box-title">Role Permissions</h3>
              <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
				<form role="form"  action="{{ url('/manage-permissions/role-permissions-save') }}" method="POST">
					{{ csrf_field() }} 
					<div class="col-lg-12 center-block">
						<div class="row">
                        
						<div class="form-group  col-lg-4">
							
						<h4>Select Role</h4>
	                        <select name="roles" id="role" class="form-control text-center" >
								<option value="">---Select Role to Entrust---</option>
			                        @foreach($roles as $role)
			                            <option value="{{$role->id}}">{{$role->role_name}}</option>
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