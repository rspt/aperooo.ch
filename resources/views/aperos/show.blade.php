@extends('layouts.main')

@section('content')
    {{ $apero->host->username }} - {{ $apero->start }} - {{ $apero->address }}

    <form action="{{ route('postulations.store') }}" method="post">
        @csrf
        <input type="hidden" name="apero_id" value="{{ $apero->id }}">
        <button type="submit" class="btn btn-success">{{ __('postulations.apply') }}</button>
    </form>
    <form action="{{ route('postulations.cancel', $apero, Auth::user()) }}" method="post">
        @csrf
        
        <input type="hidden" name="apero_id" value="{{ $apero->id }}">
        <button type="submit" class="btn btn-warning">{{ __('postulations.cancel') }}</button>
    </form>

    @canany(['update', 'delete'], $apero)
        <hr>

        @can('update', $apero)
            <a href="{{ route('aperos.edit', $apero) }}" class="btn btn-primary">{{ __('site.edit') }}</a>
        @endcan

        @can('delete', $apero)
            <form action="{{ route('aperos.destroy', $apero) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('site.delete') }}</button>
            </form>
        @endcan
    @endcanany
@endsection
