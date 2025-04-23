@php
    $setprefix = '';

    if (isset($prefix) && $prefix == 'account.') {
        $setprefix = 'account/';
    } elseif (isset($prefix) && $prefix == 'mentor.') {
        $setprefix = 'mentor/';
    } else {
        $setprefix = '';
    }
@endphp
@if ($paginator->hasPages())
    <ul class="pagination d-flex justify-content-center pt-4">
        @if ($paginator->onFirstPage())
        {{-- <li class="paginate_button page-item First disabled"><span class="page-link">First</span></li> --}}
        {{-- Hide the Prev button when on the first page --}}
        {{-- <li class="paginate_button page-item prev disabled"><span class="page-link">Prev</span></li> --}}
    @else
        {{-- <li class="paginate_button First page-item"><a href="{{ $paginator->url(1) }}" class="page-link">First</a></li> --}}
        <li class="paginate_button prev page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Prev</a></li>
    @endif
        @if ($paginator->lastPage() > 1)
            @if ($paginator->currentPage() > 2)
                <li class="paginate_button page-item"><a href="{{ $paginator->url(1) }}" class="page-link">1</a></li>
            @endif

            @if ($paginator->currentPage() > 3)
                <li class="paginate_button page-item"><span class="page-link">...</span></li>
            @endif

            @foreach(range(max(1, $paginator->currentPage() - 1), min($paginator->currentPage() + 1, $paginator->lastPage())) as $page)
                @if ($page == $paginator->currentPage())
                    <li class="paginate_button page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="paginate_button page-item"><a href="{{ $paginator->url($page) }}" class="page-link">{{ $page }}</a></li>
                @endif
            @endforeach

            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                <li class="paginate_button page-item"><span class="page-link">...</span></li>
            @endif

            @if ($paginator->currentPage() < $paginator->lastPage() - 1)
                <li class="paginate_button page-item"><a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">{{ $paginator->lastPage() }}</a></li>
            @endif
        @endif

        @if ($paginator->hasMorePages())
            <li class="paginate_button next page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
            {{-- <li class="paginate_button Last page-item"><a href="{{ $paginator->url($paginator->lastPage()) }}" class="page-link">Last</a></li> --}}
        @else
            {{-- <li class="paginate_button next page-item disabled"><span class="page-link">Next</span></li> --}}
            {{-- <li class="paginate_button Last page-item disabled"><span class="page-link">Last</span></li> --}}
        @endif
    </ul>
@endif




