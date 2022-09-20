@extends('master', ['title' => 'Categories'])
@section('content')
<div>
    <div>
        <h1>Categories</h1>
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
            @foreach($category as $key => $value)
            <tr>
                <th scope="row">{{ $value->id }}</th>
                <td><a href="{{ url('category/' . $value->id ) }}">{{ $value->name }}</a></td>
                <td>
                    <a href="{{ url('category/' . $value->id) }}" class="btn btn-success">View</a>
                    <a href="{{ url('category/' . $value->id . '/edit') }}" class="btn btn-primary">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection