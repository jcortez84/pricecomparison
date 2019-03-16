@extends('layouts.admin')
@section('title', 'Add product')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add a product</h1>
      </div>
      <div class="container">
        {!! Form::open(['action' => 'Admin\ProductsController@store', 'method' => 'POST']) !!}
        <div class="form-group">
          {!! Form::label('Product Category:') !!}
          {!! Form::select('subcat',[$subcats], null, ['class' => 'form-control']); !!}
        </div>
        <div class="form-group">
          {!! Form::label('Product name:') !!}
          {!! Form::text('title','', ['class' => 'form-control', 'placeholder' => 'Samsung QE65Q9FNAT OLED TV']); !!}
        </div>
        <div class="form-group">
          {!! Form::label('MPN:') !!}
          {!! Form::text('mpn', '', ['class' => 'form-control', 'placeholder' => 'QE65Q9FNATXXU']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('EAN:') !!}
          {!! Form::text('ean', '', ['class' => 'form-control', 'placeholder' => '1331873761221']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('UPC') !!}
          {!! Form::text('upc', '', ['class' => 'form-control', 'placeholder' => 'UPC-A 065100004327']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('GTIN') !!}
          {!! Form::text('gtin', '', ['class' => 'form-control', 'placeholder' => '1331873761221']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('ISBN') !!}
          {!! Form::text('isbn', '', ['class' => 'form-control', 'placeholder' => ' 978-3-16-148410-0']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Description') !!}
          {!! Form::textarea('description', '', ['class' => 'form-control', 'id' => 'desc', 'placeholder' => 'The description of this product goes here......']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Min Price') !!}
          {!! Form::number('min_price', '', ['class' => 'form-control', 'placeholder' => 'e.g. 199']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Max Price') !!}
          {!! Form::number('max_price', '', ['class' => 'form-control', 'placeholder' => 'e.g. 300']) !!}
        </div>
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection