@extends('layouts.admin')
@section('title', 'Images')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Images</h1>
        <div class="btn-group mr-2">
          @if ($merchant)
          <a href='{{ url("/admin/images/download-all?mId=$merchant") }}' class="btn btn-info">Download All New Images</a>
          @else
            <a href="{{ url('/admin/images/download-all') }}" class="btn btn-info">Download All New Images</a>
          @endif
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          
            @if (count($images)>0)
              <thead>
                <tr>
                  <th>#</th>
                  <th>Product</th>
                  <th>Merchant</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($images as $image)
              <tr>
                <td>{{ $image->id }}</td>
                <td>{{ $image->product_id }}</td>
                <td>{{ $image->merchant_id }}</td>
                <td>
                  <a class="btn btn-sm btn-outline-warning" href="/admin/image/{{ $image->id }}/download"><span data-feather="download"></span></a>
                  <a class="btn btn-sm btn-outline-danger" href=""><span data-feather="trash"></span></a>
                </td>
              </tr>
              @endforeach
            @else
                <h1>No New Images Found</h1>
            @endif
          </tbody>
        </table>
        {{ $images->links() }}
      </div>
     
@endsection