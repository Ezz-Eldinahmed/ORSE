<div class="mt-5 px-2 py-2 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
        @for ($page = 1; $page <= $paginator->lastPage(); $page++)
            @if ($page == $paginator->currentPage())
            <li
                class="relative inline-flex items-center px-4 py-2 border border-blue-500 bg-gray-200 text-lg text-gray-900 hover:bg-gray-400">
                <span>{{ $page }}</span></li>
            @else
            <a href="{{ $paginator->url($page) }}"
                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-lg text-gray-700 hover:bg-gray-50">
                {{ $page }}
            </a>
            @endif
            @endfor
    </nav>
</div>
