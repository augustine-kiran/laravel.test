@extends('master', ['title' => 'Edit Tag'])
@section('content')
<div>
    <h3>Update Tag</h3>
</div>
<form action="{{ url('tags/' . $tag->id) }}" method="POST">
    @csrf
    {{ method_field('PUT') }}
    <div class="form-group">
        <label for="tag_name">Enter Tag Name</label>
        <input type="text" class="form-control" name="tag_name" id="tag_name" value="{{ $tag->name }}" placeholder="Enter Tag name" maxlength="25" required autofocus>
    </div>
    <div>
        <p style="color: red;">{{ $errors->first('tag_name') }}</p>
    </div>
    <button type="submit" class="btn btn-primary">Update Tag</button>
</form>
@endsection