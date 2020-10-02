@extends('layouts.app')

@section('title', 'Permissions')

@section('content')
@if(Auth::user()->can('create_user') && Auth::user()->can('edit_user'))

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> System Permisssions </h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
			   @if(count($permissions)>0)
		          	<div class="box-header">
		              <h3 class="box-title">List of All Permissions</h3>
		              <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
		            </div>
		            <!-- /.box-header -->
			            <div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Permission</th>
									</tr>
								</thead>
								<tbody>
									@foreach($permissions as $key=>$permission)
										<tr class="odd gradeX">
											<td>{{ $key + 1 }}</td>
				                            <td>{{ $permission->permission_name }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
							<div class="row">
					<div class="pull-left col-lg-8">
						<div class="col-lg-2">
							<form action="{{url('/manage-permissions/all-permissions/pdf/downloadPdf')}}" method="POST"> 
										{{ csrf_field() }}
							<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($permissions )); ?>" name="tad">
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

							<form action="{{ url('/manage-permissions/all-permissions/excel/download-AllRoles/xlsx') }}" method="POST"> 
										{{ csrf_field() }}
							<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($permissions )); ?>" name="tadas">
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
						<strong>No Permission found </strong> 
					</div>
				@endif
		</div>
	</div>
	</div>
</section>
@else
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Sorry!! You have no privillege</strong> 
	</div>

@endif
@endsection