<html>

<head>
    <title>Edit Tag</title>
</head>

<body>
    <div>
        <h3>Update Tag</h3>
    </div>
    <form action="{{ url('tags/' . $tag->id) }}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        <label for="tag_name">Edit Tag Name: </label>
        <input type="text" name="tag_name" id="tag_name" value="{{ $tag->name }}" maxlength="25" required autofocus>
        <input type="submit" value="Update Tag">
    </form>
    <div>
        <p style="color: red;">{{ $errors->first('tag_name') }}</p>
    </div>
</body>

</html>