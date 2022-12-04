
@if ($paginator->hasPages())
<div class="pagination mt-5 d-flex justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <!-- <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">&lsaquo;</span>
                </li> -->
            <li class="page-item disabled" disabled="disabled"  aria-label="@lang('pagination.previous')"><span   class="page-link" >Previous</span></li>
            @else
            <li class="page-item "><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">Previous</a></li>

            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="page-item disabled"><a class="page-link" href="#">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}a
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())

            <li class="page-item active" aria-current="page"><a class="page-link" href="#">{{ $page }}</a></li>

            @else
            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>


            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"> Next</a>
            </li>
            @else
            <li class="page-item disabled" ><span class="page-link" aria-hidden="true">Next</span></li>
            @endif
        </ul>
    </nav>
</div>

@endif
