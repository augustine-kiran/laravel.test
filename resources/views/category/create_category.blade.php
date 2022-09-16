<html>

<head>
    <title>Create Category</title>
</head>

<body>
    <div>
        <h3>Create New Category</h3>
    </div>
    <form action="{{ url('category') }}" method="POST">
        @csrf
        <label for="category_name">Enter New Category Name: </label>
        <input type="text" name="category_name" id="category_name" maxlength="25" required autofocus>
        <input type="submit" value="Save Category">
    </form>
    <div>
        <p style="color: red;">{{ $errors->first('category_name') }}</p>
    </div>
</body>

</html>