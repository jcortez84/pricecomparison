@extends('layouts.admin')
@section('title', 'Add User')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">add User</h1>
      </div>
      <div class="container">
        {!! Form::open(['action' => 'Admin\UsersController@store', 'method' => 'POST']) !!}
        <div class="form-group">
          {!! Form::label('Roles:') !!}
          {!! Form::select('role',$roles, null, ['class' => 'form-control']); !!}
        </div>
        <div class="form-group">
          {!! Form::label('Name:') !!}
          {!! Form::text('name','', ['class' => 'form-control', 'placeholder' => 'Joe Bloggs']); !!}
        </div>
        <div class="form-group">
          {!! Form::label('Email:') !!}
          {!! Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'jbloggs@example.com']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Password:') !!}
          {!! Form::text('password', '', ['class' => 'form-control', 'placeholder' => 'password']) !!}
        </div>
        
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
      </div>
@endsection