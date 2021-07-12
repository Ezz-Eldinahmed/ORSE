<div class="mx-3">
    <x-jet-dropdown align="right" class="text-semibold">
        <x-slot name="trigger">
            <div class="relative">
                <input type="search" autocomplete="off"
                    class="p-1 pl-3 rounded border border-gray-100 bg-gray-200 focus:bg-white focus:outline-yellow-500 focus:ring-2 focus:ring-yellow-600 focus:border-transparent"
                    placeholder="Search..." name="search_navbar" wire:model.debounce.200ms="search_navbar" />
            </div>
        </x-slot>
        <x-slot name="content">
            @if ($categories->count() == 0 && $courses->count() == 0 && $users->count() == 0)
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('No Result Found') }}
            </div>
            @endif

            @if ($users->count() >0)
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Users') }}
            </div>
            @endif
            @forelse ($users as $user )
            <x-jet-dropdown-link href="{{ route('profile',$user) }}">{{ __($user->name) }}
            </x-jet-dropdown-link>
            @empty

            @endforelse

            @if ($categories->count() >0)
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Categories') }}
            </div>
            @endif
            @forelse ($categories as $category )
            <x-jet-dropdown-link href="{{ route('category.show',$category) }}">{{ __($category->name) }}
            </x-jet-dropdown-link>
            @empty

            @endforelse

            @if ($courses->count() >0)
            <div class="block px-4 py-2 text-xs text-gray-400">
                {{ __('Courses') }}
            </div>
            @endif
            @forelse ($courses as $course )
            <x-jet-dropdown-link href="{{ route('course.show',$course) }}">{{ __($course->name) }}
            </x-jet-dropdown-link>
            @empty

            @endforelse
        </x-slot>
    </x-jet-dropdown>
</div>
