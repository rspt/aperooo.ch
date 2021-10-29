<ul>
    @foreach ($aperos as $apero)
        <li>
            <a href="{{ route('aperos.show', $apero) }}">{{ $apero->address }} - {{ $apero->start }}</a>
        </li>
    @endforeach
</ul>
