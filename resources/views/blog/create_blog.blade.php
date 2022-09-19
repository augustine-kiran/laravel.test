<html>

<head>
    <title>Create Blog</title>
</head>

<body>
    <div>
        <h3>Create New blog</h3>
    </div>
    <form action="{{ url('blog') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Enter Title:</label>
            <input type="text" id="title" name="title" maxlength="25" required autofocus>
        </div>
        <br>
        <div>
            <label for="content">Enter Content</label>
            <textarea name="content" id="content" cols="30" rows="10" style="resize: none;" required></textarea>
        </div>
        <br>
        <div>
            <label for="category">Select Category</label>
            <select name="category" id="category">
                @foreach($categories as $key => $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div>
            <label for="tags">Select Tags</label>
            <br>
            @foreach($tags as $key => $value)
            <input type="checkbox" id="{{ $value->id }}" name="tags[]" value="{{ $value->id }}">
            <label for="{{ $value->id }}">{{ $value->name }}</label><br>
            @endforeach
        </div>
        <br>
        <div>
            <label for="image">Select Image</label>
            <input type="file" name="image" id="image" accept="image/png, image/jpeg" required />
        </div>
        <br>
        <input type="submit" value="Save Blog">
    </form>
</body>

</html>