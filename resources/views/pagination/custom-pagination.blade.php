@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="block py-2 px-3 text-gray-400 bg-white border border-gray-300 rounded-sm" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="block py-2 px-3 bg-green-300 rounded-sm hover:bg-green-400" aria-label="{{ __('pagination.previous') }}">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Page Links --}}
        <div class="flex">
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="block py-2 px-3 bg-green-500 text-white rounded-sm">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="block py-2 px-3 bg-green-300 rounded-sm hover:bg-green-400">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="block py-2 px-3 bg-green-300 rounded-sm hover:bg-green-400" aria-label="{{ __('pagination.next') }}">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="block py-2 px-3 text-gray-400 bg-white border border-gray-300 rounded-sm" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
