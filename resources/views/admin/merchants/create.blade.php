@extends('layouts.admin')
@section('title', 'Add new merchant')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add a merchant</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
   
        </div>
      </div>
      <div class="container">
        {!! Form::open(['action' => 'Admin\MerchantsController@store', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
        <div class="form-group">
          {!! Form::text('id', '', ['placeholder' => 'Unique ID e.g. AW299', 'class'=>"form-control $errors->has('id') ? ' is-invalid' : '';"]); !!}
          {{-- @if ($errors->has('id'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('id') }}</strong>
              </span>
          @endif --}}
        </div>
        <div class="form-group">
          {!! Form::label('Owner:') !!}
          {!! Form::select('userId', [1 => 'Admin'], null, ['class' => 'form-control']); !!}
        </div>
        <div class="form-group">
          {!! Form::text('name', '', ['placeholder' => 'Shop name e.g. Tesco', 'class'=>'form-control']); !!}
        </div>
        <div class="form-group">
          <div class="custom-file">
              {!! Form::label('logo', 'Upload Logo', ['class' => 'custom-fil-label', 'for' => 'merchant-logo', 'data-browse' => 'Upload Logo']) !!}
              {!! Form::file('logo'); !!}
          </div> 
        </div>
        <div class="form-group">
          {!! Form::text('url', '', ['class' => 'form-control', 'placeholder' => 'Merchant URL e.g. https://www.merchant.com']) !!}
        </div>
        <div class="form-group">
          {!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Merchant email e.g. support@merchant.com']) !!}
        </div>
        <div class="form-group">
          {!! Form::text('address_line_1', '', ['class' => 'form-control', 'placeholder' => 'Merchant address line 1 e.g. Unit A']) !!}
        </div>        
        <div class="form-group">
          {!! Form::text('address_line_2', '', ['class' => 'form-control', 'placeholder' => 'Merchant address line 2 e.g. 1 Business Avenue']) !!}
        </div>
        <div class="form-group">
          {!! Form::text('county', '', ['class' => 'form-control', 'placeholder' => 'Address county e.g. Kent']) !!}
        </div>
        <div class="form-group">
          {!! Form::text('city', '', ['class' => 'form-control', 'placeholder' => 'Merchant city e.g. Birmingham']) !!}
        </div>
        <div class="form-group">
          {!! Form::text('post_code', '', ['class' => 'form-control', 'placeholder' => 'Merchant post code e.g. W1 5TF']) !!}
        </div>
        <div class="form-group">
          {!! Form::text('strapline', '', ['class' => 'form-control', 'placeholder' => 'Merchant promo strapline e.g. Every little helps']) !!}
        </div>
        <div class="form-group">
          {!! Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Merchant description e.g. Been in business for over 30 years ........']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Active:') !!}
          {!! Form::select('is_valid', [1 => 'Yes', 0 => 'No'], ['class' => 'form-control', 'placeholder' => 'Merchant address line 1 e.g. 1 Business Avenue']) !!}
        </div>
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection