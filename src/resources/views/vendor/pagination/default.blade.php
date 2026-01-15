@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pager__item pager__item--disabled" aria-disabled="true">
                    <span class="pager__link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="pager__item">
                    <a class="pager__link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="前へ">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pager__item pager__item--disabled" aria-disabled="true">
                        <span class="pager__link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pager__item pager__item--active" aria-current="page">
                                <span class="pager__link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pager__item">
                                <a class="pager__link" href="{{ $url }}" aria-label="ページ {{ $page }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pager__item">
                    <a class="pager__link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="次へ">&rsaquo;</a>
                </li>
            @else
                <li class="pager__item pager__item--disabled" aria-disabled="true">
                    <span class="pager__link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
