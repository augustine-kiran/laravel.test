@extends('master')
@section('title')
<title>Category</title>
@endsection
@section('content')
<div>
    <div>
        <h1>Categories</h1>
    </div>
    <div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            @foreach($category as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>
                    <a href="category/{{{ $value->id }}}">Edit</a>
                    <a href="category/delete/{{ $value->id }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <br>
    <form action="category/create" method="get">
        <label for="name">Enter category name: </label>
        <input type="text" name="name" id="name" required>
        <input type="submit" value="Add category">
    </form>
</div>
@endsection