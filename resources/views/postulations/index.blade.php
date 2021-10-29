@extends('layouts.main')

@section('content')
    <h1>{{ __('postulations.aperoSubmitted') }}</h1>

    <h2>{{ __('postulations.aperoOpen') }}</h2>
    @include('postulations.list', ['aperos' => $aperos['open']])

    <h2>{{ __('postulations.aperoCancelled') }}</h2>
    @include('postulations.list', ['aperos' => $aperos['cancelled']])
@endsection
