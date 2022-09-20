@extends('master', ['title' => 'Login'])
@section('content')
<h1>Login</h1>

<form action="{{ url('login') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" maxlength="25" required>
        <label style="color: red;">{{ $errors->first('username') }}</label>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" maxlength="25" required>
        <label style="color: red;">{{ $errors->first('password') }}</label>
    </div>
    <button style="float: right;" type="submit" class="btn btn-primary">Submit</button>
</form>
<div>
    <p style="color: red;">{{ session('message') }}</p>
</div>
@endsection