@extends('master', ['title' => 'List Blogs'])
@section('content')
<div>
    <div>
        <h1>All blogs</h1>
    </div>
    <div>
        <table id="datatable" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Comments Count</th>
                    <th>Tags</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Comments Count</th>
                    <th>Tag</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#datatable tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });
        $('#datatable').DataTable({
            ajax: "{{ url('blog') }}",
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