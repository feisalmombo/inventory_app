@extends('layouts.app')

@section('title', 'Users')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> All Users </h1>

</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="box">
          <div class="box-header">

              <h3 class="box-title">List of system users</h3>
              @if(Auth::user()->can('create_user'))
              <a href="{{ url('/manage-users/create') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-plus"></i>&nbsp;Add User</a>
              @else
			   <a href="{{ url('/manage-users') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
              @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			     @if(count($userData)>0)
						<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S/N</th>
										<th>First Name</th>
										<th>Last Name</th>
			                            <th>Email</th>
			                            <th>Privilege</th>
			                            @if(Auth::user()->can('edit_user'))
			                            <th>Status</th>
			                            @endif
			                            @if(Auth::user()->can('view_user'))
										<th>Show</th>
										@endif
			                            @if(Auth::user()->can('edit_user'))
			                            <th>Edit</th>
										@endif
			                            @if(Auth::user()->can('delete_user'))
										<th>Delete</th>
										@endif
			                            @if(Auth::user()->can('edit_user'))
										<th>Reset</th>
										@endif
									</tr>
								</thead>
								<tbody>

									@foreach($userData as $key=>$user)
									<tr class="odd gradeX">
										<td>{{ $key + 1 }}</td>
										<td>{{ $user->first_name }}</td>
			                            <td>{{ $user->last_name }}</td>
			                            <td>{{ $user->email }}</td>
			                            <td>{{ $user->role_name }}</td>
			                            @if(Auth::user()->can('edit_user'))
			                            <td>
			                            		@if($user->userStatus)
													<button value="{{ $user->id.":".$user->userStatus }}" class="btn btn-success activeUser" id="activeUser{{  $user->id }}">Active</button>
												@else
													<button value="{{ $user->id.":".$user->userStatus }}" class="btn btn-danger inactiveUser" id="inactiveUser{{ $user->id }}">Inactive</button>
			                            		@endif
			                         	</td>
			                         	@endif
			                            @if(Auth::user()->can('view_user'))
			                            <td><a href="{{ url('manage-users/'.$user->id) }}"> <button type="button" class="btn btn-info"><i class="fa fa-eye" arial-hidden="true"></i></button></a></td>
										@endif
			                            @if(Auth::user()->can('edit_user'))
										<td>
										<a href="{{ url('manage-users/'.$user->id.'/edit') }}">   <button type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o" arial-hidden="true"></i></button></a>
										</td>
										@endif
			                            @if(Auth::user()->can('delete_user'))
										 <td>
											 <a class="btn btn-danger" data-toggle="modal" href='#{{ $user->id }}'><i class="fa fa-trash" arial-hidden="true"></i></a>
												<div class="modal fade" id="{{ $user->id }}">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title"><strong>Delete</strong></h4>
															</div>
															<div class="modal-body">
																Are you sure you want to delete user <h9 style="color: blue;">{{ $user->first_name }}</h9>?
															</div>
															<form action="{{ url('/manage-users/'.$user->id) }}" method="POST" role="form">

																{{ csrf_field() }}
																{{ method_field('DELETE') }}

																<div class="modal-footer">
																	<button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>

																	<button type="submit" class="btn btn-primary">Yes</button>
																</div>
															</form>
														</div>
													</div>
												</div>
										</td>
										@endif
										@if(Auth::user()->can('edit_user'))
										<td><a href="{{ url('/manage-users/reset/'.$user->id)}}">
												<span class="fa-passwd-reset fa-stack">
												  <i class="fa fa-undo fa-stack-2x"></i>
												  <i class="fa fa-lock fa-stack-1x"></i>
												</span>
											</a>
										</td>
										@endif
									</tr>
									@endforeach
								</tbody>
							</table>
								<div class="row">
									<div class="pull-left col-lg-8">
										<div class="col-lg-1"></div>
										<div class="col-lg-2">
											<form action="{{url('/manage-users/pdf/downloadPdf')}}" method="POST">
														{{ csrf_field() }}
											<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($userData)); ?>" name="tad">
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

											<form action="{{url('/manage-users/excel/download/xlsx')}}" method="POST">
														{{ csrf_field() }}
											<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($userData)); ?>" name="tadas">
											<div class="col-lg-9">
												<button class="btn btn-success" type="submit" name="submit">
													<span class="fa fa-file-excel-o" aria-hidden="true"> Download Excel</span>
												</button>
											</div>
											</form>

										</div>
									</div>
								</div>
							@else
							<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>No User found</strong>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>

</section>

@endsection
