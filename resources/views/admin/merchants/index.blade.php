@extends('layouts.admin')
@section('title', 'Merchants')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-1 pb-2 mb-1 border-bottom">
  <h1 class="h6">Merchants</h1>
  <div class="btn-toolbar mb-1 mb-md-0">
    <div class="mr-2">
      <a href="{{ url('/admin/products-ssh-all') }}" class="btn btn-success">Add new products by SSH</a>
      <a href="{{ url('/admin/prices-ssh-all') }}" class="btn btn-warning">Update prices by SSH</a>
      <a href="{{ url('/admin/merchants/create') }}" class="btn btn-info">Add a merchant</a>
      <a href="{{ url('/admin/merchants-csv') }}" class="btn btn-primary">Import merchants from CSV</a>
    </div>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @if (count($merchants) > 0)
      @foreach ($merchants as $merchant)
      <tr>
        <td>{{ $merchant->id }}</td>
        <td><img style="height:40px" src='{{asset("$merchant->logo")}}'>&nbsp;{{ $merchant->name }}</td>
        <td>{{ $merchant->slug }}</td>
        <td>{{ $merchant->email }}</td>

        <td>
          <a class="btn btn-sm btn-outline-info" href="/admin/merchants/{{ $merchant->id }}/edit"><span
              data-feather="edit"></span></a>
          <a class="btn btn-sm btn-outline-warning" href="/admin/datafeeds?mId={{$merchant->id}}"><span
              data-feather="zap"></a></span>
          <a class="btn btn-sm btn-outline-primary" href="/admin/products-ssh/{{$merchant->id}}/run"><span
              data-feather="shopping-cart"></a></span>
          <a class="btn btn-sm btn-outline-success" href="/admin/prices-ssh/{{$merchant->id}}/run"><span
              data-feather="dollar-sign"></span></a>
          <a class="btn btn-sm btn-outline-dark" href="/admin/clicks?mId={{$merchant->id}}"><span
              data-feather="activity"></span></a>
        </td>
        <td>
          <form method="POST" action="/admin/merchants/{{ $merchant->id }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-outline-danger"><span data-feather="trash"></span></button>
          </form>
        </td>
      </tr>
      @endforeach
      @else
      <h1>There are no merchants listed yet.</h1>
      @endif
    </tbody>
  </table>

  {{ $merchants->links() }}
</div>

@endsection