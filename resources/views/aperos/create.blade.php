@extends('layouts.main')

@section('content')
    <h1>{{ __('site.createAperos') }}</h1>

    <form action="{{ route('aperos.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('aperos.title') }}</label>
            <input type="string" class="form-control" id="title" name="title" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">{{ __('aperos.description') }}</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="start" class="form-label">{{ __('aperos.start') }}</label>
            <input type="datetime-local" class="form-control" id="start" name="start" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">{{ __('aperos.address') }}</label>
            <input type="string" class="form-control" id="address" name="address" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('site.createAperos') }}</button>
    </form>
@endsection
