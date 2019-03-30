@extends('layouts.admin')
@section('title', 'Migrations')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Migrations</h1>

      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          
            @if (count($migrations)>0)
              <thead>
                <tr>
                  <th>#</th>
                  <th>Migration</th>
                  <th>Batch</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($migrations as $migration)
              <tr>
                <td>{{ $migration->id }}</td>
                <td>{{ $migration->migration }}</td>
                <td>{{ $migration->batch }}</td>
                <td>
                  <form method="POST" action="/admin/migrations/{{ $migration->id }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-sm btn-outline-danger" ><span data-feather="trash"></span></button>         
                  </form>
                </td>
              </tr>
              @endforeach
            @else
                <h1>No Migration Yet</h1>
            @endif
          </tbody>
        </table>
        {{ $migrations->links() }}
      </div>
     
@endsection