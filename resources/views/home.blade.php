@extends('layouts.app')

@section('content')
<div class="content-wrapper col-md-6 offset-2">
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
          @if(Session::has('alert-' . $msg))
          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
          @endif
        @endforeach
      </div> 
       @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
  <div class="card">
    <div class="card-body">
    <div class="row">
        <div class="col-md-10">
            <h4 class="card-title">Product List</h4>
        </div>
      <div class="col-md-2">
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addModule" style="margin-bottom: 13px;">
                Add
            </button>
        </div>
    </div>
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table id="order-listing" class="table">
              <thead>
                <tr>
                    <th>S.N</th>
                    <th>Product Name</th>
                </tr>
              </thead>
              <tbody>
                 @foreach($products as $key=>$product)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>@if(!empty($product->product_name)) {{$product->product_name}} @endif</td>
                </tr>
                 @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addModule">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Product</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form role="form" action="{{route('user.product')}}" method="post">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Product Name</label>
                <input type="text" name="product_name" class="form-control" placeholder="Product Name">
              </div>
            </div>
             <div class="modal-footer justify-content-between">
              <button type="submit" class="btn btn-primary" style="padding: 13px 26px;">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
