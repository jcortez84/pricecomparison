@extends('layouts.admin')
@section('title', 'Datafeeds')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products</h1>
        <div class="mr-2">
            
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          
            @if (count($products)>0)
            <form method="POST" action="/admin/merge-products">
              {{ csrf_field() }}
              <thead>
                <tr>
                  <th>#</th>
                  <th>Merge to</th>
                  <th>Merge from</th>
                  <th>Title</th>
                  <th>Product Codes</th>
                  <th>Prices</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($products as $product)
              <tr>
                <td>{{ $product->id }}</td>
                <td><input type="radio" name="main_product" id="{{ $product->id }}" value="{{ $product->id }}"></td>
                <td><input type="checkbox" name="products_to_merge[]" id="{{ $product->id }}" value="{{ $product->id }}"></td>
                <td>{{ $product->title }}</td>
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
                <h1>No Products Yet</h1>
            @endif
          </tbody>
        </table>
        {{ $products->links() }}
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