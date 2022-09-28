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
                        <label class="form-check-label" for="categories">Categories</label>
                        <select class="form-control selectpicker" name="categories[]" id="categories" multiple>
                            @foreach($categories as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-check-label" for="tags">Tags</label>
                        <select class="form-control" name="tags[]" id="tags" multiple>
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
                    <!-- <button type="button" id="reset" class="btn btn-info col-md-2 offset-md-1">Reset</button> &nbsp;
                    <button type="button" id="search" class="btn btn-primary col-md-2">Search</button> -->
                </div>
            </div>
        </div>
    </div> <br>
    <div>
        <table id="datatable" class="display">
            <thead>
                <tr>
                    <th class="col-md-1">ID #</th>
                    <th class="col-md-2">Title</th>
                    <th class="col-md-2">Category</th>
                    <th class="col-md-1">Comments Count</th>
                    <th class="col-md-3">Tags</th>
                    <th class="col-md-2">Actions</th>
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
                    categories: $('#categories').val(),
                    tags: $('#tags').val(),
                    comments_count: $('#comments_count').val(),
                },
            },
        });
    }

    function reloadTable() {
        table.destroy();
        getTable();
    }

    $(document).ready(function() {
        getTable();
        $("#search").click(function() {
            reloadTable();
        });

        $("#reset").click(function() {
            $("#category option:selected").prop("selected", false);
            $("#tag option:selected").prop("selected", false);
            $('#comments_count').val('');
            table.destroy();
            getTable();
        });

        $('#categories').select2({
            placeholder: 'Select Categories',
            allowClear: true,
        });
        $('#tags').select2({
            placeholder: 'Select Tags',
            allowClear: true
        });

        $('#categories').on('change', function(e) {
            reloadTable();
        });

        $('#tags').on('change', function(e) {
            reloadTable();
        });

        $("#comments_count").on("keyup", function() {
            reloadTable();
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