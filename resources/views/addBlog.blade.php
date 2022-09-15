@extends('master')
@section('title')
<title>Create new blog</title>
@endsection
@section('content')
<div>
    <form action="/blog" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Enter Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <br>
        <div>
            <label for="content">Enter Content</label>
            <textarea name="content" id="content" cols="30" rows="10" style="resize: none;" required></textarea>
        </div>
        <br>
        <div>
            <label for="category">Select Category</label>
            <select name="category" id="category">
                @foreach($category as $key => $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div>
            <label for="tags">Select Tags</label>
            <br>
            @foreach($tags as $key => $value)
            <input type="checkbox" id="{{ $value->id }}" name="tags[]" value="{{ $value->id }}">
            <label for="{{ $value->id }}">{{ $value->name }}</label><br>
            @endforeach
        </div>
        <br>
        <div>
            <label for="image">Select Image</label>
            <input type="file" name="image" id="image" accept="image/png, image/jpeg" required />
        </div>
        <br>
        <input type="submit" value="Save Blog">
    </form>
</div>
@endsection