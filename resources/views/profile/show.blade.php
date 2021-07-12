@extends('layouts.app')

@section('content')

<div class="flex justify-center mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8">
    <img src="{{($user->image ? $user->image : '/user_sm.jpg')}}" class="object-cover w-40 h-40 rounded-full"
        alt="username" />
    <div class="ml-10">
        <div class="flex items-center">
            <h2 class="block text-3xl font-light leading-relaxed text-gray-700">{{$user->name}}</h2>
        </div>
        <ul class="flex items-center justify-content-around">
            <li>
                <span class="flex block text-base"><span class="mr-2 font-bold">{{auth()->user()->posts->count()}}
                    </span> Posts</span>
            </li>
            <li>
                <span class="flex block ml-5 text-base cursor-pointer"><span
                        class="mr-2 font-bold">{{auth()->user()->follows->count()}} </span>
                    Followed</span>
            </li>
        </ul>
        <div class="">
            <span class="text-base">{{$user->email}}</span>
        </div>
    </div>
</div>


@if (auth()->user()->certifications->count() > 0)
<p class="w-2/12 p-3 mx-3 font-bold text-white bg-teal-400 rounded-md shadow-lg">Certifications</p>

<div class="grid gap-4 my-5 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3">

    @forelse (auth()->user()->certifications->where('status','pass') as $certification )
    <div
        class="p-3 p-5 overflow-hidden transition duration-500 ease-in-out transform bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-200 hover:-translate-y-1 hover:scale-10">
        Course
        <a href="{{route('certification.show',$certification)}}">
            {{$certification->course->name}}
        </a>

        <p>Grade
            {{$certification->grade}} </p>

    </div>
    @empty

    @endforelse
</div>
@endif

@if (auth()->user()->courses->count()>0)
<p class="w-2/12 p-3 mx-3 font-bold text-white bg-teal-400 rounded-md shadow-lg">Courses You Joined</p>
<div class="grid gap-4 my-5 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3">
    @forelse (auth()->user()->courses as $course )
    <div
        class="p-3 p-5 overflow-hidden transition duration-500 ease-in-out transform bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-200 hover:-translate-y-1 hover:scale-10">
        <a href="{{route('course.show',$course)}}">
            {{$course->name}}
        </a>
        <p>{{$course->category->name}}</p>
    </div>
    @empty

    @endforelse
</div>
@endif

@if (auth()->user()->instructor != null)
@if (auth()->user()->instructor->categories()->where('approved',1)->count()>0)
<p class="w-2/12 p-3 mx-3 font-bold text-white bg-teal-400 rounded-md shadow-lg">Categories You Approved In</p>
<div class="grid gap-4 my-5 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3">
    @forelse (auth()->user()->instructor->categories()->where('approved',1)->get() as $category )
    <div
        class="p-3 p-5 overflow-hidden transition duration-500 ease-in-out transform bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-200 hover:-translate-y-1 hover:scale-10">
        <a href="{{route('category.show',$category)}}">
            {{$category->name}}
        </a>
    </div>
    @empty

    @endforelse
</div>
@endif
@endif

@if (auth()->user()->interviewer != null)

@if (auth()->user()->interviewer->categories()->where('approved',1)->count() > 0)
<p class="w-2/12 p-3 mx-3 font-bold text-white bg-teal-400 rounded-md shadow-lg">Categories You Are Interviewer Into</p>
<div class="grid gap-4 my-5 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3">
    @forelse (auth()->user()->interviewer->categories()->where('approved',1)->get() as $category)
    <div
        class="p-3 p-5 overflow-hidden transition duration-500 ease-in-out transform bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-200 hover:-translate-y-1 hover:scale-10">
        <a href="{{route('category.show',$category)}}">
            {{$category->name}}
        </a>
    </div>
    @empty

    @endforelse
</div>
@endif
@endif

<x-jet-section-border />

<div class="px-8 bg-white rounded-lg">
    <p class="text-2xl font-semibold text-gray-800">People You Follow</p>
    <div class="flex justify-start mt-2">

        <div class="grid gap-2 md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-5">

            @forelse (auth()->user()->follows->take(10) as $following)
            <div
                class="transition duration-500 ease-in-out transform bg-white border border-gray-200 rounded-lg shadow-lg hover:bg-gray-200 hover:-translate-y-1 hover:scale-10">
                <img class="object-cover object-center m-2"
                    src="{{($following->image ? $user->image : '/user_sm.jpg')}}" width="" alt="avatar">
                <div class="px-6 py-4">
                    <h1 class="text-2xl font-semibold text-gray-800">{{$following->name}}</h1>
                    <div class="flex items-center mt-4 text-gray-700">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 512 512">
                            <path
                                d="M437.332 80H74.668C51.199 80 32 99.198 32 122.667v266.666C32 412.802 51.199 432 74.668 432h362.664C460.801 432 480 412.802 480 389.333V122.667C480 99.198 460.801 80 437.332 80zM432 170.667L256 288 80 170.667V128l176 117.333L432 128v42.667z" />
                        </svg>
                        <h1 class="px-2 text-sm">{{$following->email}}</h1>
                    </div>
                    @livewire('social.follow',['user' => $following])
                </div>
            </div>
            @empty
            <p>You Aren't Following Anyone Yet</p>
            @endforelse
        </div>
    </div>
</div>

<x-jet-section-border />

<div class="py-10 mx-auto max-w-7xl sm:px-6 lg:px-8">
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
    @livewire('profile.update-profile-information-form')

    <x-jet-section-border />
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
    <div class="mt-10 sm:mt-0">
        @livewire('profile.update-password-form')
    </div>

    <x-jet-section-border />
    @endif

    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
    <div class="mt-10 sm:mt-0">
        @livewire('profile.two-factor-authentication-form')
    </div>

    <x-jet-section-border />
    @endif

    <div class="mt-10 sm:mt-0">
        @livewire('profile.logout-other-browser-sessions-form')
    </div>

    <x-jet-section-border />

    <div class="mt-10 sm:mt-0">
        @livewire('profile.delete-user-form')
    </div>
</div>
@endsection
