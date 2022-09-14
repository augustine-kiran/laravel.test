@extends('master')
@section('title')
<title>Create new blog</title>
@endsection
@section('content')
<div>
    <form action="{{ url('blog') . '/' . $blog->id }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div>
            <label for="title">Enter Title:</label>
            <input type="text" id="title" name="title" value="{{ $blog->title }}" required>
        </div>
        <br>
        <div>
            <label for="content">Enter Content</label>
            <textarea name="content" id="content" cols="30" rows="10" style="resize: none;" required>{{ $blog->content }}</textarea>
        </div>
        <br>
        <div>
            <label for="category">Select Category</label>
            <select name="category" id="category">
                @foreach($category as $key => $value)
                @if($category_id == $value->id)
                <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                @else
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <br>
        <div>
            <label for="tags">Select Tags</label>
            <select name="tags" id="tags">
                @foreach($tags as $key => $value)
                @if($tag_id == $value->id)
                <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                @else
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <br>
        <div>
            <label for="image">Select Image</label>
            <input type="file" name="image" id="image" accept="image/png, image/jpeg" />
        </div>
        <br>
        <input type="submit" value="Update Blog">
    </form>
</div>
@endsection