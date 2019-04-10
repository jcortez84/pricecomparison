@extends('layouts.admin')
@section('title', 'Merge products')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Mercge products</h1>
      </div>
      <div class="container">
        {!! Form::open(['action' => ['Admin\ProductsController@update', $product->id], 'method' => 'PUT']) !!}

        <div class="form-group">
          {!! Form::label('Product name:') !!}
          {!! Form::text('title',$product->title, ['class' => 'form-control']); !!}
        </div>
        <div class="form-group">
          {!! Form::label('Product Category:') !!}
          {!! Form::select('category_id', [0 => '--- Root ---',$categories], $product->category_id, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('MPN:') !!}
          {!! Form::text('mpn', $product->mpn, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('EAN:') !!}
          {!! Form::text('ean', $product->ean, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('UPC') !!}
          {!! Form::text('upc', $product->upc, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('GTIN') !!}
          {!! Form::text('gtin', $product->gtin, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('ISBN') !!}
          {!! Form::text('isbn', $product->isbn, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Description') !!}
          {!! Form::textarea('description', $product->description, ['class' => 'form-control', 'id' => 'desc']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Min Price') !!}
          {!! Form::number('min_price', $product->min_price, ['class' => 'form-control', 'pattern'=>"[0-9]+([\.,][0-9]+)?", 'step'=>"0.01", 'disabled']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Max Price') !!}
          {!! Form::number('max_price', $product->max_price, ['class' => 'form-control', 'pattern'=>"[0-9]+([\.,][0-9]+)?", 'step'=>"0.01", 'disabled']) !!}
        </div>
        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection