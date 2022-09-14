@extends('master')
@section('title')
<title>Tags</title>
@endsection
@section('content')
<div>
    <div>
        <h1>Tags</h1>
    </div>
    <div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            @foreach($tags as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>
                    <!-- <a href="tags/create">Create New</a> -->
                    <a href="tags/delete/{{ $value->id }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <form action="tags/create" method="get">
        <label for="name">Enter Tag name: </label>
        <input type="text" name="name" id="name">
        <input type="submit" value="Add Tag">
    </form>
</div>
@endsection