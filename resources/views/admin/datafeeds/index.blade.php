@extends('layouts.admin')
@section('title', 'Datafeeds')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Datafeeds</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="mr-2">
      <a href='{{ url("/admin/datafeeds/create?mId=$mId") }}' class="btn btn-info">Add a datafeed</a>
    </div>
  </div>
</div>
<div class="table-responsive">

  @if (count($datafeeds) > 0)
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>Merchant ID</th>
        <th>Remote URL</th>
        <th>Match</th>
        <th>Add new products</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($datafeeds as $datafeed)
      <tr>
        <td>{{ $datafeed->id }}</td>
        <td>{{ $datafeed->merchant_id }}</td>
        <td>{{ str_limit($datafeed->url, 50, '....') }}</td>
        <td>{{ $datafeed->match_by }}</td>
        <td>{{ $datafeed->add_new_products }}</td>

        <td>
          <a class="btn btn-sm btn-outline-info" href="/admin/datafeeds/{{ $datafeed->id }}/edit"><span
              data-feather="edit"></span></a>
          <a class="btn btn-sm btn-outline-dark" href="/admin/datafeed/{{ $datafeed->id }}/test"><span
              data-feather="settings"></span></a>
          <a class="btn btn-sm btn-outline-success" href="/admin/datafeed/{{ $datafeed->id }}/run"><span
              data-feather="zap"></span></a>

        </td>
        <td>
          <form method="POST" action="/admin/datafeeds/{{ $datafeed->id }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-sm btn-outline-danger"><span data-feather="trash"></span></button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @else
  <h1>There are no datafeeds added yet.</h1>
  @endif


  {{ $datafeeds->links() }}
</div>

@endsection