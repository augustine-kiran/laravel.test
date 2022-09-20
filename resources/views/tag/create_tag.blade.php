@extends('master', ['title' => 'Create Tag'])
@section('content')
<div>
    <h3>Create Tag</h3>
</div>
<form action="{{ url('tags') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="tag_name">Enter Tag Name</label>
        <input type="text" class="form-control" name="tag_name" id="tag_name" placeholder="Enter Tag name" maxlength="25" required autofocus>
    </div>
    <div>
        <p style="color: red;">{{ $errors->first('tag_name') }}</p>
    </div>
    <button type="submit" class="btn btn-primary">Create Tag</button>
</form>
@endsection