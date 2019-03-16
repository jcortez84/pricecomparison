@extends('layouts.admin')
@section('title', 'Add datafeed')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add a datafeed</h1>
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
        {!! Form::open(['action' => 'Admin\DatafeedsController@store', 'method' => 'POST']) !!}

        <div class="form-group">
          {!! Form::select('merchantId', [$merchants], $mId, ['placeholder' => 'Pick a merchant...', 'class'=>'form-control']); !!}
        </div>
        <div class="form-group">
          {!! Form::text('feed_url', '', ['class' => 'form-control', 'placeholder' => 'Feed URL e.g. https://www.datafeed.com/products-feed.csv']) !!}
        </div>

        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection