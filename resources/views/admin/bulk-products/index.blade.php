@extends('layouts.admin')
@section('title', 'Bulk products move')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h4">Bulk products move</h1>
        <div class="mr-2">
            
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
                {!! Form::open(['action' => 'Admin\ProductsController@store', 'method' => 'GET']) !!}
                <div class="form-group">
                  {!! Form::label('Select products from:') !!}
                  {!! Form::select('subcat',$categories, null, ['class' => 'form-control']); !!}
                </div>
                {!! Form::close() !!}
              <th>Move to:</th>
            </tr>
          </thead>
          
            @if (count($products)>0)
            <form method="POST" action="/admin/bulk-products">
              {{ csrf_field() }}
              <thead>
                <tr>
                  <th>#</th>
                  <th>Merge to</th>
                  <th>Merge from</th>
                  <th>Title</th>
                  <th>Product Codes</th>
                  <th>Prices</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td><input type="radio" name="main_product" id="{{ $product->id }}" value="{{ $product->id }}"></td>
                <td><input type="checkbox" name="products_to_merge[]" id="{{ $product->id }}" value="{{ $product->id }}"></td>
                <td>{{ str_limit($product->title, 30, '...') }}</td>
                <td>
                  MPN: {{ $product->mpn }}<br/>
                  EAN: {{ $product->ean }}<br/>
                  UPC: {{ $product->upc }}<br/>
                  GTIN: {{ $product->gtin }}<br/>
                  ISBN: {{ $product->isbn }}
                </td>
                <td>
                  Min: £{{ $product->min_price }}<br/>
                  Max: £{{ $product->max_price }}
                </td>
                <td>

                </td>
              </tr>
              @endforeach
              <td>
                  <button type="submit" class="btn btn-sm btn-outline-warning" ><span data-feather="zap"></span>Merge </button>    
              </td>
                  
              </form>
            @else
                <p>Select category to choose products to move</p>
            @endif
          </tbody>
        </table>
      </div>
      <script>
        $('.delete-user').click(function(e){
            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('Are you sure?')) {
                // Post the form
                $(e.target).closest('form').submit() // Post the surrounding form
            }
        });
    </script>
@endsection