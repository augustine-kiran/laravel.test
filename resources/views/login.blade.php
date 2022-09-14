@extends('master')
@section('title')
<title>Login</title>
@endsection
@section('content')
<h1>Login (Guest)</h1>
<form action="home">
    <label for="username">Username:</label>
    <input id="username" name="username" type="text" autofocus required>
    <input type="submit" value="Go">
</form>
@endsection