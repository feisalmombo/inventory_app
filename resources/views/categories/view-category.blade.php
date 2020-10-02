@extends('layouts.app')

@section('title', 'Categoties')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> All Categories </h1>
 
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="col-lg-12"> 
		@include('msgs.success')
		<div class="box">
          <div class="box-header">
              <h3 class="box-title">List of Categories</h3><a href="{{ url('/product-categories/create') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-plus"></i>&nbsp;Add Category</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			     @if(count($categoriesData)>0)
						<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S/N</th>
										<th>Category Name</th>
										<th>Store Name</th>
										<th>Show</th>
			                            <th>Edit</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody>

									@foreach($categoriesData as $key=>$category)
									<tr class="odd gradeX">
										<td>{{ $key + 1 }}</td>
										<td>{{ $category->category_name }}</td>
			                            <td>{{ $category->store_name }}</td>
			                            <td><a href="{{ url('product-categories/'.$category->id) }}"> <button type="button" class="btn btn-info"><i class="fa fa-eye" arial-hidden="true"></i></button></a>
			                            </td>
										<td>
										<a href="{{ url('product-categories/'.$category->id.'/edit') }}">   <button type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o" arial-hidden="true"></i></button></a>
										</td>
										 <td>
											 <a class="btn btn-danger" data-toggle="modal" href='#{{ $category->id }}'><i class="fa fa-trash" arial-hidden="true"></i></a>
												<div class="modal fade" id="{{ $category->id }}">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title"><strong>Delete</strong></h4>
															</div>
															<div class="modal-body">
																Are you sure you want to delete category <h9 style="color: blue;">{{ $category->category_name }}</h9> ?
															</div>
															<form action="{{ url('/product-categories/'.$category->id) }}" method="POST" role="form">

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
									</tr>
									@endforeach
								</tbody>
							</table>
												<div class="row">
					<div class="pull-left col-lg-8">
						<div class="col-lg-2">
							<form action="{{url('/product-categories/pdf/downloadPdf')}}" method="POST"> 
										{{ csrf_field() }}
							<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($categoriesData)); ?>" name="tad">
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

							<form action="{{ url('/product-categories/excel/download/xlsx') }}" method="POST"> 
										{{ csrf_field() }}
							<input type="text" hidden="hidden" value="<?php print base64_encode(serialize($categoriesData)); ?>" name="tadas">
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
								<strong>No Category found</strong> 
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>

</section>

@endsection
