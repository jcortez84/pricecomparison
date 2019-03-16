@extends('layouts.admin')
@section('title', 'Edit datafeed')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Datafeed</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>
      <div class="container">
        {!! Form::open(['action' => ['Admin\DatafeedsController@update', $feed->id], 'method' => 'PUT']) !!}

        <div class="form-group">
          {!! Form::select('merchantId', [$merchants], $feed->merchant_id, ['placeholder' => 'Pick a merchant...', 'class'=>'form-control']); !!}
        </div>
        <div class="form-group">
          {!! Form::text('feed_url', $feed->url, ['class' => 'form-control', 'placeholder' => 'Feed URL e.g. https://www.datafeed.com/products-feed.csv']) !!}
        </div>

        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection