@extends('layouts.admin')
@section('title', 'Add Product Prices')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Prices From CSV File</h1>
        
      </div>
      <div class="container">

        {!! Form::open(['action' => 'Admin\PricesController@csvStore', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
        <div class="form-group">
          {!! Form::label('Affiliate Feed:') !!}
          {{ Form::hidden('mId', Request::get('mId')) }}
        </div>
        <div class="form-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
              </div>
          <div class="custom-file">
              {!! Form::label('file', '', ['class' => 'custom-file-label', "for"=>"inputGroupFile01"]) !!}
              {!! Form::file('file', ['class'=>'custom-file-input', 'id'=>"inputGroupFile01", "aria-describedby"=>"inputGroupFileAddon01"]) !!}
          </div>
        </div>
        {!! Form::submit('Next', ['class' => 'btn btn-success']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection