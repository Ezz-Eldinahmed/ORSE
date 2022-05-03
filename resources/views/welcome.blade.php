@extends('layouts.guest')

@section('content')
<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('ORSE') }}
    </h2>
</x-slot>

<div class="pb-20 overflow-auto bg-gradient-to-br from-teal-600 to-green-400">
    <div class="container max-w-5xl px-4 mx-auto">
        <div class="w-4/5">
            <h1 class="mt-10 text-6xl font-bold text-white">Welcome To ORSE<br /><span class="text-teal-300">Learning
                    planet.</span></h1>
        </div>
        <div class="w-5/6 my-10 ml-6">
            <h3 class="text-gray-300">
                “Successful and unsuccessful people do not vary greatly in their
                abilities.”<br />
                <strong class="text-white">
                    They vary in their desires to reach their potential.</strong>
                <br />
            </h3>
        </div>
        <div class="z-0 hidden opacity-50 sm:block">
            <div class="rounded-full shadow-2xl w-96 h-96 -mt-72"></div>
            <div class="rounded-full shadow-xl w-96 h-96 -mt-96"></div>
            <div class="ml-8 rounded-full shadow-2xl w-80 h-80 -mt-96"></div>
        </div>
        <div class="relative text-white">
            <h3 class="font-semibold text-uppercase">Features</h3>
            <div class="grid gap-1 uppercase sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 sm:gap-5">
                <a href="#courses">
                    <div
                        class="flex items-center gap-5 px-6 py-5 mt-5 bg-teal-400 rounded-lg shadow-xl group hover:bg-teal-600 bg-opacity-40 ring-2 ring-offset-2 ring-offset-blue-800 ring-cyan-700">

                        <img src="/images/rsz_mortarboard.png" alt="course" />
                        <span>Courses</span>
                        <span class="block text-xs text-blue-300">{{ $course_approved }}</span>
                    </div>
                </a>
                <a href="{{ route('question.index') }}">
                    <div
                        class="flex items-center gap-5 px-6 py-5 mt-5 bg-teal-400 rounded-lg shadow-xl group hover:bg-teal-600 bg-opacity-40 ring-2 ring-offset-2 ring-offset-blue-800 ring-cyan-700">
                        <img src="/images/ezgifcom-gif-maker 1.jpg" alt="question" />
                        <div>
                            <span>Questions</span>
                            <span class="block text-xs text-blue-300">{{ $questions }}</span>
                        </div>
                    </div>
                </a>
                <div
                    class="flex items-center gap-5 px-6 py-5 mt-5 bg-teal-400 rounded-lg shadow-xl group hover:bg-teal-600 bg-opacity-40 ring-2 ring-offset-2 ring-offset-blue-800 ring-cyan-700">
                    <img src="/images/ezgifcom-gif-maker 2.jpg" alt="rate" />
                    <div>
                        <span>Rates</span>
                        <span class="block text-xs text-blue-300">{{ $rates }}</span>
                    </div>
                </div>
                <a href="#Categories">
                    <div
                        class="flex items-center gap-5 px-6 py-5 mt-5 bg-teal-400 rounded-lg shadow-xl group hover:bg-teal-600 bg-opacity-40 ring-2 ring-offset-2 ring-offset-blue-800 ring-cyan-700">
                        <img src="/images/ezgifcom-gif-maker.jpg" alt="category" />
                        <span>Categories</span>
                        <span class="block text-xs text-blue-300">{{ $categories_count }}</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="py-5">
    <div class="max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-2xl sm:rounded-lg">
            <section class="text-gray-200">
                <div class="px-5 pb-8 max-w-8xl">
                    <div class="flex flex-col flex-wrap items-center text-center">
                        <p
                            class="p-5 text-5xl font-bold text-gray-600 transition duration-500 ease-in-out transform bg-white hover:bg-blue-300 hover:-translate-y-1 hover:scale-10">
                            <a href="{{ route('category.index') }}">All Categories</a>
                        </p>
                        <p class="text-2xl text-gray-600">We Have Alot More To Learn </p>
                    </div>

                    <div class="flex flex-wrap mt-2" id="Categories">

                        @forelse ($categories as $category)
                        <div class="p-2 xl:w-1/3 md:w-1/2">
                            <div
                                class="p-6 transition duration-500 ease-in-out transform bg-white border border-gray-500 rounded-lg hover:bg-gray-200 hover:-translate-y-1 hover:scale-10">
                                <h2 class="mb-2 text-xl font-medium text-black title-font"><a
                                        href="{{ route('category.show', $category) }}" title="">{{ $category->name }}
                                </h2>
                                <p class="text-base leading-relaxed text-gray-600">{{ $category->description }}</p>
                                </a>

                                <div class="flex justify-between w-full mt-2 leading-none text-center">
                                    <span
                                        class="inline-flex items-center py-1 mr-3 text-sm leading-none text-gray-600 ">
                                        <svg class="w-4 h-4 mr-2 text-gray-500 fill-current "
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                            <path
                                                d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z" />
                                        </svg>
                                        {{ $category->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="p-5 m-5 font-bold text-white bg-pink-400 rounded-md shadow-lg">No Category Founded
                        </p>
                        @endforelse

                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<div class="flex flex-col flex-wrap items-center w-full text-center bg-gradient-to-r from-green-400 to-blue-500">
    <p class="px-10 py-20 text-4xl font-semibold text-white">“Learning is a treasure that will follow its owner
        everywhere"
    </p>
</div>

<div class="flex flex-col flex-wrap items-center w-full text-center">
    <p class="px-5 py-5 text-4xl font-semibold shadow-xl">Top Rated Course</p>
</div>

<div class="flex flex-wrap mt-2" id="courses">
    @forelse ($courses as $course)
    <div class="p-2 xl:w-1/3 md:w-1/2">
        <div
            class="px-8 py-6 mb-5 transition duration-500 ease-in-out transform bg-white rounded-lg shadow-xl hover:bg-gray-200 hover:-translate-y-1 hover:scale-10 mt-14">
            <p class="text-xs text-left">{{ $course->created_at->diffForHumans() }}</p>
            <div class="flex justify-center -mt-16 md:justify-end">
                <img class="object-cover border-2 border-indigo-500 rounded-full"
                    src="{{ $course->instructor->user->image ? $course->instructor->user->image : '/user_sm.jpg' }}"
                    alt="avatar">
            </div>
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">
                    <a href="{{ route('course.show', $course) }}">{{ $course->name }}
                </h2>
                <p class="mt-2 text-xl text-gray-600">{{ $course->description }}</a></p>
            </div>
            <div class="mt-7">
                <a href="{{ route('instructor.show', $course['instructor']) }}" class="text-left text-indigo-500">By
                    {{ $course['instructor']->user->name }}</a>
                <p class="flex float-right text-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    {{ $course->users_count }}
                </p>
            </div>
            <div class="flex grid grid-cols-3 mt-4 text-sm">
                <div class="mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p>{{ $course->price == 0 ? 'Free' : $course->price }}</p>
                </div>
                <div class="mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    @if (isset($course->rate))
                    <p>{{ $course->rate->sum('rate') == 0 ? '-' : $course->rate->sum('rate') / $course->rates_count }}</p>
                    @else
                    <p>-</p>
                    @endif
                </div>
                <div class="mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path
                            d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                    </svg>
                    <p>{{ $course->presentation }}</p>
                </div>
                <div class="mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.933 12.8a1 1 0 000-1.6L6.6 7.2A1 1 0 005 8v8a1 1 0 001.6.8l5.333-4zM19.933 12.8a1 1 0 000-1.6l-5.333-4A1 1 0 0013 8v8a1 1 0 001.6.8l5.333-4z" />
                    </svg>
                    <p>{{ $course->speed }}</p>
                </div>
                <div class="mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <p>{{ $course->assignments }}</p>
                </div>
                <div class="mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <p class="ml-2">{{ $course->seens_count }}</p>
                </div>
            </div>
        </div>
    </div>

    @empty
    <p class="p-5 m-5 font-bold text-white bg-pink-400 rounded-md shadow-lg">No Courses Founded
    </p>
    @endforelse
</div>
@endsection
