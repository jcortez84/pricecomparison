@extends('layouts.app')
@section('title', 'Retailers')
@section('content')
<div class="container">
        <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-muted" href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Retailers</li>
                </ol>
        </nav>
        <h1 class="h2 text-muted">Retailers</h1>
                <div class="row mb-3">
                        @foreach ($retailers as $retailer)
                <div class="col-md-4"> <a class="text-muted" href="/retailer/{{$retailer->slug}}">{{ $retailer->name }}</a></div>
                        @endforeach
                </div>
                <div class="row justify-content-center">
                        {{ $retailers->links() }}
                </div>
                       
</div>
@endsection