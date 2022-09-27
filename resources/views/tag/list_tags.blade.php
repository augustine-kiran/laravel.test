@extends('master', ['title' => 'Tags'])
@section('content')
<div>
    <div>
        <h1>Tags</h1>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col" class="col-md-2">ID #</th>
                <th scope="col" class="col-md-6">Name</th>
                <th scope="col" class="col-md-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tags as $key => $value)
            <tr>
                <th scope="row">{{ $value->id }}</th>
                <td><a href="{{ url('tags/' . $value->id ) }}">{{ $value->name }}</a></td>
                <td>
                    <div class="row">
                        <form><a href=" {{ url('tags/' . $value->id) }}" class="btn btn-success">View</a></form> &nbsp;
                        <form><a href="{{ url('tags/' . $value->id . '/edit') }}" class="btn btn-primary">Edit</a></form> &nbsp;
                        <form action="{{ url('tags/' . $value->id) }}" method="POST" onsubmit="return confirm('Do you want to delete?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
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