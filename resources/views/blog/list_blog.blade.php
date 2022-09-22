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
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Comments Count</th>
                    <th>Actions</th>
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

    @if(session('status'))
    @php
    $status = (session('status')['status']) ? 'success' : 'error';
    @endphp
    $(document).ready(function() {
        $.toast({
            type: "{{ $status }}",
            content: "{{ session('status')['message'] }}",
            delay: 5000
        });
    });
    @endif
</script>
@endsection