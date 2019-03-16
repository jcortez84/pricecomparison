@extends('layouts.admin')
@section('title', 'Edit category')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Update '{{ $category->title }}' Category</h1>
      </div>
      <div class="container">
        {!! Form::open(['action' => ['Admin\CategoriesController@update', $category->id ], 'method' => 'PUT']) !!}
        <div class="form-group">
          {!! Form::label('Parent Category:') !!}
          {!! Form::select('parent_id', [0 => '--- Root ---',$categories], $category->parent_id, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Category ID:') !!}
          {!! Form::number('id', $category->id, ['class' => 'form-control'], 'disabled') !!}
        </div>
        <div class="form-group">
          {!! Form::label('Category name:') !!}
          {!! Form::text('title', $category->title, ['class' => 'form-control', 'placeholder' => 'LCD TVs']); !!}
        </div>
        <div class="form-group">
          {!! Form::label('Slug:') !!}
          {!! Form::text('slug', $category->slug, ['class' => 'form-control', 'placeholder' => 'lcd-tvs']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Blurb:') !!}
          {!! Form::text('blurb', $category->blurb, ['class' => 'form-control', 'placeholder' => 'Meta description for search engines']) !!}
        </div>
        
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection