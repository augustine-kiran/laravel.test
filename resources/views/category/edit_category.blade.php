@extends('master', ['title' => 'Edit Category'])
@section('content')
<div>
    <h3>Update Category</h3>
</div>
<form action="{{ url('category/' . $category->id) }}" method="POST">
    @csrf
    {{ method_field('PUT') }}
    <div class="form-group">
        <label for="category_name">Enter Category Name</label>
        <input type="text" class="form-control" name="category_name" id="category_name" value="{{ $category->name }}" placeholder="Enter Category name" maxlength="25" required autofocus>
    </div>
    <div>
        <p style="color: red;">{{ $errors->first('category_name') }}</p>
    </div>
    <button type="submit" class="btn btn-primary">Update Category</button>
</form>
@endsection