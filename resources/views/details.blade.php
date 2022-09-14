<!DOCTYPE html>
<html>

<head>
    <title>Blog Details</title>
</head>

<body>
    <div>
        <label>Logged username: {{ session('username') }}</label>
        <h1>Blog Details</h1>
        <div>
            <h1>{{ $blog->title }}</h1>
            <p>{{ $blog->content }}</p>
            <p>Author: {{ $blog->author }}</p>
            <p>Category: {{ $blog->category }}</p>
            <img src="{{ asset('storage/app/' . $blog->image) }}" alt="Image" width="500" height="600">
            <p>Tags: </p>
        </div>
        <a href="/home"><button>Go back</button></a>
        <a href="/logout"><button>Logout</button></a>
    </div>
    {{ $blog }}
</body>

</html>