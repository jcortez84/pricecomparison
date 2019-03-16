@extends('layouts.admin')
@section('title', 'Add Products')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add Products From CSV File</h1>
        
      </div>
      <div class="container">

        {!! Form::open(['action' => 'Admin\ProductsController@csvStore', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
        <div class="form-group">
          {!! Form::label('Affiliate Feed:') !!}
          {!! Form::select('affiliate', ['AW' => 'Affiliate Window', 'AF'=>'Affiliate Future', 'WG'=>'Webgains', 'PR'=>'Paid on Results', 'CJ'=>'Commission Junction', 'TD'=>'TradeDoubler', 'LS'=>'Linkshare', 'AN'=>'AffiliNet'], null, ['class' => 'form-control']) !!}
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
        {!! Form::submit('Upload', ['class' => 'btn btn-success']) !!}

        {!! Form::close() !!}
      </div>
     
@endsection