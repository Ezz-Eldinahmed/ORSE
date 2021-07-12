@extends('layouts.app')
@section('content')

    <x-header-component message="Instructor : {{ $instructor->user->name }}" header="Instructor" />

    <div class="overflow-x-hidden bg-gray-100">

        <!-- defualt theme -->
        <div class="max-w-5xl w-full mx-auto z-10">
            <div class="flex flex-col">
                <div class="bg-white border border-white shadow-lg  rounded-3xl p-4 m-4">
                    <div class="flex-none sm:flex">
                        <div class=" relative h-32 w-32   sm:mb-0 mb-3">
                            <img src="{{ $instructor->user->image ? $instructor->user->image : '/user_10.jpg' }}"
                                alt="avatar" class=" w-32 h-32 object-cover rounded-2xl">

                        </div>
                        <div class="flex-auto sm:ml-5 justify-evenly">
                            <div class="flex items-center justify-between sm:mt-2">
                                <div class="flex items-center">
                                    <div class="flex flex-col">
                                        <div class="w-full flex-none text-lg text-gray-800 font-bold leading-none">
                                            {{ $instructor->user->name }}</div>
                                        <div class="flex-auto text-gray-500 my-1">
                                            </span><span>{{ $instructor->user->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-row items-center">
                                <div class="flex">
                                    @if ($instructor->rates != null)

                                        @if ($instructor->rates->count() > 0)
                                            @php
                                                $rate = $instructor->valueRate() / $instructor->rates->count();
                                            @endphp

                                            @if ($rate == 5)
                                                @for ($i = 0; $i < 5; $i++) <svg
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="h-5 w-5 text-yellow-500">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                @endfor

                                            @elseif ($rate <= 5 && $rate>= 4 )
                                                    @for ($i = 0; $i < 4; $i++) <svg
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="h-5 w-5 text-yellow-500">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                            </path>
                                                        </svg>
                                                    @endfor
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor" class="h-5 w-5 text-yellow-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                        </path>
                                                    </svg>
                                                @elseif ($rate < 4 && $rate>= 3 )
                                                        @for ($i = 0; $i < 3; $i++) <svg
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" class="h-5 w-5 text-yellow-500">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                </path>
                                                            </svg>
                                                        @endfor
                                                        @for ($i = 0; $i < 2; $i++) <svg
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor"
                                                                class="h-5 w-5 text-yellow-500">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                                </path>
                                                            </svg>
                                                        @endfor
                                                    @elseif ($rate <3 && $rate>= 2 )
                                                            @for ($i = 0; $i < 2; $i++)
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                    fill="currentColor" class="h-5 w-5 text-yellow-500">
                                                                    <path
                                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                    </path>
                                                                </svg>
                                                            @endfor
                                                            @for ($i = 0; $i < 3; $i++)
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor"
                                                                    class="h-5 w-5 text-yellow-500">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                                    </path>
                                                                </svg>
                                                            @endfor

                                                        @elseif ($rate < 2 && $rate>= 1 )
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                    fill="currentColor" class="h-5 w-5 text-yellow-500">
                                                                    <path
                                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                    </path>
                                                                </svg>
                                                                @for ($i = 0; $i < 4; $i++)
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor"
                                                                        class="h-5 w-5 text-yellow-500">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2"
                                                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                                        </path>
                                                                    </svg>
                                                                @endfor
                                                            @elseif ($rate == 0) <svg xmlns="http://www.w3.org/2000/svg"
                                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                                    class="h-5 w-5 text-yellow-500">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                                    </path>
                                                                </svg>

                                            @endif
                                        @endif
                                    @endif

                                </div>
                            </div>
                            <div class="flex pt-2  text-sm text-gray-500">
                                <div class="flex-1 inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                                        </path>
                                    </svg>
                                    <p class="">{{ $instructor->user->followers() }} Followers</p>
                                </div>
                                <div class="flex-1 inline-flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="">Joined : {{ $instructor->created_at->diffForHumans() }}</p>
                                </div>
                                @livewire('social.follow' ,['user' => $instructor->user])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 gap-3 rounded-lg">

            @forelse ($instructor->courses->where('approved',1) as $course)
                <div
                    class="max-w-md py-4 px-8 bg-white transition duration-500 ease-in-out bg-white hover:bg-gray-300 transform hover:-translate-y-1 hover:scale-10 shadow-xl rounded-lg mb-5">
                    <div>
                        <a href="{{ route('course.show', $course) }}">
                            <h2 class="text-gray-800 text-lg font-semibold">Course Name : {{ $course->name }}</h2>
                            <p class="mt-2 text-gray-600">Course Description : {{ $course->description }}</p>
                        </a>
                    </div>
                    <div class="flex justify-end mt-4">
                        <a href="#"
                            class="text-sm font-medium text-indigo-500">{{ $course->created_at->diffForHumans() }}</a>
                    </div>
                </div>
            @empty
                <p class="bg-pink-400 rounded-md font-bold text-white shadow-lg p-5 m-5">Instructor Have No Course Uploaded
                </p>
            @endforelse
        </div>

    </div>
@endsection
