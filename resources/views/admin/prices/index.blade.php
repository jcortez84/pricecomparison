@extends('layouts.admin')
@section('title', 'Prices')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Prices</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="mr-2">
            <a href='{{ url("/admin/prices-csv?mId=$mId") }}' class="btn btn-primary">Import prices from CSV</a>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        
            @if (count($prices) > 0)
            <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>MerchantId</th>
                    <th>ProductId</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
              @foreach ($prices as $price)
                <tr>
                  <td>{{ $price->id }}</td>
                  <td>{{ $price->merchant_id }}</td>
                  <td>{{ $price->prod_id }}</td>
                  
                  <td>
                    <a class="btn btn-sm btn-outline-info" href="/admin/prices/{{ $price->id }}/edit"><span data-feather="edit"></span></a>
                    <a class="btn btn-sm btn-outline-danger" href=""><span data-feather="trash"></span></a>
                  </td>
                </tr>
              @endforeach  
            </tbody>
          </table>
            @else
                <h1>There are no prices added yet.</h1>
            @endif
      

        {{ $prices->links() }}
      </div>
     
@endsection