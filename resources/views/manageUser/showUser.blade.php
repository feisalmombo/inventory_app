@extends('layouts.app')

@section('title', 'Users')

@section('content')
@if(Auth::user()->can('view_user'))
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
     User Information
  </h1>

</section>

<!-- Main content -->
<section class="content">
<div class="row">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="box">
          <div class="box-header">
              <h3 class="box-title">Show User</h3><a href="{{ url('/manage-users') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
          </div>
            <!-- /.box-header -->
            <div class="box-body">

				<div class="container-fluid">
					<section class="container col-sm-offset-3">
						<div class="container-page">
							<div class="col-sm-6">
								@foreach($userInfo as $user)
								<form role="form" id="sev" action="{{ url('/manage-users/'.$user->id) }}" method="POST" class="form-horizontal">

									{{ csrf_field() }}
									{{ method_field('PATCH') }}

								<div class="modal-body">
											<div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>First Name: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $user->first_name }}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											  <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Last Name: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $user->last_name }}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											  <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Email: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $user->email }}
													</div>
												</div>
											    </div>
											  </div>
											  <br>
											  	  <div class="row">
											    <div class="col-sm-3">
											     <div class="center-block">
													<div class="form-group">
														<label>Privilege: </label>
													</div>
												</div>
											    </div>
											    <div class="col-sm-9">
											       <div class="center-block">
													<div class="form-group">
														{{ $user->role_name }}
													</div>
												</div>
											    </div>

											  </div>
											  @endforeach
								  </div>
								</form>
							</div>
						</div>
						<div class="row">
									<div class="pull-right col-lg-8">

										<div class="col-lg-2">
											<form action="{{url('/manage-users/pdf/downloadPdf')}}" method="POST">
														{{ csrf_field() }}
											<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($userInfo )); ?>" name="tad">
											<div class="col-lg-9">
												<button class="btn btn-info" type="submit" name="submit">
													<span class="fa fa-file-pdf-o" aria-hidden="true"> Download PDF</span>
												</button>
											</div>
											</form>

										</div>
									   <div class="col-lg-1"></div>
										<div class="col-lg-2">

											<form action="{{url('/manage-users/excel/download/xlsx')}}" method="POST">
														{{ csrf_field() }}
											<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($userInfo )); ?>" name="tadas">
											<div class="col-lg-9">
												<button class="btn btn-success" type="submit" name="submit">
													<span class="fa fa-file-excel-o" aria-hidden="true"> Download Excel</span>
												</button>
											</div>
											</form>

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
		<strong>Sorry!! You have no privillege to View more details about User</strong>
	</div>
@endif
@endsection
