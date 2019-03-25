@extends('layouts.admin')
@section('title', 'Edit merchant')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit {{ $merchant->name }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
   
        </div>
      </div>
      <div class="container">
        {!! Form::open(['action' => ['Admin\MerchantsController@update', $merchant->id], 'enctype' => 'multipart/form-data', 'files' => true, 'method' => 'PUT']) !!}
        <div class="form-group">
          {!! Form::label('Merchant ID:') !!}
          {!! Form::text('id', $merchant->id, [ 'class'=>"form-control", 'readonly']); !!}
        </div>
        <div class="form-group">
          {!! Form::label('Owner:') !!}
          {!! Form::select('userId', [1 => 'Admin'], $merchant->user_id, ['class' => 'form-control']); !!}
        </div>
        <div class="form-group">
          {!! Form::label('Merchant Name:') !!}
          {!! Form::text('name',  $merchant->name, ['placeholder' => 'Shop name e.g. Tesco', 'class'=>'form-control']); !!}
        </div>
        <div class="form-group">
          <div class="custom-file">
              {!! Form::label('logo', 'Upload Logo', ['class' => 'custom-file-label', 'for' => 'merchant-logo', 'data-browse' => 'Upload Logo']) !!}
              {!! Form::file('logo'); !!}
          </div> 
        </div>
        <div class="form-group">
          {!! Form::label('Merchant URL:') !!}
          {!! Form::text('url',  $merchant->url , ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Merchant Email:') !!}
          {!! Form::email('email', $merchant->email, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Address:') !!}
          {!! Form::text('address_line_1', $merchant->address_line_1, ['class' => 'form-control']) !!}
        </div>        
        <div class="form-group">
          {!! Form::label('Address:') !!}
          {!! Form::text('address_line_2', $merchant->address_line_2, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('County:') !!}
          {!! Form::text('county', $merchant->county, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('City:') !!}
          {!! Form::text('city', $merchant->city, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Post Code:') !!}
          {!! Form::text('post_code', $merchant->post_code, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Strapline:') !!}
          {!! Form::text('strapline', $merchant->strapline, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Description:') !!}
          {!! Form::textarea('description', $merchant->description, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Active:') !!}
          {!! Form::select('is_valid', [1 => 'Yes', 0 => 'No'], $merchant->is_valid, ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection