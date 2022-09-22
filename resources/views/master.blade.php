<html>

<head>
    <title>{{ $title ?? env('APP_NAME') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/toast.js') }}"></script>
</head>

<body>
    <div class="row justify-content-center" style="margin-top: 1%;">

        <!-- Home -->
        <div class="dropdown" style="margin-left: 20px;">
            <a href="{{ url('/') }}"><button class="dropbtn">Home</button></a>
        </div>

        &nbsp;
        <!-- Blog -->
        <div class="dropdown">
            <a href="{{ url('blog') }}"><button class="dropbtn">Blog</button></a>
            <div class="dropdown-content">
                <a href="{{ url('blog') }}">List Blog</a>
                <a href="{{ url('blog/create') }}">Create Blog</a>
            </div>
        </div>

        &nbsp;
        <!-- Category -->
        <div class="dropdown">
            <a href="{{ url('category') }}"><button class="dropbtn">Category</button></a>
            <div class="dropdown-content">
                <a href="{{ url('category') }}">List Categories</a>
                <a href="{{ url('category/create') }}">Create Category</a>
            </div>
        </div>

        &nbsp;
        <!-- Tag -->
        <div class="dropdown">
            <a href="{{ url('tags') }}"><button class="dropbtn">Tags</button></a>
            <div class="dropdown-content">
                <a href="{{ url('tags') }}">List Tags</a>
                <a href="{{ url('tags/create') }}">Create Tag</a>
            </div>
        </div>

        &nbsp;
        <!-- User -->
        <div class="dropdown">
            <a href="{{ url('user/create') }}"><button class="dropbtn">User</button></a>
            <div class="dropdown-content">
                <a href="{{ url('user/create') }}">Create User</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 offset-8">
            <p style="color: grey;">Logged User: {{ auth()->user()->name }}</p>
        </div>
    </div>
    <div class="container" style="border: 1 solid grey ;">
        @yield('content')
    </div>
</body>

</html>