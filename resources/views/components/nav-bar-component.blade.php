<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
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
            <x-jet-nav-link href="{{ route('home') }}" class="mr-3" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-jet-nav-link>
            <x-jet-nav-link href="{{ route('contact.create') }}" class="mx-3 my-3"
                :active="request()->routeIs('contact.create')">
                {{ __('Contact Us') }}
            </x-jet-nav-link>

            <div class="relative mx-3 mt-3 cursor-pointer">
                <x-jet-dropdown align="right" class="text-semibold" width="48">
                    <x-slot name="trigger">
                        {{ __('Learn') }}
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                            class="inline w-4 h-4 transition-transform duration-200 transform md:-mt-1">
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
                    </x-slot>
                </x-jet-dropdown>
            </div>

            <div class="relative mx-3 mt-3 cursor-pointer">

                <x-jet-dropdown align="right" class="text-semibold" width="48">
                    <x-slot name="trigger">
                        {{ __('Categories') }}
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}"
                            class="inline w-4 h-4 transition-transform duration-200 transform md:-mt-1">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-sm text-gray-400">
                            <a href="{{route('category.index')}}" class="font-semibold text-blue-500">Show ALL
                                Categories
                            </a>
                        </div>
                        @forelse ($categories_navbar as $category )
                        <x-jet-dropdown-link href="{{route('category.show',$category)}}">
                            {{$category->name}}
                        </x-jet-dropdown-link>
                        @empty
                        @endforelse
                    </x-slot>
                </x-jet-dropdown>
            </div>

            <div class="lg:hidden">
                <x-jet-nav-link href="{{ route('login') }}" class="mx-3 my-3">
                    {{ __('Login') }}
                </x-jet-nav-link>
            </div>

            <div class="lg:hidden">
                <x-jet-nav-link href="{{ route('register') }}" class="mx-3">
                    {{ __('Register') }}
                </x-jet-nav-link>
            </div>

            <div class="flex hidden sm:block lg:flex">
                <!-- Category Dropdown -->
                <div class="relative mt-2">
                    <x-jet-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button type="button"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                ORSE
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-jet-dropdown-link href="{{ route('login') }}">{{ __('Login') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('register') }}">{{ __('Register') }}
                            </x-jet-dropdown-link>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>
        </nav>
    </div>
</div>
