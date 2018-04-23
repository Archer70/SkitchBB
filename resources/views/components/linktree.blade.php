<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach ($items as $index => $item)
            @if (count($items) == $index+1) {{-- Last item --}}
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $item['title'] }}
                </li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $item['href'] }}">{{ $item['title'] }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>