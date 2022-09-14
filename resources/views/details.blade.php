@extends('master')
@section('title')
<title>Blog Details</title>
@endsection
@section('content')
<div>
    <label>Logged username: {{ session('username') }}</label>
    <h1>Blog Details</h1>
    <div>
        <h1>{{ $blog->title }}</h1>
        <p>{{ $blog->content }}</p>
        <p>Author: {{ $blog->author ?? "" }}</p>
        <p>Category: {{ $blog->category ?? "" }}</p>
        <img src="{{ asset($blog->image) }}" alt="Image">
        <p>Tags: {{ $blog->tags->tag_name ?? "" }}</p>
    </div>
</div>
@endsection