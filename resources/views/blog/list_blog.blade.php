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
                        <select class="form-control selectpicker" name="categories[]" id="category" multiple>
                            @foreach($categories as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-check-label" for="tag">Tags</label>
                        <select class="form-control" name="tag[]" id="tags" multiple>
                            @foreach($tags as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> <br>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-check-label" for="comments_count">Comments Count</label>
                        <input type="number" class="form-control" id="comments_count" placeholder="Comments Count">
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
            searching: false,
            ajax: {
                cache: false,
                url: "{{ url('get_blog_list') }}",
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
            $("#category option:selected").prop("selected", false);
            $("#tag option:selected").prop("selected", false);
            $('#comments_count').val('');
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