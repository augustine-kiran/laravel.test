<html>

<head>
    <title>Edit Category</title>
</head>

<body>
    <div>
        <h3>Update Category</h3>
    </div>
    <form action="{{ url('category/' . $category->id) }}" method="POST">
        @csrf
        {{ method_field('PUT') }}
        <label for="category_name">Edit Category Name: </label>
        <input type="text" name="category_name" id="category_name" value="{{ $category->name }}" maxlength="25" required autofocus>
        <input type="submit" value="Update Category">
    </form>
    <div>
        <p style="color: red;">{{ $errors->first('category_name') }}</p>
    </div>
</body>

</html>