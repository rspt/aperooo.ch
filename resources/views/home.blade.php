@extends('layouts.main')

@section('content')
    @auth
        <h1>{{ __('site.home') }}</h1>
        
        <ul>
            @foreach ($aperos as $apero)
                <li>
                    <a href="{{ route('aperos.show', $apero) }}">
                        {{ $apero->host->username }} - {{ $apero->start }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <h1>Bienvenue à l'Apérooo</h1>
    @endauth
@endsection
