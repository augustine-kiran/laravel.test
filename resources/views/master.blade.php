<!DOCTYPE html>
<html>

<head>
    @yield('title')
</head>

<body>
    <div>
        @if(session('username'))
        <p>
            <a href="/blog">Create Blog</a> |
            <a href="/home">List all blogs</a> |
            <a href="/category">List all categories</a> |
            <a href="/tags">List all Tags</a> |
            <a href="/logout">Logout</a>
        </p>
        <label>Logged username: {{ session('username') }}</label>
        @endif
        <br>
        <br>
        <div>
            @yield('content')
        </div>
    </div>
</body>

</html>