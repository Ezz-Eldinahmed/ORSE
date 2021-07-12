<div>
    <div x-data="{ showModal : false }">
        <!-- Button -->
        <button @click="showModal = !showModal" class="font-medium text-indigo-500 text-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>
        <!-- Modal Background -->
        <div x-show="showModal" style="display: none"
            class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto text-gray-500 bg-black bg-opacity-50"
            x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <!-- Modal -->
            <div x-show="showModal" class="max-w-3xl p-6 mx-10 bg-white rounded-lg shadow-2xl sm:w-10/12"
                @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform"
                x-transition:enter-start="opacity-0 scale-90 translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease duration-100 transform"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-90 translate-y-1">

                <p class="mb-3 text-lg font-semibold text-red-500">{{$message}}</p>

                <div class="flex justify-end">
                    <button @click="showModal = !showModal" wire:click.prevent="{{$method}}({{$deleted}})">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                    <button @click="showModal = !showModal"
                        class="float-right px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-100 focus:text-indigo">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
