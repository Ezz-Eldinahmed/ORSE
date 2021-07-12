<div>
    <div class="flex flex-col my-2 sm:flex-row">
        <div class="relative block">
            <span class="absolute inset-y-0 left-0 flex items-center h-full pl-2">
                <svg viewBox="0 0 24 24" class="w-4 h-4 text-gray-500 fill-current">
                    <path
                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                    </path>
                </svg>
            </span>
            <input placeholder="Search" wire:model.debounce.200ms="search" type="search"
                class="block w-full py-2 pl-8 pr-6 text-sm text-gray-700 placeholder-gray-400 bg-white border border-b border-gray-400 rounded-l rounded-r appearance-none sm:rounded-l-none focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
        </div>
    </div>

    <div class="grid gap-3 md:grid-cols-3 sm:grid-cols-1 lg:grid-cols-3">
        @forelse ($peoples as $people)
            <div class="m-2 border shadow-xl card hover:shadow-none">
                <div class="flex m-3">
                    <img class="p-1 bg-white rounded-full w-28 h-28"
                        src="{{ $people->image ? $people->image : '/user_sm.jpg' }}" alt="avatar" />
                    <div class="ml-3 font-bold mt-11">
                        <p class="">{{ $people->name }}</p>
                        <p class="text-sm font-semibold">{{ $people->email }}</p>
                    </div>
                </div>
                <div class="ml-3">
                    @livewire('social.follow',['user' => $people],key($people->id))
                </div>
                <div class="flex justify-end mb-4 mr-4 text-xs font-bold text-gray-500">
                    <a href="{{ route('profile', $people) }}"
                        class="p-1 px-4 border border-gray-300 rounded-r-sm add rounded-l-2xl hover:bg-gray-700 hover:text-white">
                        Profile
                    </a>
                </div>
            </div>
        @empty
            <p class="p-5 m-5 font-bold text-white bg-pink-400 rounded-md shadow-lg">No People Founded
            </p>
        @endforelse
        <x-Links-component :paginator=$peoples />

    </div>
</div>
