@extends('layouts.app')
@section('title', 'All Categories')
@section('content')
<div class="container">
<nav aria-label="breadcrumb">
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-dark" href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
</nav>
        <h1 class="text-success h2">Categories</h1>
                <div class="row">
                        @foreach ($categories as $category)
                                <div class="col-md-4"> <a  class="text-dark" href="/c/{{$category->slug}}" class="uppercase">{{ $category->title }}</a>
                                @foreach (App\Category::where('parent_id', $category->id)->get() as $child)
                                        <div class="col-md-12"> <a  class="text-dark" href="/c/{{$child->slug}}">--{{ $child->title }}</a></div>
                                @endforeach
                                </div>
                        @endforeach
                </div>

        
</div>
@endsection