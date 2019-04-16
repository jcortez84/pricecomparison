@extends('layouts.admin')
@section('title', 'Datafeeds')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products</h1>
        <div class="mr-2">
            
            <a href="{{ url('/admin/products/delete-without-prices') }}" class="btn btn-danger">Delete products without a price</a>
            <a href="{{ url('/admin/set_all_prices') }}" class="btn btn-warning">Profile all prices</a>
            <a href="{{ url('/admin/products/create') }}" class="btn btn-info">Add a product</a>
            <a href="{{ url('/admin/products-csv') }}" class="btn btn-primary">Import products from CSV</a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          
            @if (count($products)>0)
              <thead>
                <tr>
                  <th>#</th>
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
                  <a class="btn btn-sm btn-outline-warning" href="/admin/products/{{ $product->id }}/edit"><span data-feather="edit"></span></a>
                  <a class="btn btn-sm btn-outline-info" href="/admin/image/{{ App\ProductImageLink::where('product_id',$product->id)->value('id') }}/download"><span data-feather="download"></a></span>
                  <a class="btn btn-sm btn-outline-success" href="/admin/set_prices/{{$product->id}}"><span data-feather="dollar-sign"></span></a>
                  <a class="btn btn-sm btn-outline-dark" href=""><span data-feather="activity"></span></a>
                  
                  
                    <form method="POST" action="/admin/products/{{$product->id}}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                
                       
                            <button type="submit" class="btn btn-sm btn-outline-danger" ><span data-feather="trash"></span></button>
                       
                    </form>
                
                </td>
              </tr>
              @endforeach
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