@extends('layouts.app')
@section('title', 'All Categories')
@section('content')
<div class="container">
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-muted" href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
</nav>
        <h1 class="text-muted h2">Categories</h1>
                <div class="row">
                        @foreach ($list as $category)
                                <div class="col-md-4 card pb-3">
                                        <a  class="text-teal mt-2 text-uppercase" href="/c/{{$category->slug}}" class="uppercase">{{ $category->title }}</a>
                                @foreach (App\Category::where('parent_id', $category->id)->get() as $child)
                                        <span class="text-pink ml-3">--- <a  class=" text-muted" href="/c/{{$child->slug}}">{{ $child->title }}</a></span>
                                @endforeach
                                </div>
                        @endforeach
                </div>

        
</div>
@endsection