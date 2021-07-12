@if ($paginator->hasPages())

<nav class="flex flex-row items-center justify-between my-5 flex-nowrap md:justify-center" aria-label="Pagination">
    @if ($paginator->onFirstPage())

    @else
    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev"
        class="flex items-center justify-center w-10 h-10 mr-1 text-black bg-white border border-gray-200 rounded-full hover:border-gray-300">
        <svg class="block w-4 h-4 fill-current" viewBox="0 0 256 512" aria-hidden="true" role="presentation">
            <path
                d="M238.475 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L50.053 256 245.546 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L10.454 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z">
            </path>
        </svg>
    </button>
    @endif

    @for ($page = 1; $page <= $paginator->lastPage(); $page++)
        @if ($page == $paginator->currentPage())

        <a class="items-center justify-center hidden w-10 h-10 mx-1 text-white bg-black border border-black rounded-full pointer-events-none md:flex"
            href="#" aria-current="page">
            {{ $page }}
        </a>

        @else
        <button wire:click="gotoPage({{$page}})" wire:loading.attr="disabled" rel="next"
            class="items-center justify-center hidden w-10 h-10 mx-1 text-black bg-white border border-gray-200 rounded-full md:flex hover:border-gray-300">
            {{ $page }}
        </button>
        @endif

        @endfor

        @if ($paginator->hasMorePages())
        <button wire:click="nextPage" wire:loading.attr="disabled" rel="next"
            class="flex items-center justify-center w-10 h-10 ml-1 text-black bg-white border border-gray-200 rounded-full hover:border-gray-300">
            <svg class="block w-4 h-4 fill-current" viewBox="0 0 256 512" aria-hidden="true" role="presentation">
                <path
                    d="M17.525 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L205.947 256 10.454 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L34.495 36.465c-4.686-4.687-12.284-4.687-16.97 0z">
                </path>
            </svg>
        </button>
        @else
        @endif
</nav>
@endif
