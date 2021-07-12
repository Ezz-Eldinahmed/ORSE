<div x-data="{ showModal : false }">
    <!-- Button -->
    <button @click="showModal = !showModal" class="font-medium text-indigo-500 text-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
    </button>
    <!-- Modal Background -->
    <div x-show="showModal"
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
            <x-show-alert />
