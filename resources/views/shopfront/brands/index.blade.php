@extends('layouts.app')
@section('title', 'Brands')
@section('content')
<div class="container">
<nav aria-label="breadcrumbs">
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark" href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Brands</li>
        </ol>
</nav>
        <h1 class="h2 text-success">Brands</h1>
                <div class="row mb-3">
                        @foreach ($brands as $brand)
                <div class="col-md-4"> <a class="text-dark" href="/brand/{{strtolower($brand->name)}}">{{ $brand->name }}</a></div>
                        @endforeach
                </div>
                <div class="row justify-content-center">
                        {{ $brands->links() }}
                </div>
        
</div>
@endsection