@extends('layouts.main')

@section('content')
    <h1>{{ __('site.home') }}</h1>

    <ul>
        @foreach ($aperos as $apero)
            <li>
                <a href="{{ route('aperos.show', $apero) }}">
                    {{ $apero->host->username }} - {{ $apero->start }} - {{ $apero->address }}
                </a>
            </li>
        @endforeach
    </ul>
@endsection
