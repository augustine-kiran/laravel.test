@extends('master')
@section('title')
<title>Tags</title>
@endsection
@section('content')
<div>
    <div>
        <h1>Tags</h1>
    </div>
    <form action="{{ url('tags') }}" method="POST">
        @csrf
        <label for="name">Enter tag name: </label>
        <input type="text" name="id" id="id" value="{{ $id }}" hidden>
        <input type="text" name="name" id="name" value="{{ $name }}">
        <input type="submit" value="Update Tag">
    </form>
</div>
@endsection