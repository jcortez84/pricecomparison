@extends('layouts.admin')
@section('title', 'Pages')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pages</h1>
        <div class="btn-group mr-2">
            <a href="{{ url('/admin/pages/create') }}" class="btn btn-info">Add a page</a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          
            @if (count($pages)>0)
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($pages as $page)
              <tr>
                <td>{{ $page->id }}</td>
                <td>{{ $page->title }}</td>
                <td>{{ $page->slug }}</td>
                <td>
                  <a class="btn btn-sm btn-outline-warning" href="/admin/pages/{{ $page->id }}/edit"><span data-feather="edit"></span></a>
                  <a class="btn btn-sm btn-outline-danger" href=""><span data-feather="trash"></span></a>
                </td>
              </tr>
              @endforeach
            @else
                <h1>No Pages Yet</h1>
            @endif
          </tbody>
        </table>
        {{ $pages->links() }}
      </div>
     
@endsection