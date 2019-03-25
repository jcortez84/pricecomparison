@extends('layouts.admin')
@section('title', 'Edit User')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit User</h1>
      </div>
      <div class="container">
        {!! Form::open(['action' => ['Admin\UsersController@update', $user->id], 'method' => 'PUT']) !!}
        <div class="form-group">
          {!! Form::label('Roles:') !!}
          {!! Form::select('role',$roles, $user_role->role_id, ['class' => 'form-control']); !!}
        </div>
        <div class="form-group">
          {!! Form::label('Name:') !!}
          {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Joe Bloggs']); !!}
        </div>
        <div class="form-group">
          {!! Form::label('Email:') !!}
          {!! Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'jbloggs@example.com']) !!}
        </div>
        
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
      </div>
@endsection      