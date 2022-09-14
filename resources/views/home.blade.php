<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
</head>

<body>
    <label>Logged username: {{ session('username') }}</label>
    <h2>Blog List</h2>
    <table border="1">
        <tr>
            <th>Blog ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
        @foreach($blogs as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->title }}</td>
            <td>{{ $value->content }}</td>
            <td>
                <a href="blog/{{ $value->id }}">View Details</a>
                <a href="delete/{{ $value->id }}" data-method="delete">Delete</a>
                <!-- <a href="delete/{{ $value->id }}" data-method="delete">Delete</a> -->
            </td>
        </tr>
        @endforeach
    </table>
    <a href="/blog"><button>Create New Blog</button></a>
    <a href="/logout"><button>Logout</button></a>
</body>

</html>