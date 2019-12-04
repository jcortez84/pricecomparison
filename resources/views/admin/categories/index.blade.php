@extends('layouts.admin')
@section('title', 'Categories')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Categories</h1>
  <div class="mr-2">
    <a href="{{ url('/admin/categories/create') }}" class="btn btn-info">Add a category</a>
    <a href="{{ url('/admin/categories-csv') }}" class="btn btn-warning">Upload Categories from CSV file</a>
  </div>
</div>
<div class="table-responsive">
  <table class="table table-striped table-sm">

    @if (count($categories)>0)
    <thead>
      <tr>
        <th>#</th>
        <th>Parent ID</th>
        <th>Title</th>
        <th>Slug</th>

        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
      <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->parent_id }}</td>
        <td>{{ $category->title }}</td>
        <td>{{ $category->slug }}</td>
        <td>
          <a class="btn btn-sm btn-outline-info" href="/admin/categories/{{ $category->id }}/edit"><span
              data-feather="edit"></span></a>
          {{-- <a href=""><span data-feather="zap"></a></span>
                  <a href=""><span data-feather="dollar-sign"></span></a>
                  <a href=""><span data-feather="activity"></span></a> --}}
          {{-- <a class="btn btn-sm btn-outline-danger" href=""><span data-feather="trash"></span></a> --}}
        </td>
        <td>
          <form method="POST" action="/admin/categories/{{ $category->id }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-outline-danger"><span data-feather="trash"></span></button>
          </form>
        </td>
      </tr>
      @endforeach
      @else
      <h1>No Categories Yet</h1>
      @endif

    </tbody>
  </table>

  {{ $categories->links() }}
</div>

@endsection