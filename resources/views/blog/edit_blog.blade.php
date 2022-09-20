<html>

<head>
    <title>Edit blog</title>
</head>

<body>
    <div>
        <form action="{{ url('blog') . '/' . $blog->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div>
                <label for="title">Enter Title:</label>
                <input type="text" id="title" name="title" value="{{ $blog->title }}" required>
            </div>
            <br>
            <div>
                <label for="content">Enter Content</label>
                <textarea name="content" id="content" cols="30" rows="10" style="resize: none;" required>{{ $blog->content }}</textarea>
            </div>
            <br>
            <div>
                <label for="category">Select Category</label>
                <select name="category" id="category">
                    @foreach($categories as $key => $value)
                    @if($blog->category->id == $value->id)
                    <option value="{{ $value->id }}" selected>{{ $value->name }}</option>
                    @else
                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <br>
            <div>
                <label for="tags">Select Tags</label>
                <br>
                @foreach($tags as $key => $value)
                @if(in_array($value->id, $blog->tags->pluck('id')->all()))
                <input type="checkbox" id="{{ $value->id }}" name="tags[]" value="{{ $value->id }}" checked>
                @else
                <input type="checkbox" id="{{ $value->id }}" name="tags[]" value="{{ $value->id }}">
                @endif
                <label for="{{ $value->id }}">{{ $value->name }}</label><br>
                @endforeach
            </div>
            <br>
            <div>
                <label for="image">Select New Image</label>
                <input type="file" name="image" id="image" accept="image/png, image/jpeg" />
            </div>
            <br>
            <input type="submit" value="Update Blog">
        </form>
    </div>
</body>

</html>