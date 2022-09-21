@extends('master', ['title' => 'Tag Details'])
@section('content')
<div>
    <h3>Tag Details</h3>
</div>
<form action="{{ url('tags/' . $tag->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="form-group">
        <p>Tag Name: {{ $tag->name }}</p>
    </div>
    <button type="submit" class="btn btn-primary">Delete Tag</button>
</form>
@endsection