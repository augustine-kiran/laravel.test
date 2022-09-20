@extends('master', ['title' => 'Create User'])
@section('content')
<h1>Create Account</h1>
<form action="{{ url('user') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
        <div style="color: red;">
            {{ $errors->first('name') }}
        </div>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
        <div style="color: red;">
            {{ $errors->first('username') }}
        </div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
        <div style="color: red;">
            {{ $errors->first('password') }}
        </div>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
    </div>
    <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection