@extends('layouts.admin')
@section('title', 'Users')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users</h1>
        <div class="btn-group mr-2">
            <a href="{{ url('/admin/users/create') }}" class="btn btn-info">Add a user</a>
        </div>
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
                  <a href="/admin/users/{{ $user->id }}/edit"><span data-feather="edit"></span></a>
                  <a href=""><span data-feather="zap"></a></span>
                  <a href=""><span data-feather="dollar-sign"></span></a>
                  <a href=""><span data-feather="activity"></span></a>
                  <a  href=""><span data-feather="trash"></span></a>
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