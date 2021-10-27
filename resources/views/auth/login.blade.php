@extends('layouts.main')

@section('content')
    <h1>Login</h1>

    <form class="" action="{{ route('auth.authenticate') }}" method="post">
        @csrf
        Username: <input type="text" name="username" value="">
        <br>
        Password: <input type="password" name="password" value="" required>
        <br>
        <button type="submit" name="button">Login</button>
    </form>
@endsection
