@extends('master')
@section('title')
<title>Home</title>
@endsection
@section('content')
<h2>Blog List</h2>
<table border="1">
    <tr>
        <th>Blog ID</th>
        <th>Title</th>
        <!-- <th>Content</th> -->
        <th>Author</th>
        <th>Actions</th>
    </tr>
    @foreach($blogs as $key => $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->title }}</td>
        <td>{{ $value->author }}</td>
        <td>
            <a href="blog/{{ $value->id }}">View Details</a>
            <a href="blog/{{ $value->id }}/edit">Edit</a>
            <a href="delete/{{ $value->id }}" data-method="delete">Delete</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection