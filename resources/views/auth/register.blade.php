@extends('layouts.main')

@section('content')
    <h1>Create account</h1>

    <form class="" action="{{ route('auth.createAccount') }}" method="post">
        @csrf
        Username: <input type="text" name="username" value="" required>
        <br>
        Password: <input type="password" name="password" value="" required>
        <br>
        <button type="submit" name="button">Create</button>
    </form>
@endsection
