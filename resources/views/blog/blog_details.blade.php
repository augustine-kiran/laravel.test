@extends('master', ['title' => 'Blog Details'])
@section('content')
<div class="row">
    <div class="col-md-6">
        <img src="{{ asset($blog->image->path) }}" class="img-fluid" alt="Blog-Image" width="100%">
    </div>
    <div class="col-md-6">
        <div>
            <h3>{{ $blog->title }}</h3>
        </div>
        <div class="form-group">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" style="resize: none;" disabled>{{ $blog->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" class="form-control" id="category" value="{{ $blog->category->name }}" disabled>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" value="{{ $blog->author->name }}" disabled>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 2%;">
    <div class="col-md-6">
        <div class="form-group">
            @if(count($blog->tags) > 0)
            <label for="tags">Tags</label>
            @foreach($blog->tags as $key => $value)
            <input type="text" class="form-control" id="tags" value="{{ $value->name }}" disabled>
            @endforeach
            @endif
        </div>
    </div>
    <div class="md-col-6">
        <form action="{{ url('blog/' . $blog->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Blog</button>
        </form>
    </div>
    <div class="col-md-11 offset-md-1">
        <form action="{{ url('comments/') }}" method="POST">
            @csrf
            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
            <div class="form-group">
                <label for="comment">Enter Comment</label>
                <input type="text" class="form-control" id="comment" name="comment" placeholder="Enter Comment" required>
            </div>
            <button type="submit" class="btn btn-success">Add comment</button>
        </form>
        <div class="page-header">
            <h1><small class="pull-right">{{ $blog->comments_count }} comments</small></h1>
        </div>
        <div class="comments-list">
            @foreach($blog->comments as $key => $value)
            <form action="{{ url('comments/' . $value->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading user_name">{{ $value->author->name }}</h4>
                        {{ $value->comment }}
                    </div>
                    <p class="pull-right"><small>{{ $value->days_ago }}</small></p>&nbsp;
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</div>

<style>
    .user_name {
        font-size: 14px;
        font-weight: bold;
    }

    .comments-list .media {
        border-bottom: 1px dotted #ccc;
    }
</style>
@endsection