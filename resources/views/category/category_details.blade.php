@extends('master', ['title' => 'Category Details'])
@section('content')
<div>
    <h3>Category Details</h3>
</div>
<div>
    <div class="form-group">
        <p for="category_name">Category Name: {{ $category->name }}</p>
    </div>
</div>
@endsection