@extends('master', ['title' => 'Create Category'])
@section('content')
<div>
    <h3>Create Category</h3>
</div>
<form action="{{ url('category') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="category_name">Enter Category Name</label>
        <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Category name" maxlength="25" required autofocus>
    </div>
    <div>
        <p style="color: red;">{{ $errors->first('category_name') }}</p>
    </div>
    <button type="submit" class="btn btn-primary">Create Category</button>
</form>
@endsection