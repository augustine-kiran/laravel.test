@extends('master', ['title' => 'List Blogs'])
@section('content')
<div>
    <div>
        <h1>All blogs</h1>
    </div>
    <div>
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>ID #</th>
                </tr>
            </thead>
        </table>
    </div>
</div>






<script>
    $(document).ready(function() {
        $('#table_id').DataTable({
            ajax: "{{ url('blog') }}",
        });
    });
</script>
@endsection