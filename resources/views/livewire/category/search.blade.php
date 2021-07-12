<div>
    @can('view-admin', auth()->user())
    <div class="pl-4 my-4">

        <div x-data="{ showModal : false }">
            <!-- Button -->
            <button @click="showModal = !showModal"
                class="px-5 py-2 text-sm font-semibold tracking-wider text-white bg-gray-900 rounded-full shadow-sm hover:bg-gray-800">Add
                Category
            </button>
            <!-- Modal Background -->
            <div x-show="showModal" style="display: none"
                class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto text-gray-500 bg-black bg-opacity-50"
                x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <!-- Modal -->
                <div x-show="showModal" class="max-w-3xl p-6 mx-10 bg-white shadow-2xl rounded-xl sm:w-11/12"
                    @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform"
                    x-transition:enter-start="opacity-0 scale-90 translate-y-1"
                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                    x-transition:leave="transition ease duration-100 transform"
                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                    x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                    <!-- Title -->
                    <form method="POST" action="{{ route('category.store') }}">
                        @csrf
                        @honeypot

                        <h3>Name</h3>
                        <input type="text" name="name" required value="{{ old('name') }}"
                            class="w-full p-2 mb-4 border border-gray-400 outline-none"
                            placeholder="people will use this to become better ...">

                        <h3>Description</h3>
                        <textarea type="text" name="description" required
                            class="w-full p-2 mb-4 border border-gray-400 outline-none" placeholder="Description"
                            cols="40" rows="5">{{ old('description') }}</textarea>

                        <div class="flex buttons">
                            <button
                                class="p-1 px-4 ml-2 font-semibold text-gray-200 bg-indigo-500 border border-indigo-500 cursor-pointer btn">
                                Create
                            </button>
                        </div>
                    </form>
                    <button @click="showModal = !showModal"
                        class="float-right px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-100 focus:text-indigo">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <div class="m-4">
        <label for="search" class="sr-only">Search</label>
        <input type="search" class="p-3 border-0 rounded shadow bg-purple-white" wire:model.debounce.200ms="search"
            name="search" placeholder="Search">
    </div>
    <div class="flex flex-wrap">
        @forelse ($categories as $category)
        <div class="p-2 xl:w-1/3 md:w-1/2">
            <div
                class="p-5 text-gray-700 transition duration-500 ease-in-out transform bg-white shadow-md hover:bg-gray-200 hover:-translate-y-1 hover:scale-10 rounded-3xl">
                <a class="mb-2 text-xl" href="{{ route('category.show', $category) }}">
                    {{ $category->name }}
                </a>
                <div class="text-md">
                    <a href="{{ route('category.show', $category) }}">
                        {{ $category->description }}
                    </a>
                </div>
                <div class="flex justify-end mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p>{{ $category->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
        @empty
        <p class="p-5 m-5 font-bold text-white bg-purple-400 rounded shadow-lg">No Category Founded</p>
        @endforelse
    </div>
    <x-Links-component :paginator=$categories />
</div>
