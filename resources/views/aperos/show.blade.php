@extends('layouts.main')

@section('content')
    {{ $apero->host->username }} - {{ $apero->start }} - {{ $apero->address }}

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
