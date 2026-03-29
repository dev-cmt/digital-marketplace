@if ($paginator->hasPages())
    <nav class="pagination-container" aria-label="Page navigation">
        <ul class="pagination-pv">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-pv-item disabled" aria-disabled="true">
                    <span class="page-pv-link"><i class="fa-solid fa-chevron-left"></i></span>
                </li>
            @else
                <li class="page-pv-item">
                    <a class="page-pv-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa-solid fa-chevron-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-pv-item disabled" aria-disabled="true"><span class="page-pv-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-pv-item active" aria-current="page"><span class="page-pv-link">{{ $page }}</span></li>
                        @else
                            <li class="page-pv-item"><a class="page-pv-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-pv-item">
                    <a class="page-pv-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa-solid fa-chevron-right"></i></a>
                </li>
            @else
                <li class="page-pv-item disabled" aria-disabled="true">
                    <span class="page-pv-link"><i class="fa-solid fa-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<style>
.pagination-pv {
    display: flex;
    gap: 12px;
    list-style: none;
    padding: 0;
    margin: 0;
    justify-content: center;
    align-items: center;
}

.page-pv-item {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.page-pv-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 14px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    color: rgba(255, 255, 255, 0.6);
    font-weight: 700;
    font-size: 14px;
    text-decoration: none;
    transition: inherit;
    backdrop-filter: blur(4px);
}

.page-pv-item:not(.disabled):not(.active) .page-pv-link:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: var(--accent-1);
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.page-pv-item.active .page-pv-link {
    background: linear-gradient(135deg, var(--accent-1) 0%, #4facfe 100%);
    border-color: transparent;
    color: #fff;
    box-shadow: 0 8px 16px rgba(108, 99, 255, 0.3);
}

.page-pv-item.disabled .page-pv-link {
    opacity: 0.3;
    cursor: not-allowed;
}

@media (max-width: 480px) {
    .page-pv-link {
        width: 38px;
        height: 38px;
        font-size: 13px;
    }
    .pagination-pv { gap: 8px; }
}
</style>
