@extends('master')
@section('title')
<title>Category</title>
@endsection
@section('content')
<div>
    <div>
        <h1>Categories</h1>
    </div>
    <form action="{{ url('category') }}" method="POST">
        @csrf
        <label for="name">Enter category name: </label>
        <input type="text" name="id" id="id" value="{{ $id }}" hidden>
        <input type="text" name="name" id="name" value="{{ $name }}">
        <input type="submit" value="Update category">
    </form>
</div>
@endsection