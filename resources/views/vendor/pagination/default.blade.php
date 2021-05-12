@if ($paginator->hasPages())
    <div class="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="@lang('pagination.previous')" aria-hidden="true">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
               aria-label="@lang('pagination.previous')">&lsaquo;</a>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span aria-disabled="true">{{ $element }}</span>
            @endif


            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
{{--                    @if($loop->remaining >3)--}}
{{--                        @continue($loop->index > 6)--}}
{{--                    @endif--}}
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        @else
            <span aria-disabled="true" aria-label="@lang('pagination.next')" aria-hidden="true">&rsaquo;</span>
        @endif
    </div>
@endif
