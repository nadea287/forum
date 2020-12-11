@if ($paginator->hasPages())
    <div class="pagination-wrapper">
{{--        <nav>--}}
            {{--        <ul class="pagination">--}}
            <ul class="pagination-section">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    {{--                <li class="pagination-page-number disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
                    <li class="pagination-page-number disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="pagination-link" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="pagination-page-number">
                        <a class="pagination-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="pagination-page-number disabled" aria-disabled="true"><span class="pagination-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="pagination-page-number pagination-active" aria-current="page"><span class="pagination-link">{{ $page }}</span></li>
                            @else
                                <li class="pagination-page-number"><a class="pagination-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="pagination-page-number">
                        <a class="pagination-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                    </li>
                @else
                    <li class="pagination-page-number disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="pagination-link" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
{{--        </nav>--}}

    </div>
@endif
