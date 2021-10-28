@extends('layouts.main')

@section('content')
    <h1>{{ __('postulations.aperoSubmitted') }}</h1>

    <h2>{{ __('postulations.aperoOpen') }}</h2>
    <ul>
        @foreach ($aperoOpen as $apero)  
            <li>
                <a href="{{ route('aperos.show', $apero) }}">{{ $apero->address }} - {{ $apero->start }}</a>
            </li>
        @endforeach
    </ul>

    <h2>{{ __('postulations.aperoCancelled') }}</h2>
    <ul>
        @foreach ($aperoCancelled as $apero)  
            <li>
                <a href="{{ route('aperos.show', $apero) }}">{{ $apero->address }} - {{ $apero->start }}</a>
            </li>
        @endforeach
    </ul>
@endsection