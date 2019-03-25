@extends('layouts.admin')
@section('title', 'Users')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          
            @if (count($users)>0)
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($users as $user)
              <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->roles[0]->name }}</td>
                <td>
                  <a class="btn btn-sm btn-outline-warning" href="/admin/users/{{ $user->id }}/edit"><span data-feather="edit"></span></a>
                </td>
              </tr>
              @endforeach
            @else
                <h1>No Users Yet</h1>
            @endif
          </tbody>
        </table>
        {{ $users->links() }}
      </div>
     
@endsection