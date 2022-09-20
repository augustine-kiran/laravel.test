@extends('master', ['title' => 'Blog Details'])
@section('content')
<div>
    <h1>Blog Details</h1>
</div>
<form action="">
    <h3>{{ $blog->title }}</h3>
    <p>{{ $blog->content }}</p>
    <p>Author: {{ $blog->author->username ?? "" }}</p>
    <p>Category: {{ $blog->category->name ?? "" }}</p>
    <img src="{{ asset($blog->image->path) }}" class="img-fluid" alt="{{ $blog->title }} image">
    <p>Tags:
        @foreach($blog->tags as $key => $value)
        {{ $value->name }}, &nbsp;
        @endforeach
    </p>
    <form action="{{ url('blog/' . $blog->id) }}" method="POST">
        @csrf
        {{ method_field('DELETE') }}
        <input type="hidden" name="blog_id" id="blog_id" value="{{ $blog->id }}">
        <input type="submit" value="Delete Blog">
    </form>
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
            <p>{{$value->comment}}<br>&emsp;&emsp;<i>by</i> <b>{{ $value->author->{$blog::AUTHOR_NAME} }}</b>
            </p>
        </div>
        @endforeach
    </div>
</form>
@endsection