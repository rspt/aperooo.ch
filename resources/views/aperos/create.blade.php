@extends('layouts.main')

@section('content')
    <h1>{{ __('site.create_aperos') }}</h1>

    <form action="{{ route('aperos.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="start" class="form-label">{{ __('aperos.start') }}</label>
            <input type="datetime-local" class="form-control" id="start" name="start" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">{{ __('aperos.address') }}</label>
            <input type="string" class="form-control" id="address" name="address" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('site.create_aperos') }}</button>
    </form>
@endsection
