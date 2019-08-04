@extends('layouts.admin')
@section('title', 'Add category')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add a category</h1>
      </div>
      <div class="container mb-5">
        {!! Form::open(['action' => 'Admin\CategoriesController@store', 'method' => 'POST']) !!}
        <div class="form-group">
          {!! Form::label('Parent Category:') !!}
          {!! Form::select('parent_id', [0 => '--- Root ---',$categories], '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Category ID:') !!}
          {!! Form::number('id', '', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Category name:') !!}
          {!! Form::text('title','', ['class' => 'form-control', 'placeholder' => 'LCD TVs']); !!}
        </div>
        <div class="form-group">
          {!! Form::label('Slug:') !!}
          {!! Form::text('slug', '', ['class' => 'form-control', 'placeholder' => 'lcd-tvs']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Blurb:') !!}
          {!! Form::text('blurb', '', ['class' => 'form-control', 'placeholder' => 'Meta description for search engines']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Featured:') !!}
            {!! Form::select('is_featured', [0 => '--- No ---', 1 => '--- Yes ---'], '', ['class' => 'form-control']) !!}
        </div>
        
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection