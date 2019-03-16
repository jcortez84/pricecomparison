@extends('layouts.admin')
@section('title', 'Add categories')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add categories from CSV file</h1>
        
      </div>
      <p class="alert alert-danger">Running this function will delete all your categories from your database.</p>
      <div class="container">
        <div><p>Your csv colums must be in this order:<br/> ID, Parent ID, Category Name</p></div>
        {!! Form::open(['action' => 'Admin\CategoriesController@csvStore', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
        <div class="form-group">
          {!! Form::label('Import categories file (CSV):') !!}
          {!! Form::file('file') !!}
        </div>
        {!! Form::submit('Upload', ['class' => 'btn btn-danger']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection