@extends('master', ['title' => 'Tag Details'])
@section('content')
<div>
    <h3>Tag Details</h3>
</div>
<div>
    <div class="form-group">
        <p>Tag Name: {{ $tag->name }}</p>
    </div>
</div>
@endsection