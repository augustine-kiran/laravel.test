@extends('master', ['title' => 'Create Blog'])
@section('content')
<div>
    <h3>Create New blog</h3>
</div>
<form action="{{ url('blog') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">Enter Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
    </div>
    <div class="form-group">
        <label for="content">Enter Content</label>
        <textarea class="form-control" id="content" name="content" rows="3" placeholder="Enter Content" required></textarea>
    </div>
    <div class="form-group">
        <label for="category">Select Category</label>
        <select class="form-select form-control" id="category" name="category">
            @foreach($categories as $key => $value)
            <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="tags">Select Tags</label>
        @foreach($tags as $key => $value)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="tags[]" id="{{ 'check' . $value->id }}" value="{{ $value->id }}">
            <label class="form-check-label" for="{{ 'check' . $value->id }}">
                {{ $value->name }}
            </label>
        </div>
        @endforeach
    </div>
    <div class="form-group">
        <div class="mb-3">
            <label for="image" class="form-label">Select Image</label>
            <input class="form-control" name="image" type="file" id="image" accept="image/png, image/jpeg" required />
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg btn-block">Create New Blog</button>
</form>
@endsection