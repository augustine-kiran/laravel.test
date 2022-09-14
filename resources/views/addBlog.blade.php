<!DOCTYPE html>
<html>

<head>
    <title>Create new blog</title>
</head>

<body>
    <div>
        <form action="/blog" method="post" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title">Enter Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <br>
            <div>
                <label for="content">Enter Content</label>
                <textarea name="content" id="content" cols="30" rows="10" style="resize: none;" required></textarea>
            </div>
            <br>
            <div>
                <label for="category">Enter Content</label>
                <select name="category" id="category">
                    @foreach($category as $key => $value)
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div>
                <label for="image">Select Image</label>
                <input type="file" name="image" id="image" accept="image/png, image/jpeg" required />
            </div>
            <br>
            <input type="submit" value="Save Blog">
        </form>
        <a href="/home"><button>Go back</button></a>
    </div>
</body>

</html>