@extends('layouts.admin')
@section('title', 'Merchants')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Merchants</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="mr-2">
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
                  <td>{{ $merchant->mId }}</td>
                  <td><img style="height:20px" src='{!!"/storage/merchants/$merchant->mId/$merchant->logo"!!}' alt="{!! $merchant->logo !!}">&nbsp;{{ $merchant->name }}</td>
                  <td>{{ $merchant->slug }}</td>
                  <td>{{ $merchant->email }}</td>
                  
                  <td>
                    <a class="btn btn-sm btn-outline-info" href="/admin/merchants/{{ $merchant->mId }}/edit"><span data-feather="edit"></span></a>
                    <a class="btn btn-sm btn-outline-warning" href="/admin/datafeeds?mId={{$merchant->mId}}"><span data-feather="zap"></a></span>
                    <a class="btn btn-sm btn-outline-success" href="/admin/prices?mId={{$merchant->mId}}"><span data-feather="dollar-sign"></span></a>
                    <a class="btn btn-sm btn-outline-dark" href="/admin/clicks?mId={{$merchant->mId}}"><span data-feather="activity"></span></a>
                    <a class="btn btn-sm btn-outline-danger" href=""><span data-feather="trash"></span></a>
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