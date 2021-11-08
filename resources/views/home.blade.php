@extends('layouts.main')

@section('content')
    <h1>{{ __('site.home') }}</h1>

    <ul>
        @foreach ($aperos as $apero)
            <li>
                <a href="{{ route('aperos.show', $apero) }}">
                    {{ $apero->title }}
                </a>
                <p>
                    {{ $apero->host->username }}
                    <br>
                    {{ $apero->start }}
                    @if ($apero->displayAddress)
                        <br>
                        {{ $apero->address }}
                    @endif
                </p>
            </li>
        @endforeach
    </ul>
@endsection
