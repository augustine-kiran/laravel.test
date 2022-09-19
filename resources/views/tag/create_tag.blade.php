<html>

<head>
    <title>Create Tag</title>
</head>

<body>
    <div>
        <h3>Create New Tag</h3>
    </div>
    <form action="{{ url('tags') }}" method="POST">
        @csrf
        <label for="tag_name">Enter New Tag Name: </label>
        <input type="text" name="tag_name" id="tag_name" maxlength="25" required autofocus>
        <input type="submit" value="Save Tag">
    </form>
    <div>
        <p style="color: red;">{{ $errors->first('tag_name') }}</p>
    </div>
</body>

</html>