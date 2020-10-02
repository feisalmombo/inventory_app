@extends('layouts.app')

@section('title', 'View Prices')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1> All Products Price</h1 
  </section>

  <!-- Main content -->
  <section class="content">
   @include('msgs.success')
   <div class="box">
    <div class="box-header">
      <h3 class="box-title">Available Products Price in store</h3><a href="{{ url('/manage-prices/create') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-plus"></i>&nbsp;Add Price</a>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      @if(count($priceData)>0)
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Product Name</th>
            <th>Buying Price</th>
            <th>Minimum Selling Price</th>
            <th>Show</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach($priceData as $key=>$price)
          <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $price->product_name }}</td>
            <td>{{ $price->buying_price }}</td>
            <td>{{ $price->min_selling_price}}</td>
            <td><a href="{{ url('manage-prices/'.$price->id) }}"> <button type="button" class="btn btn-info"><i class="fa fa-eye" arial-hidden="true"></i></button></a>
            </td>
            <td>
              <a href="{{ url('manage-prices/'.$price->id.'/edit') }}">   <button type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o" arial-hidden="true"></i></button></a>
            </td>
            <td>
             <a class="btn btn-danger" data-toggle="modal" href='#{{ $price->id }}'><i class="fa fa-trash" arial-hidden="true"></i></a>
             <div class="modal fade" id="{{ $price->id }}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><strong>Delete</strong></h4>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to delete {{ $price->product_name }} Price with buying price: <h9 style="color: blue;">{{ $price->buying_price }}</h9>?
                  </div>
                  <form action="{{ url('/manage-prices/'.$price->id) }}" method="POST" role="form">

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
              <form action="{{url('/manage-prices/pdf/downloadPdf')}}" method="POST"> 
                    {{ csrf_field() }}
              <input type="text" hidden="hidden" value="<?php print base64_encode(serialize($priceData)); ?>" name="tad">
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

              <form action="{{ url('/manage-prices/excel/download/xlsx') }}" method="POST"> 
                    {{ csrf_field() }}
              <input type="text" hidden="hidden" value="<?php print base64_encode(serialize($priceData)); ?>" name="tadas">
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
      <strong>No Product Price found</strong> 
    </div>
    @endif
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
</div>
</section>

@endsection
