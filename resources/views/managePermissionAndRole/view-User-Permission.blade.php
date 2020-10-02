@extends('layouts.app')

@section('title', 'Permissions')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> User Permissions 
 	
 	@if(Auth::user()->can('create_user') && Auth::user()->can('edit_user'))
		<a href="{{ url('/manage-permissions/all-permissions') }}" class="btn btn-primary pull-right" style="text-decoration: none;">&nbsp;All Permissions</a>
	@endif
 	</h1>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box" > {{-- //id="liveData" --}} 
			
			   @if(count($permissions)>0)
		          	<div class="box-header">
		              <h3 class="box-title">List of Users with Permissions</h3>
		              <a href="{{ url('/home') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
		            </div>
		            <!-- /.box-header -->
			            <div class="box-body">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Full Name</th>
										<th>Permission</th>
									</tr>
								</thead>
								<tbody>
									@foreach($permissions as $key=>$permission)
										<tr class="odd gradeX">
											<td>{{ $key + 1 }}</td>
											<td>{{ $permission->first_name." ".$permission->last_name }}</td>
				                            <td>
												<ul id="getpermission">
														@if(count($permissions[$key]->permissions)>0)
															@foreach($permissions[$key]->permissions as $permit)
																	<li>{{ $permit->permission_name }}</li>
															@endforeach
														@else
																<li>Has no permission</li>
														@endif
												</ul>
				                            </td>
										</tr>
									@endforeach
								</tbody>
							</table>
						<div class="row">
					<div class="pull-left col-lg-8">
						<div class="col-lg-2">
							<form action="#" method="POST"> 
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

							<form action="{{ url('/manage-permissions/excel/download/xlsx') }}" method="POST"> 
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
						
						</div>
				@else
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>No User found with specific Permission</strong> 
					</div>
				@endif
		</div>
	</div>
	</div>
</section>



<script>
 //    $(document).ready(function(){
 //    	 function index_data(){
 //        console.log('Done');
 //       }
 //       index_data();
	// });
    </script> 
@endsection
