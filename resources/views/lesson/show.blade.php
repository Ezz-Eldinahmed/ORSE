@extends('layouts.guest')
@section('content')

    <x-header-component message="Lesson" header="{!! $lesson->name !!}" />

    <div class="overflow-x-hidden bg-gray-100">

        <x-show-alert />

        @can('viewCourse', $lesson->course)
            @livewire('video.create' ,['lesson' => $lesson])
        @endcan

        <div class="grid gap-4 m-5 my-5 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3">
            <div class="col-span-2">
                @livewire('lesson.update',['lesson' => $lesson])
                @if ($lesson->videos->count() > 0)
                    <p class="w-4/12 p-3 my-3 font-bold text-white bg-green-400 rounded-md shadow-lg">All Videos Of This
                        Lesson
                    </p>
                @endif
                <div class="grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-2">
                    @forelse ($lesson->videos as $video)
                        <div
                            class="px-4 py-4 mx-1 my-2 transition duration-500 ease-in-out transform bg-white rounded-lg shadow-lg shadow-xl hover:bg-gray-200 hover:-translate-y-1 hover:scale-10">
                            <div>
                                <a href="{{ route('video.show', $video) }}">
                                    <h2 class="text-2xl font-semibold text-gray-800">{{ $video->name }}</h2>
                                    <p class="text-lg text-gray-600">{{ $video->description }}</p>
                                </a>
                            </div>
                            <div class="flex justify-end">
                                <a href="#" class="text-sm font-medium text-indigo-500">Added
                                    {{ $video->created_at->diffForHumans() }}</a>

                                <p class="ml-2 text-sm font-medium text-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <span class="ml-2 text-indigo-500">
                                        {{ $video->seens()->count() }}
                                    </span>
                                </p>
                            </div>
                            <a href="{{ route('instructor.show', $lesson->course->instructor) }}">
                                <b>By : </b>{{ $lesson->course->instructor->user->name }}
                            </a>
                        </div>
                    @empty
                        <p class="p-4 m-3 font-bold text-white bg-purple-400 shadow-lg">This Lesson Have No Videos Yet</p>
                    @endforelse
                </div>
                @auth
                    @livewire('lesson.comment',['lesson' => $lesson])
                @endauth

            </div>
            <div>
                <x-side-bar />
            </div>
        </div>
    </div>
@endsection
