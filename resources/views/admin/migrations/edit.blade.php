@extends('layouts.admin')
@section('title', 'Edit a page')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit '{{ $page->title }}' Page</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">

          </div>
        </div>
      </div>
      <div class="container">
        {!! Form::open(['action' => ['Admin\PagesController@update', $page->id], 'method' => 'PUT']) !!}

        <div class="form-group">
          {!! Form::label('Title:') !!}
          {!! Form::text('title', $page->title, ['placeholder' => 'Page Title', 'class'=>'form-control']); !!}
        </div>
        <div class="form-group">
          {!! Form::label('Slug:') !!}
          {!! Form::text('slug', $page->slug, ['class' => 'form-control', 'placeholder' => 'page-title']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Write-Up:') !!}
          {!! Form::textarea('body', $page->body, ['class' => 'form-control', 'placeholder' => 'Write some information here....']) !!}

        </div>

        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection