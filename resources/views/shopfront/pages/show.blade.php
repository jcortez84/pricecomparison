@extends('layouts.app')
@if($page)
        @section('title', $page->title)
@endif
@section('content')
<div class="container">
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark" href="/">Home</a></li>
                @if($page)
                <li class="breadcrumb-item active" aria-current="page">{{$page->title}}</li>
                @endif
        </ol>
</nav>
@if($page)
        <h1 class="h2 text-success">{{$page->title}}</h1>
        <div>
                {!!$page->body!!}
        </div>
@endif
</div>
@endsection