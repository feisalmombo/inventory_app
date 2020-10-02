@extends('layouts.app')

@section('title', 'Store')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> All Stores </h1>
 
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
          <div class="box-header">
              <h3 class="box-title">List of Stores</h3>
			  @if(Auth::user()->can('create_store'))
              <a href="{{ url('/product-store/create') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-plus"></i>&nbsp;Add Store</a>
              @else
			  <a href="{{ url('/product-store') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
              @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			     @if(count($storesData)>0)
						<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Store Name</th>
										<th>Created Date</th>
										@if(Auth::user()->can('view_store'))
										<th>Show</th>
										@endif
										@if(Auth::user()->can('edit_store'))
			                            <th>Edit</th>
			                            @endif
										@if(Auth::user()->can('delete_store'))
										<th>Delete</th>
										@endif
									</tr>
								</thead>
								<tbody>

									@foreach($storesData as $key=>$store)
									<tr class="odd gradeX">
										<td>{{ $key + 1 }}</td>
			                            <td>{{ $store->store_name }}</td>
			                            <td>{{ $store->created_at  }}</td>
			                            @if(Auth::user()->can('view_store'))
			                            <td><a href="{{ url('product-store/'.$store->id) }}"> <button type="button" class="btn btn-info"><i class="fa fa-eye" arial-hidden="true"></i></button></a></td>
			                            @endif
										@if(Auth::user()->can('edit_store'))
										<td>
										<a href="{{ url('product-store/'.$store->id.'/edit') }}">   <button type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o" arial-hidden="true"></i></button></a>
										</td>
										@endif
										@if(Auth::user()->can('delete_store'))
										 <td>
											 <a class="btn btn-danger" data-toggle="modal" href='#{{ $store->id }}'><i class="fa fa-trash" arial-hidden="true"></i></a>
												<div class="modal fade" id="{{ $store->id }}">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title"><strong>Delete</strong></h4>
															</div>
															<div class="modal-body">
																Are you sure you want to delete <h9 style="color: blue;">{{ $store->store_name }}</h9> store?
															</div>
															<form action="{{ url('/product-store/'.$store->id) }}" method="POST" role="form">

																{{ csrf_field() }}
																{{ method_field('DELETE') }}

																<div class="modal-footer">
																	<button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>

																	<button type="submit" class="btn btn-danger">Yes</button>
																</div>
															</form>
														</div>
													</div>
												</div>
										</td>
										@endif
									</tr>
									@endforeach
								</tbody>
							</table>
								<div class="row">
					<div class="pull-left col-lg-8">
						<div class="col-lg-2">
							<form action="{{url('/product-store/pdf/downloadPdf')}}" method="POST"> 
										{{ csrf_field() }}
							<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($storesData)); ?>" name="tad">
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

							<form action="{{ url('/product-store/excel/download/xlsx') }}" method="POST"> 
										{{ csrf_field() }}
							<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($storesData)); ?>" name="tadas">
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
								<strong>No Store found</strong> 
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>

</section>

@endsection
