@extends('layouts.app')
@section('content')
    <style>
        video::-internal-media-controls-download-button {
            display: none;
        }

        video::-webkit-media-controls-enclosure {
            overflow: hidden;
        }

        video::-webkit-media-controls-panel {
            width: calc(100% + 30px);
        }

    </style>
    <x-header-component message="Video" header="{{ $video->name }}" />

    <div class="overflow-x-hidden bg-gray-100">

        <x-show-alert />

        <div class="overflow-hidden bg-white shadow-none">
            <div class="grid gap-2 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3">
                <div class="w-full col-span-2">
                    <video controls controlsList="nodownload" id="noContextMenu">
                        @csrf
                        <source src="/storage/videos/{{ $video->path }}">
                    </video>
                </div>

                <div class="relative col-span-1 pl-4">
                    <header class="border-b border-grey-400">
                        <a href="{{ route('instructor.show', $video->lesson->instructor) }}"
                            class="flex items-center block py-4 text-sm transition duration-150 ease-in-out outline-none cursor-pointer focus:outline-none focus:border-gray-300">
                            <img alt="avatar" class="mr-4 rounded-full shadow-lg"
                                src="{{ $video->lesson->instructor->user->image ? $video->lesson->instructor->user->image : '/user_10.jpg' }}">
                            <p class="block ml-2 font-bold">{{ $video->lesson->instructor->user->name }}
                            </p>
                        </a>
                    </header>

                    <div>
                        @livewire('video.comment',['video' => $video])
                    </div>

                    <div class="m-2">
                        <p class="mx-2 text-sm font-medium text-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
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
                        <span class="block float-right text-xs text-gray-600">{{ $video->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <p class="p-5 mt-2 font-semibold text-white bg-indigo-400 shadow-lg">{{ $video->description }}</p>

        <div class="grid gap-2 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3">
            @forelse ($video->lesson->videos as $video)
                @livewire('video.update',['video'=> $video])
            @empty
                <p class="p-5 mt-5 font-bold text-white bg-purple-400 shadow-lg">This Lesson Have No Videos Yet</p>
            @endforelse
        </div>
    </div>

    <script>
        const noContext = document.getElementById('noContextMenu');
        noContext.addEventListener('contextmenu', e => {
            e.preventDefault();
        });
    </script>
@endsection
