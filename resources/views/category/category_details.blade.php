<html>

<head>
    <title>Category Details</title>
</head>

<body>
    <div>
        <h3>Category Details</h3>
    </div>
    <form action="{{ url('category/' . $category->id) }}" method="POST">
        @csrf
        {{ method_field('DELETE') }}
        <label for="category_name">Category Name: </label>
        <input type="text" name="category_name" id="category_name" value="{{ $category->name }}" readonly>
        <input type="submit" value="Delete Category">
    </form>
    <div>
        <p style="color: red;">{{ $errors->first('category_name') }}</p>
    </div>
</body>

</html>