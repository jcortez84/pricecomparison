@extends('layouts.app')
@section('title', $page->title)
@section('content')
<div class="container">
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark" href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$page->title}}</li>
        </ol>
</nav>
        <h1 class="h2 text-success">{{$page->title}}</h1>
        <div>
                {!!$page->body!!}
        </div>
</div>
@endsection