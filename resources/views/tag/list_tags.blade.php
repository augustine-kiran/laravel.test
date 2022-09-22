@extends('master', ['title' => 'Tags'])
@section('content')
<div>
    <div>
        <h1>Tags</h1>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $key => $value)
            <tr>
                <th scope="row">{{ $value->id }}</th>
                <td><a href="{{ url('tags/' . $value->id ) }}">{{ $value->name }}</a></td>
                <td>
                    <a href="{{ url('tags/' . $value->id) }}" class="btn btn-success">View</a>
                    <a href="{{ url('tags/' . $value->id . '/edit') }}" class="btn btn-primary">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if(session('status'))
<script>
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
</script>
@endif
@endsection