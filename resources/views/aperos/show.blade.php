@extends('layouts.main')

@section('content')
    <h2>{{ $apero->title }}</h2>
    <p>{!! nl2br(e($apero->description)) !!}</p>
    <p>
        {{ $apero->host->username }} - {{ $apero->start }}
        @if ($apero->displayAddress)
            - {{ $apero->address }}
        @endif
    </p>
    @if($apero->isCancelled)
        <p>{{ __('aperos.cancelled', ['username' => $apero->host->username]) }}</p>
    @endif
    @if (!$apero->isOpenForPostulation)
        <p>{{ __('postulations.closed') }}</p>
    @endif

    @can ('create', [App\Models\Postulation::class, $apero])
        <form action="{{ route('postulations.store', $apero) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="motivation" class="form-label">{{ __('postulations.motivation') }}</label>
                <textarea class="form-control" id="motivation" name="motivation" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">{{ __('postulations.apply') }}</button>
        </form>
    @endcan
    @if (Auth::user()->isHostOf($apero))
        <ul>
            @foreach ($apero->postulants as $postulant)
                <li>
                    <p>{{ $postulant->postulation->motivation }}</p>
                    <p>{{ __('postulations.status' . ucfirst($postulant->postulation->status), ['username' => $postulant->username]) }}
                    @if (!is_null($postulant->postulation->message_cancel))
                        {{ __('postulations.postulantCancel') }} "{{ $postulant->postulation->message_cancel }}"</p>
                    @endif
                    @can ('accept', [$postulant->postulation, $apero])
                        <form action="{{ route('postulations.accept', [$apero, $postulant->postulation]) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="message_accept" class="form-label">{{ __('postulations.messageAccept') }}</label>
                                <textarea class="form-control" id="message_accept" name="message" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">{{ __('postulations.accept') }}</button>
                        </form>
                    @endcan
                    @can ('decline', [$postulant->postulation, $apero])
                        <form action="{{ route('postulations.decline', [$apero, $postulant->postulation]) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="message_decline" class="form-label">{{ __('postulations.messageDecline') }}</label>
                                <textarea class="form-control" id="message_decline" name="message" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning">{{ __('postulations.decline') }}</button>
                        </form>
                    @endcan
                </li>
            @endforeach
        </ul>
    @else
        @if (Auth::user()->hasAlreadyPostulatedFor($apero))
            @php
                $postulation = Auth::user()->postulationFor($apero);
            @endphp
            @can ('cancel', $postulation)
                <form action="{{ route('postulations.cancel', [$apero, $postulation]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="message_cancel" class="form-label">{{ __('postulations.messageCancel') }}</label>
                        <textarea class="form-control" id="message_cancel" name="message_cancel" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning">{{ __('postulations.cancel') }}</button>
                </form>
            @endcan
            @can ('update', $postulation)
                <form action="{{ route('postulations.update', [$apero, $postulation]) }}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="motivation" class="form-label">{{ __('postulations.update') }}</label>
                        <textarea class="form-control" id="motivation" name="motivation" rows="3">{{ $postulation->motivation }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">{{ __('postulations.update') }}</button>
                </form>
            @endcan
            @if ($postulation->motivation)
                <p>{{ __('postulations.yourMotivation') }}</p>
                <p>"{{ $postulation->motivation }}"</p>
            @endif
            @if ($postulation->status === 'cancelled')
                <p>{{ __('postulations.cancelled') }}</p>
                @if ($postulation->message_cancel)
                    <p>{{ __('postulations.cancellationMessage') }} "{{ $postulation->message_cancel }}"</p>
                @endif
            @elseif ($postulation->status === 'declined')
                <p>{{ __('postulations.declined') }}</p>
            @elseif ($postulation->status === 'accepted')
                <p>{{ __('postulations.accepted') }}</p>
            @endif
            @if (!is_null($postulation->message) && $postulation->status !== 'cancelled')
                <p>{{ __('postulations.message') }}</p>
                <p>{{ $postulation->message }}</p>
            @endif
        @endif
    @endif
    @if (Auth::user()->isHostOf($apero))
        <hr>
        @can('update', $apero)
            <a href="{{ route('aperos.edit', $apero) }}" class="btn btn-primary">{{ __('site.edit') }}</a>
        @endcan
        @can('close', $apero)
            <form action="{{ route('aperos.close', $apero) }}" method="post">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-info">{{ __('site.close') }}</button>
            </form>
        @endcan
        @can('cancel', $apero)
            <form action="{{ route('aperos.cancel', $apero) }}" method="post">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-warning">{{ __('site.cancel') }}</button>
            </form>
        @endcan
        @can('delete', $apero)
            <form action="{{ route('aperos.destroy', $apero) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('site.delete') }}</button>
            </form>
        @endcan
    @endif
@endsection
