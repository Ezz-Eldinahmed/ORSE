<div>
    <x-jet-dropdown align="right" class="w-50">
        <x-slot name="trigger">
            <span class="text-sm font-medium text-gray-500">Instructor</span>
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
                @if ($categoriesApproved->count() == 0)
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __("You haven't Approved In any Category") }}
                </div>
                @else
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Categories Your Approved In') }}
                </div>
                @endif
                @forelse ($categoriesApproved as $category )
                <x-jet-dropdown-link href="{{ route('category.show', $category) }}">{{ __($category->name) }}
                </x-jet-dropdown-link>
                @empty

                @endforelse

                @if ($categoriesRequested->count() > 0)
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Your Requestes Pending') }}
                </div>
                @endif
                @forelse ($categoriesRequested as $category )
                <x-jet-dropdown-link href="{{ route('category.show', $category) }}">{{ __($category->name) }}
                </x-jet-dropdown-link>
                @empty

                @endforelse

                @if ($mades->count() == 0)
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __("You Didn't Upload Any Courses") }}
                </div>
                @else
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Courses You Upload') }}
                </div>
                @endif
                @forelse ($mades as $made )
                <x-jet-dropdown-link href="{{ route('course.show', $made) }}">{{ __($made->name) }}
                    {{ $made->approved ? 'approved' : 'pending' }}
                </x-jet-dropdown-link>
                @empty

                @endforelse

            </div>
            <x-jet-dropdown-link href="{{ route('instructor.create') }}" class="font-bold text-pink-500">Join New
                Categroy
            </x-jet-dropdown-link>
        </x-slot>
    </x-jet-dropdown>
</div>
