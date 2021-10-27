@extends('layouts.main')

@section('content')
    <h1>{{ __('auth.login') }}</h1>

    <form action="{{ route('auth.authenticate') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="username" class="form-label">{{ __('auth.username') }}</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('auth.password') }}</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('auth.login') }}</button>
    </form>
@endsection
