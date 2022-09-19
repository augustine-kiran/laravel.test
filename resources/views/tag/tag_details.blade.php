<html>

<head>
    <title>Tag Details</title>
</head>

<body>
    <div>
        <h3>Tag Details</h3>
    </div>
    <form action="{{ url('tags/' . $tag->id) }}" method="POST">
        @csrf
        {{ method_field('DELETE') }}
        <label for="tag_name">Tag Name: </label>
        <input type="text" name="tag_name" id="tag_name" value="{{ $tag->name }}" readonly>
        <input type="submit" value="Delete Tag">
    </form>
    <div>
        <p style="color: red;">{{ $errors->first('tag_name') }}</p>
    </div>
</body>

</html>