<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ORSE') }}</title>

    <link rel="icon" href="/images/logo_sm.png" type="image/png" sizes="16x16">

    <meta name="ORSE" content="E-learning Platform">
    <meta property="og:title" content="ORSE" />
    <meta property="og:type" content="Learning Platform Improve Your Ability" />
    <meta property="og:url" content="https://www.orse.herokuapp.com/" />
    <meta property="og:image" content="/images/logo_sm.png" />
    <meta name="description" content="E-Learning Platform">
    <meta name="keywords"
        content="Course,Study,Learning,E-Learning,Platform,Improve,orse,categories,free,learning,question,notification,welcome,ORSE,people,social">
    <meta name="author" content="ezzeldinahmed99@gmail.com">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles
    <style>
        html {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(13deg, #7bcfeb 14%, #e685d3 64%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(13deg, #c7ceff 14%, #f9d4ff 64%);
        }

        ::-webkit-scrollbar-track {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: inset 7px 10px 12px #f0f0f0;
        }
    </style>
</head>

<body>
    <div>
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
            <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
                class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

            <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
                class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
                <div class="flex items-center justify-center mt-8">
                    <div class="flex items-center">
                        <a href="{{route('home')}}">
                            <img src="/images/logo_sm.png" width="60px">
                            <span class="mx-2 text-2xl font-semibold text-white">Dashboard</span>
                        </a>
                    </div>
                </div>

                <nav class="mt-10">
                    @can('view-admin',auth()->user())

                    @if(Request::url() === route('dashboard'))
                    <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
                        href="{{route('dashboard')}}">
                        @else
                        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                            href="{{route('dashboard')}}">
                            @endif
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>

                            <span class="mx-3">Dashboard</span>
                        </a>

                        @if(Request::url() === route('interviewer.index'))
                        <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
                            href="{{route('interviewer.index')}}">
                            @else
                            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                                href="{{route('interviewer.index')}}">
                                @endif
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>

                                <span class="mx-3">InterViewers</span>
                            </a>

                            @if(Request::url() === route('admin.index'))
                            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
                                href="{{route('admin.index')}}">
                                @else
                                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                                    href="{{route('admin.index')}}">
                                    @endif <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span class="mx-3">Users</span>
                                </a>

                                @if(Request::url() === route('contact.index'))
                                <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
                                    href="{{route('contact.index')}}">
                                    @else
                                    <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                                        href="{{route('contact.index')}}">
                                        @endif <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>

                                        <span class="mx-3">Contact Us</span>
                                    </a>
                                    @endcan

                                    @if(Request::url() === route('course.list'))
                                    <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
                                        href="{{route('course.list')}}">
                                        @else
                                        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                                            href="{{route('course.list')}}">
                                            @endif
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                            </svg>

                                            <span class="mx-3">Courses</span>
                                        </a>

                                        @if(Request::url() === route('instructor.index'))
                                        <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
                                            href="{{route('instructor.index')}}">
                                            @else
                                            <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                                                href="{{route('instructor.index')}}">
                                                @endif
                                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <span class="mx-3">{{__('Instructors')}}</span>
                                            </a>

                                            @if(Request::url() === route('exam.index'))
                                            <a class="flex items-center px-6 py-2 mt-4 text-gray-100 bg-gray-700 bg-opacity-25"
                                                href="{{route('exam.index')}}">
                                                @else
                                                <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
                                                    href="{{route('exam.index')}}">
                                                    @endif
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path
                                                            d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                                    </svg>
                                                    <span class="mx-3">{{__('Exams')}}</span>
                                                </a>
                </nav>
            </div>
            <div class="flex flex-col flex-1 overflow-hidden">
                <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center">
                        <div class="mb-3 mr-3">
                            @livewire('notification')
                        </div>

                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button @click="dropdownOpen = ! dropdownOpen"
                                class="relative block overflow-hidden rounded-full shadow focus:outline-none">
                                <img class="rounded-full"
                                    src="{{(auth()->user()->image ? auth()->user()->image : '/user_40.jpg')}}"
                                    alt="avatar" />
                            </button>

                            <div x-show="dropdownOpen" @click="dropdownOpen = false"
                                class="fixed inset-0 z-10 w-full h-full" style="display: none;"></div>

                            <div x-show="dropdownOpen"
                                class="absolute right-0 z-10 w-48 mt-2 overflow-hidden bg-white rounded-md shadow-xl"
                                style="display: none;">
                                <a href="{{route('profile.show')}}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                                    {{ __('Profile') }}
                                </a>
                                <div class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="w-full text-left">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container px-6 py-3 mx-auto">
                        <h3 class="text-3xl font-medium text-gray-700">Dashboard</h3>
                        <div class="mt-2">
                            @yield('content')
                        </div>
                </main>
            </div>
        </div>
    </div>
    @stack('modals')

    @livewireScripts

    <script src="//unpkg.com/alpinejs" defer></script>

    <script src="{{ mix('js/app.js') }}" defer></script>

</body>

</html>
