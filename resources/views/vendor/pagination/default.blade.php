@if ($paginator->hasPages())
<div class="pagination">
    <ul>
        @foreach ($elements as $element)
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li><a class="active">{{ $page }}</a></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endforeach
    </ul>
</div>
@endif

