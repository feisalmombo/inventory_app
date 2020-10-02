@extends('layouts.app')

@section('title', 'Request')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">

    <h1> Single Product Requested </h1>

</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="box">
          <div class="box-header">
              <h3 class="box-title">List of Requested Products</h3><a href="{{ url('/manage-request/create') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-plus"></i>&nbsp;Request Product</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			     @if(count($requestData)>0)
						<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Product Name</th>
										<th>Product Model</th>
										<th>Product Quantity</th>
										<th>Bank</th>
										<th>Business Status</th>
										<th>Request By</th>
										<th>Confirm</th>
									</tr>
								</thead>
								<tbody>

									@foreach($requestData as $key=>$req)
									<tr class="odd gradeX">
										<td>{{ $key + 1 }}</td>
										<td>{{ $req->product_name }}</td>
										<td>{{ $req->product_model }}</td>
										<td>{{ $req->pro_quantity }}</td>
										<td>{{ $req->bank_name }}</td>
			                            <td>{{ $req->pro_status_name }}</td>
			                            <td>{{ $req->first_name." ".$req->last_name }}</td>
			                            <td>
											 <a class="btn btn-success" data-toggle="modal" href='#{{ $req->id }}'><i class="fa fa-check" arial-hidden="true"></i></a>
												<div class="modal fade" id="{{ $req->id }}">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title"><strong>Confirmation</strong></h4>
															</div>
															<div class="modal-body">
																Are you sure you want to confirm <h9 style="color: blue;">{{ $req->product_name }}</h9>?
															</div>
															<form action="{{ url('manage-request/'.$req->id) }}" method="POST" role="form">

																{{ csrf_field() }}
																{{ method_field('PATCH') }}


																<input type="text" hidden="hidden" value="{{ $req->id }}">

																<div class="modal-footer">
																	<button type="submit" class="btn btn-primary">Yes</button>
																	<button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>

																</div>
															</form>
														</div>
													</div>
												</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							@else
							<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>No Request found</strong>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>

</section>

@endsection
