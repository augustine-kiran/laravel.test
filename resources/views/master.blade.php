<html>

<head>
    <title>{{ $title ?? env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <script src="{{ asset('js/datatables.min.js') }}"></script>
</head>

<body>
    <p>
        <a href="/user/create">Create user</a> |
        <a href="/blog">Create Blog</a> |
        <a href="/home">List all blogs</a> |
        <a href="/category">List all categories</a> |
        <a href="/tags">List all Tags</a> |
        <a href="{{ url('logout') }}">Logout</a>
    </p>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>