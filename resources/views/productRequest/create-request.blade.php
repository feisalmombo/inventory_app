@extends('layouts.app')

@section('title', 'Add Request')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Product Request Information </h1>
</section>

<!-- Main content -->
<section class="content col-sm-offset-3">
	<div class="row">
		<div class="col-lg-12">
			@include('msgs.success')
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Add Request</h3><a href="{{ url('/manage-request') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">

					<div class="container-fluid">
						<section class="container">
							<div class="col-lg-12 ">
								<form role="form"  action="{{ url('/manage-request') }}" method="POST">
									{{ csrf_field() }}

									<div class="center-block">
										<div class="form-group col-lg-4">
											<label>Product Request: </label>
											<select class="form-control"  required="required" name="product_id">
												<option> --- Select Product ---</option>
												@foreach($productData as $product)
												<option value="{{ $product->id }}">{{ $product->product_name }}: {{ $product->product_model }}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="row center-block">
										<div class="form-group col-lg-2">
											<label>Quantity Request:</label>
											<input type="number"  class="form-control" name="quantity" placeholder="eg: 10">
										</div>
									</div>

									<br>

									<div class=" center-block">
										<div class="form-group col-lg-4">
											<label>Product Status for: </label>
											<div class="radio">
												<label>
													<input type="radio" name="statusRadios" id="saleRadio" value="sold">
													Sale
												</label>
											</div>

											<div class="radio">
												<label>
													<input type="radio" name="statusRadios" id="leaseRadio" value="leased">
													Lease
												</label>
											</div>
										</div>
									</div>

									<div class="row center-block">
										<div class="form-group col-lg-4">
											<label>Bank Name: </label>
											<select class="form-control"  required="required" name="bank_id">
												<option> --- Select Product ---</option>
												@foreach($bank as $banks)
												<option value="{{ $banks->id }}">{{ $banks->bank_name }}</option>
												@endforeach
											</select>
										</div>
									</div>

									<div class="row">
										<div class="form-group col-lg-7">
											<button type="submit" class="btn btn-primary center-block">
												Submit Request
											</button>
										</div>
									</div>

								</form>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
