@extends('layouts.app')
@if($page)
        @section('title', $page->title)
@endif
@section('content')
<div class="container">
<nav aria-label="breadcrumb">
        <ol class="breadcrumb rounded-0">
                <li class="breadcrumb-item"><a class="text-dark" href="/">Home</a></li>
                @if($page)
                <li class="breadcrumb-item active" aria-current="page">{{$page->title}}</li>
                @endif
        </ol>
</nav>
@if($page)
        <h1 class="page-heading text-muted">{{$page->title}}</h1>
        <div class="text-muted">
                {!!$page->body!!}
        </div>
@endif
</div>
@endsection