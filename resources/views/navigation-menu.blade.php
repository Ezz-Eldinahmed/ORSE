<div class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
    <div x-data="{ open: false }"
        class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
        <div class="flex flex-row items-center justify-between p-4">
            <a href="{{ url('/') }}">
                <div class="flex">
                    <x-jet-application-mark class="block w-auto" />
                    <p class="mt-3 ml-4">ORSE</p>
                </div>
            </a>
            <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <path x-show="!open" fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                    <path x-show="open" fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        @livewire('home-page-search')

        <nav :class="{'flex': open, 'hidden': !open}"
            class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
            <x-jet-nav-link href="{{ route('home') }}" class="mt-1 mr-3" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-jet-nav-link>

            <div class="mx-2 mt-4">
                @livewire('notification')
            </div>

            <div class="relative mx-3 mt-3 cursor-pointer">
                <x-joined-courses />
            </div>

            <x-jet-nav-link href="{{ route('timeline') }}" class="mt-1 mr-3" :active="request()->routeIs('timeline')">
                {{ __('Timeline') }}
            </x-jet-nav-link>

            <x-jet-nav-link href="{{ route('people') }}" class="mt-1" :active="request()->routeIs('people')">
                {{ __('People') }}
            </x-jet-nav-link>

            @if (auth()->user()->instructor != null)
            <div class="relative mx-3 mt-3 cursor-pointer">
                <x-instructor-courses />
            </div>
            @endif

            <div class="relative mt-3 mr-3 cursor-pointer">

                <x-jet-dropdown align="right" class="text-semibold" width="48">
                    <x-slot name="trigger">
                        <span class="text-sm font-medium text-gray-500">Learn</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                            class="inline w-4 h-4 mt-1 transition-transform duration-200 transform md:-mt-1">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                    </x-slot>

                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('course.index') }}">{{ __('Courses') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('question.index') }}">{{ __('Questions') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('instructor.create') }}">{{ __('Join Us') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('recommendation') }}">{{ __('Recommend Path') }}
                        </x-jet-dropdown-link>
                    </x-slot>
                </x-jet-dropdown>
            </div>

            <div class="relative mt-3 cursor-pointer">

                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <span class="text-sm font-medium text-gray-500">Categories</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                            class="inline w-4 h-4 mt-1 transition-transform duration-200 transform md:-mt-1">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-sm text-gray-400">
                            <a href="{{ route('category.index') }}" class="font-semibold text-blue-500">Show ALL
                                Categories
                            </a>
                        </div>

                        @forelse (\App\Models\Category::orderBy('id', 'desc')->take(5)->get() as $category )
                        <x-jet-dropdown-link href="{{ route('category.show', $category) }}">
                            {{ $category->name }}
                        </x-jet-dropdown-link>
                        @empty
                        @endforelse
                    </x-slot>
                </x-jet-dropdown>
            </div>

            <div class="sm:items-center sm:ml-6">

                <!-- Settings Dropdown -->
                <div class="relative mt-2">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                <img class="object-cover w-8 h-8 rounded-full"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                    {{ Auth::user()->name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @can('view-interviewer', auth()->user())
                            <x-jet-dropdown-link href="{{ route('instructor.index') }}">{{ __('Dashboard') }}
                            </x-jet-dropdown-link>
                            @endcan

                            <div class="border-t border-gray-100"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full py-2 pl-4 text-sm text-left bg-gray-100">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>
        </nav>
    </div>
</div>
