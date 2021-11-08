@extends('layouts.main')

@section('content')
    <h1>{{ __('site.edit_aperos') }}</h1>

    <form action="{{ route('aperos.update', $apero) }}" method="post">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="title" class="form-label">{{ __('aperos.title') }}</label>
            <input type="string" class="form-control" id="title" name="title" value="{{ $apero->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">{{ __('aperos.description') }}</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $apero->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="start" class="form-label">{{ __('aperos.start') }}</label>
            <input type="datetime-local" class="form-control" id="start" name="start" value="{{ $apero->startForm }}" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">{{ __('aperos.address') }}</label>
            <input type="string" class="form-control" id="address" name="address" value="{{ $apero->address }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('site.edit_aperos') }}</button>
    </form>
@endsection
