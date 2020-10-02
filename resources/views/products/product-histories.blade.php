@extends('layouts.app')

@section('title', 'Products')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>{{ $productHistory[0]->product_name }} History </h1 
</section>

<!-- Main content -->
<section class="content">
     <div class="box">
            <div class="box-header">
              <h3 class="box-title"><strong>Products</strong>: {{ $productHistory[0]->product_name.' - '.$productHistory[0]->product_model }} with {{ ' '.$productHistory[0]->currentQuantity.' ' }}in number</h3>
              
              <a href="{{ url('/manage-products') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if(count($productHistory)>0)
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S/N</th>
                  <th>Product Quantity</th>
                  <th>Update Time</th>
                </tr>
                </thead>
                <tbody>
                @foreach($productHistory as $key=>$product)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $product->prev_quantity }}</td>
                  <td>{{ $product->oldCreated }}</td>
                  @endforeach
              </tbody>
              </table>
            
              @else
                <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>No Product History found</strong> 
                </div>
              @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
</section>

@endsection
