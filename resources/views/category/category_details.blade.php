@extends('master', ['title' => 'Category Details'])
@section('content')
<div>
    <h3>Category Details</h3>
</div>
<form action="{{ url('category') }}" method="GET">
    <div class="form-group">
        <p for="category_name">Category Name: {{ $category->name }}</p>
    </div>
    <button type="submit" class="btn btn-primary">Show all Categories</button>
</form>
@endsection