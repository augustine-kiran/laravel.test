@extends('master', ['title' => 'List Blogs'])
@section('content')
<div>
    <div>
        <h1>All blogs</h1>
    </div>
    <div>
        <table id="example"></table>
    </div>






    <script>
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#example tfoot th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });

            // DataTable
            var table = $('#example').DataTable({
                initComplete: function() {
                    // Apply the search
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;

                            $('input', this.footer()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                },
            });
        });
    </script>
    <div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
            @foreach($blog as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->title }}</td>
                <td>
                    <a href="category/{{{ $value->id }}}">Edit</a>
                    <a href="category/delete/{{ $value->id }}">Delete</a>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    <br>
    <form action="category/create" method="get">
        <label for="name">Enter category name: </label>
        <input type="text" name="name" id="name" required>
        <input type="submit" value="Add category">
    </form>
</div>
@endsection