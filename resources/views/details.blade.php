@extends('master')
@section('title')
<title>Blog Details</title>
@endsection
@section('content')
<div>
    <h1>Blog Details</h1>
    <div style="width: 70%; float: left;">
        <h1>{{ $blog->title }}</h1>
        <p>{{ $blog->content }}</p>
        <p>Author: {{ $blog->author ?? "" }}</p>
        <p>Category: {{ $blog->category ?? "" }}</p>
        <img src="{{ asset($blog->image) }}" alt="Image">
        <p>Tags:
            @foreach($blog->tags as $key => $value)
            {{ $value->tag_name }}
            @endforeach

            <!-- {{ $blog->tags->tag_name ?? "" }} -->
        </p>
    </div>
    <div>
        <h3>Comments</h3>
        <div>
            <form action="{{ url('blog/create') }}" method="get">
                <label for="comment">Your comment</label>
                <input type="text" name="comment" id="comment" required autofocus>
                <input type="text" name="blog_id" value="{{ $blog->id }}" hidden>
                <input type="submit" value="Save comment">
            </form>
        </div>
        @foreach($blog->comments as $key => $value)
        <div>
            <p>{{$value->comment}}<br>&emsp;&emsp;<i>by</i> <b>{{ $value->author }}</b>
            </p>
        </div>
        @endforeach
    </div>
</div>
@endsection