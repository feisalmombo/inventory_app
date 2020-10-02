@extends('layouts.app')

@section('title', 'Confirmation')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">

    <h1> All Confirmed Product Requests </h1>

</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="col-lg-12">
		<div class="box">
          <div class="box-header">
              <h3 class="box-title">List of Confirmed Product Requests </h3><a href="{{ url('/manage-request') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			     @if(count($confirmedData)>0)
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
									</tr>
								</thead>
								<tbody>

									@foreach($confirmedData as $key=>$req)
									<tr class="odd gradeX">
										<td>{{ $key + 1 }}</td>
										<td>{{ $req->product_name }}</td>
										<td>{{ $req->product_model }}</td>
										<td>{{ $req->pro_quantity }}</td>
										<td>{{ $req->bank_name }}</td>
			                            <td>{{ $req->pro_status_name }}</td>
			                            <td>{{ $req->first_name." ".$req->last_name }}</td>
			                        </tr>
									@endforeach
								</tbody>
							</table>
							<div class="row">
          <div class="pull-left col-lg-8">
            <div class="col-lg-2">
              <form action="{{url('/manage-request/confirmed-requests/pdf/downloadPdf')}}" method="POST">
                    {{ csrf_field() }}
              <input type="text" hidden="hidden" value="<?php print base64_encode(serialize($confirmedData)); ?>" name="tad">
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

              <form action="{{ url('/manage-request/confirmed-requests/excel/download/xlsx') }}" method="POST">
                    {{ csrf_field() }}
              <input type="text" hidden="hidden" value="<?php print base64_encode(serialize($confirmedData)); ?>" name="tadas">
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
								<strong>No Confirmed Request found</strong>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>

</section>

@endsection
