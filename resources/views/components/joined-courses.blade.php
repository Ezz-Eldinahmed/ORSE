<div>
    <x-jet-dropdown align="right" class="w-50">
        <x-slot name="trigger">
            <span class="text-sm font-medium text-gray-500">Joined</span>
            <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                class="inline w-4 h-4 mt-1 transition-transform duration-200 transform md:-mt-1">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd">
                </path>
            </svg>
        </x-slot>
        <x-slot name="content">
            <div class="overflow-y-scroll max-h-60">
                @if ($joined->count() == 0)
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __("You Didn't Joined Any Courses") }}
                </div>
                @endif
                @forelse ($joined as $join )
                <x-jet-dropdown-link href="{{ route('course.show',$join) }}">{{ __($join->name) }}
                </x-jet-dropdown-link>
                @empty

                @endforelse
            </div>
        </x-slot>
    </x-jet-dropdown>
</div>
