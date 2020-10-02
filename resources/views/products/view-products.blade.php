@extends('layouts.app')

@section('title', 'Products')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> All Products </h1 
</section>

<!-- Main content -->
<section class="content">
     @include('msgs.success')
     <div class="box">
            <div class="box-header">
              <h3 class="box-title">Available Products in store</h3>
              @if(Auth::user()->can('create_product'))
               <a href="{{ url('/manage-products/create') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-plus"></i>&nbsp;Add Product</a>
              @else
              <a href="{{ url('/manage-products') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
              @endif
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if(count($productsInfo)>0)
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S/N</th>
                  <th>Product Name</th>
                  <th>Product Model</th>
                  <th>Category</th>
                  <th>Store</th>
                  <th>Quantity</th>
                  <th>Condition</th>
                  <th>Product Status</th>
                  <th>Show</th>
                  <th>Archieve</th>
                  @if(Auth::user()->can('edit_product'))
                  <th>Edit</th>
                  @endif
                  @if(Auth::user()->can('delete_product'))
                  <th>Delete</th>
                  @endif
                </tr>
                </thead>
                <tbody>
                @foreach($productsInfo as $key=>$product)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->product_model }}</td>
                  <td>{{ $product->category_name }}</td>
                  <td> {{ $product->store_name }}</td>
                  <td> {{ $product->quantity }}</td>
                  <td> {{ $product->condition_name }}</td>
                  <td>{{ $product->pro_status_name }}</td>
                  <td><a href="{{ url('manage-products/'.$product->id) }}"> <button type="button" class="btn btn-info"><i class="fa fa-eye" arial-hidden="true"></i></button></a>
                  </td>
                  <td><a href="{{ url('manage-products/product-history/'.$product->id) }}"> <button type="button" class="btn btn-warning"><i class="fa fa-history" arial-hidden="true"></i></button></a>
                  </td>
                  @if(Auth::user()->can('edit_product'))
                  <td>
                    <a href="{{ url('manage-products/'.$product->id.'/edit') }}">   <button type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o" arial-hidden="true"></i></button></a>
                  </td>
                  @endif
                  @if(Auth::user()->can('delete_product'))
                    <td>
                       <a class="btn btn-danger" data-toggle="modal" href='#{{ $product->id }}'><i class="fa fa-trash" arial-hidden="true"></i></a>
                        <div class="modal fade" id="{{ $product->id }}">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title"><strong>Delete</strong></h4>
                              </div>
                              <div class="modal-body">
                                Are you sure you want to delete <h9 style="color: blue;">{{ $product->product_name }}</h9>?
                              </div>
                              <form action="{{ url('/manage-products/'.$product->id) }}" method="POST" role="form">

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
              <form action="{{url('/manage-products/pdf/downloadPdf')}}" method="POST"> 
                    {{ csrf_field() }}
              <input type="text" hidden="hidden" value="<?php print base64_encode(serialize($productsInfo)); ?>" name="tad">
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

              <form action="{{ url('/manage-products/excel/download/xlsx') }}" method="POST"> 
                    {{ csrf_field() }}
              <input type="text" hidden="hidden" value="<?php print base64_encode(serialize($productsInfo)); ?>" name="tadas">
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
                  <strong>No Product found</strong> 
                </div>
              @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
</section>

@endsection
