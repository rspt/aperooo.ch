@extends('layouts.main')

@section('content')
    {{ $apero->host->username }} - {{ $apero->start }} - {{ $apero->address }}

    @can ('create', [App\Models\Postulation::class, $apero])
        <form action="{{ route('postulations.store', $apero) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-success">{{ __('postulations.apply') }}</button>
        </form>
    @endcan

    <ul>
        @foreach ($apero->postulants as $postulant)
            <li>
                {{ $postulant->postulation }}

                @can ('cancel', $postulant->postulation)
                    <form action="{{ route('postulations.cancel', [$apero, $postulant->postulation]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-warning">{{ __('postulations.cancel') }}</button>
                    </form>
                @endcan
            </li>
        @endforeach
    </ul>

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
