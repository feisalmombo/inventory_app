@extends('layouts.app')

@section('title', 'Roles')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> User Role 
    	@if(Auth::user()->can('create_user') && Auth::user()->can('edit_user'))
		<a href="{{ url('/manage-roles/all-roles') }}" class=" btn btn-primary pull-right" style="text-decoration: none;">&nbsp;All Roles</a></h1>

		@endif
    </h1>
 
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
			   @if(count($roles)>0)
		          	<div class="box-header">
		              <h3 class="box-title">List of Users with Role</h3>
		              <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
		            </div>
		            <!-- /.box-header -->
			            <div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Full Name</th>
										<th>Role</th>
									</tr>
								</thead>
								<tbody>
									@foreach($roles as $key=>$role)
										<tr class="odd gradeX">
											<td>{{ $key + 1 }}</td>
											<td>{{ $role->first_name." ".$role->last_name }}</td>
				                            <td>{{ $role->role_name }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
								<div class="row">
					<div class="pull-left col-lg-8">
						<div class="col-lg-2">
							<form action="{{url('/manage-roles/pdfRoles/downloadPdf')}}" method="POST"> 
										{{ csrf_field() }}
							<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($roles )); ?>" name="tad">
							<div class="col-lg-9">
								<button class="btn btn-info" type="submit" name="submit">
									<span class="fa fa-file-pdf-o" aria-hidden="true"> Download PDF</span>
								</button>
							</div>
							</form>
							 -->
						</div>	
						<div class="col-lg-1"></div>
						<div class="col-lg-2">

							<form action="{{ url('/manage-roles/excel/download/xlsx') }}" method="POST"> 
										{{ csrf_field() }}
							<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($roles )); ?>" name="tadas">
							<div class="col-lg-9">
								<button class="btn btn-success" type="submit" name="submit">
									<span class="fa fa-file-excel-o" aria-hidden="true"> Download Excel</span>
								</button>
							</div>
							</form>
							
						</div>
					</div>
				</div>
						
						</div>

				@else
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>No User found with specific Role</strong> 
					</div>
				@endif
		</div>
	</div>
	</div>
</section>

@endsection
