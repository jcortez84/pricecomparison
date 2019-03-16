@extends('layouts.admin')
@section('title', 'Add merchants')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add merchants from CSV file</h1>
        
      </div>
      <div class="container">

        {!! Form::open(['action' => 'Admin\MerchantsController@csvStore', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
        <div class="form-group">
          {!! Form::label('Affiliate Feed:') !!}
          {!! Form::select('affiliate', ['AW' => 'Affiliate Window', 'AF'=>'Affiliate Future', 'WG'=>'Webgains', 'PR'=>'Paid on Results', 'CJ'=>'Commission Junction', 'TD'=>'TradeDoubler', 'LS'=>'Linkshare', 'AN'=>'AffiliNet'], null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
          {!! Form::label('Import merchants file (CSV):') !!}
          {!! Form::file('file', ['class' => 'form-control']) !!}
        </div>
        {!! Form::submit('Upload', ['class' => 'btn btn-danger']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection