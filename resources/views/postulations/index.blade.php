@extends('layouts.main')

@section('content')
    <h1>{{ __('postulations.aperoSubmitted') }}</h1>

    
    <ul>
        @foreach ($aperoWanted as $apero)
            <li>
                <a href="{{ route('aperos.show', $apero) }}">{{ $apero->address }} - {{ $apero->start }}</a>
            </li>
        @endforeach
    </ul>
@endsection