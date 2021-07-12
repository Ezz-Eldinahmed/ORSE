@extends('layouts.guest')
@section('content')

<x-header-component message="Course" header="{!! $course->name !!}" />

<div class="overflow-x-hidden bg-gray-100">

    <x-show-alert />

    @can('viewCourse', $course)
    <div x-data="{ showModal : false }">
        <!-- Button -->
        <button @click="showModal = !showModal"
            class="px-4 py-2 ml-2 text-lg font-bold text-white bg-green-400 rounded-lg shadow-md">Add
            Lesson
        </button>

        <!-- Modal Background -->
        <div x-show="showModal"
            class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto text-gray-500 bg-black bg-opacity-50"
            x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <!-- Modal -->
            <div x-show="showModal" class="max-w-3xl p-6 mx-10 bg-white shadow-2xl rounded-xl sm:w-10/12"
                @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform"
                x-transition:enter-start="opacity-0 scale-90 translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease duration-100 transform"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-90 translate-y-1">

                <form method="POST" action="{{ route('lesson.store', $course) }}">
                    @csrf
                    @honeypot
                    <div class="grid gap-4 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-2">
                        <input type="text" name="name" required value="{{ old('name') }}"
                            class="p-2 border border-gray-400 rounded outline-none" placeholder="Make it specific">

                        <textarea class="p-2 border border-gray-400 rounded outline-none" required name="description"
                            placeholder="Description" value="{{ old('description') }}"
                            rows="3">{{ old('description') }}</textarea>
                        <!-- buttons -->
                        <div class="flex buttons">
                            <button
                                class="p-1 px-4 ml-2 font-semibold text-gray-200 bg-indigo-500 border border-indigo-500 rounded cursor-pointer btn">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
                <button @click="showModal = !showModal"
                    class="float-right px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-100 focus:text-indigo">Cancel</button>
            </div>
        </div>
    </div>
    @endcan

    <div class="grid gap-4 m-5 my-5 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3">
        <div class="col-span-2">
            @livewire('course.rate',['course' => $course])

            @if ($course->lessons->count() > 0)
            <p class="w-4/12 p-5 mt-5 font-bold text-white bg-green-400 rounded-md shadow-lg">All Lesson Of This
                Course
            </p>
            @endif

            @forelse ($course->lessons as $lesson)
            <div class="px-8 py-4 my-5 bg-white rounded-lg shadow-lg">
                <div>
                    <a href="{{ route('lesson.show', $lesson) }}">
                        <h2 class="text-2xl font-semibold text-blue-800">{{ $lesson->name }}</h2>
                        <p class="mt-2 text-gray-600">{{ $lesson->description }}</p>
                    </a>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="#" class="font-medium text-indigo-500 text-md">Added
                        {{ $lesson->created_at->diffForHumans() }}</a>
                    <p class="mx-2 text-sm font-medium text-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span class="ml-2 text-indigo-500">
                            {{ $lesson->seens()->count() }}
                        </span>
                    </p>
                </div>
                <span>By</span><a href="{{ route('instructor.show', $course->instructor) }}">
                    {{ $course->instructor->user->name }}</a>
            </div>

            @empty
            <p class="p-2 m-3 font-bold text-white bg-purple-400 shadow-lg">This Course Have No Lesson Yet</p>
            @endforelse

            @auth
            @livewire('course.comment',['course' => $course])
            @endauth

        </div>
        <div>
            <x-course-exam :course=$course />
            <x-side-bar />
        </div>
    </div>
</div>
@endsection
