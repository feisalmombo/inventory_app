<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Comfirm Request Report</title>
	<style type="text/css" media="screen">
	table{
		border: 1px solid;
		border-collapse: collapse;
		width: 100%;
		margin: 0 auto;
		text-align: left;
	}
	tr th{
		background: #eee;
		border: 1px solid;
		padding-left: 10px;

	}
	tr td{
		border: 1px solid;
		padding-left: 10px;
	}
	caption{
		text-align: center;
	}
</style>
</head>
<body>
	<div style="text-align: center;">
		<img class="img-responsive"  src="../public/temp/images/logo.png" alt="sorry" width="200" >

		<p style="text-align: center;"><b>UMOJASWITCH COMPANY LIMITED</b></p>

		<div class="text-center" style="text-align: center">
			<caption>CONFIRMED REQUEST PRODUCT REPORT</caption>
		</div>
	</div>
	<br>
	<div class="panel-body">
		<table class="table table-bordered table-hover">


			<thead>
				<tr>
					<th>S/N</th>
					<th>Product Name</th>
					<th>Product Model</th>
					<th>Bank</th>
					<th>Business Status</th>
					<th>Request By</th>
				</thead>
				<tbody>
					@foreach($confirmedData as $key=>$req)
					<tr>
						<td>{{ $key + 1 }}</td>
						<td>{{ $req->product_name }}</td>
						<td>{{ $req->product_model }}</td>
						<td>{{ $req->bank_name }}</td>
						<td>{{ $req->pro_status_name }}</td>
						<td>{{ $req->first_name." ".$req->last_name }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</body>
	</html>
