@extends('master', ['title' => 'Tag Details'])
@section('content')
<div>
    <h3>Tag Details</h3>
</div>
<form action="{{ url('tags') }}" method="GET">
    <div class="form-group">
        <p>Tag Name: {{ $tag->name }}</p>
    </div>
    <button type="submit" class="btn btn-primary">Show all Tags</button>
</form>
@endsection