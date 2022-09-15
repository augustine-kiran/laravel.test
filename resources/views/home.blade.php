@extends('master')
@section('title')
<title>Home</title>
@endsection
@section('content')
<h2>Blog List</h2>
<label for="search">Search</label>
<input type="text" name="search" id="search" autofocus>
<button onclick="search()">Search</button>
<a href="{{ url('home') }}"><button>Clear</button></a>
@if(!empty($search))
<p>Search term: {{ $search }}</p>
@else
<br><br>
@endif
<table border="1">
    <tr>
        <th>Blog ID</th>
        <th>Title</th>
        <th>Category</th>
        <th>Author</th>
        <th>Comment's Count</th>
        <th>Actions</th>
    </tr>
    @foreach($blogs as $key => $value)
    <tr>
        <td>{{ $value->id }}</td>
        <td>{{ $value->title }}</td>
        <td>{{ $value->category }}</td>
        <td>{{ $value->author }}</td>
        <td>{{ $value->comments_count }}</td>
        <td>
            <a href="{{ url('blog/' . $value->id) }}">View Details</a>
            <a href="{{ url('blog/' . $value->id . '/edit') }}">Edit</a>
            <a href="{{ url('delete/' . $value->id) }}" data-method="delete">Delete</a>
        </td>
    </tr>
    @endforeach
</table>

<script>
    function search() {
        var term = document.getElementById("search").value;
        if (term != '') {
            var url = "{{ url('home') }}" + "/" + term;
            window.location.href = url;
        } else {
            window.location.href = "{{url('home')}}";
        }
    }
</script>
@endsection