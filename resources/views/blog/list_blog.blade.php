@extends('master', ['title' => 'List Blogs'])
@section('content')
<div>
    <div>
        <h1>All blogs</h1>
    </div>
    <div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Search options</h5>
                <h6 class="card-subtitle mb-2 text-muted">Filter the table content with below options</h6>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-check-label" for="category">Categories</label>
                        <select class="form-control" name="category" id="category">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-check-label" for="tag">Tags</label>
                        <select class="form-control" name="tag" id="tag">
                            <option value="">-- Select Tag --</option>
                            @foreach($tags as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> <br>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-check-label" for="comments_count">Comments Count</label>
                        <select class="form-control" name="comments_count" id="comments_count">
                            <option value="">-- Select Comments Count --</option>
                            @foreach($commentsCounts as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" id="reset" class="btn btn-info col-md-2 offset-md-1">Reset</button> &nbsp;
                    <button type="button" id="search" class="btn btn-primary col-md-2">Search</button>
                </div>
            </div>
        </div>
    </div> <br>
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
        </table>
    </div>
</div>

<script>
    var table;

    function getTable() {
        table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                cache: false,
                url: "{{ url('blog') }}",
                data: {
                    category: $('#category').val(),
                    tag: $('#tag').val(),
                    comments_count: $('#comments_count').val(),
                },
            },
        });
    }
    $(document).ready(function() {
        getTable();
        $("#search").click(function() {
            table.destroy();
            getTable();
        });

        $("#reset").click(function() {
            $('#category').prop('selectedIndex', 0);
            $('#tag').prop('selectedIndex', 0);
            $('#comments_count').prop('selectedIndex', 0);
            table.destroy();
            getTable();
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