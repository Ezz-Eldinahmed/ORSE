@extends('layouts.app')

@section('content')

    <div class="flex flex-row flex-wrap p-3 bg-white">
        <div class="w-2/3 mx-auto">
            <!-- Profile Card -->
            <div class="flex flex-row flex-wrap w-full p-3 antialiased bg-gray-600 rounded-lg shadow-lg" style="
            background-image: url('https://languajob.com/wp-content/uploads/2018/05/HeaderImage-1.jpg');
            background-repeat: no-repat;
            background-size: cover;
            background-blend-mode: multiply;">
                <div class="w-full md:w-1/3">
                    <img class="antialiased shadow-lg rounded-xl"
                        src="{{ $user->image ? $user->image : 'https://www.pngitem.com/pimgs/m/80-800194_transparent-users-icon-png-flat-user-icon-png.png' }}">
                </div>
                <div class="flex flex-row flex-wrap w-full px-3 md:w-2/3">
                    <div class="relative w-full pt-3 font-semibold text-right text-gray-700 md:pt-0">
                        <div class="text-2xl leading-tight text-white">{{ $user->name }}</div>
                        <div class="text-gray-300 text-normal hover:text-gray-400"><span
                                class="pb-1 border-b border-gray-500 border-dashed">{{ $user->email }}</span></div>
                        <div class="bottom-0 right-0 pt-3 text-sm text-gray-300 hover:text-gray-400 md:absolute md:pt-0">
                            @livewire('social.follow',['user' => $user])
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Profile Card -->
        </div>
    </div>
    <div class="px-8 py-4 bg-white rounded-lg shadow-lg">
        <p class="text-2xl font-semibold text-gray-800">People {{ $user->name }} Follow</p>
        <div class="grid gap-2 md:grid-cols-4 sm:grid-cols-3 lg:grid-cols-5">
            @forelse ($user->follows->take(10) as $following)
                <div class="max-w-sm my-4 overflow-hidden bg-white rounded-lg shadow-lg">
                    <img class="object-cover object-center" src="{{ $following->image ? $user->image : '/user_sm.jpg' }}"
                        width="" alt="avatar">
                    <div class="px-6 py-4">
                        <a href="{{ route('profile', $following) }}">
                            <h1 class="text-2xl font-semibold text-gray-800">{{ $following->name }}</h1>
                            <div class="flex items-center mt-4 text-gray-700">
                                <svg class="w-6 h-6 fill-current" viewBox="0 0 512 512">
                                    <path
                                        d="M437.332 80H74.668C51.199 80 32 99.198 32 122.667v266.666C32 412.802 51.199 432 74.668 432h362.664C460.801 432 480 412.802 480 389.333V122.667C480 99.198 460.801 80 437.332 80zM432 170.667L256 288 80 170.667V128l176 117.333L432 128v42.667z" />
                                </svg>
                                <h1 class="px-2 text-sm">{{ $following->email }}
                                </h1>
                            </div>
                        </a>

                        @livewire('social.follow',['user' => $following] ,key($following->id))
                    </div>
                </div>
            @empty
                <p class="p-4 m-3 font-bold bg-gray-300 shadow-lg">{{ $user->name }} Aren't Following Anyone Yet</p>
            @endforelse
        </div>

        @forelse ($user->posts as $post)
            <section class="flex items-center justify-center px-4 bg-white">
                <div class="w-full p-4 rounded-lg shadow-lg">
                    <h3 class="text-lg font-semibold tracking-wide">{{ $post->title }}</h3>
                    <p class="my-1 text-gray-600">{{ $post->body }}</p>
                    <div class="mt-2 text-right">
                        <p class="my-1 text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </section>
        @empty
        @endforelse
    </div>
@endsection

