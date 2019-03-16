@extends('layouts.admin')
@section('title', 'Clicks create')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Dashboard</h1>
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
<div class="row">
  <canvas class="my-4 w-100" id="myChart" width="400" height="80"></canvas>
  <div class="card">
      <div class="card-body">
        <span>{{ $total_products }} Products</span>
      </div>
  </div>
  <div class="card">
      <div class="card-body">
        <span>{{ $total_merchants }} Merchants</span>
      </div>
  </div>
  <div class="card">
      <div class="card-body">
        <span>{{ $total_prices }} Prices</span>
      </div>
  </div>
  <div class="card">
      <div class="card-body">
        <span>{{ $total_users }} Registered users</span>
      </div>
  </div>
  <div class="card">
      <div class="card-body">
        <span>{{ $total_images_to_download }} New product images</span>
      </div>
  </div>
  <div class="card">
      <div class="card-body">
        <span>{{ $total_brands }} Total brands</span>
      </div>
  </div>
</div>

 



     
@endsection