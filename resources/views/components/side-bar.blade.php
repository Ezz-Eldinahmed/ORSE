<div class="-mx-8 flex hidden sm:block">
    <div class="px-8">
        @if (Request::url() != route('question.index'))
            <div class="mt-4">
                <a class="text-xl" href="{{ route('question.index') }}">
                    <div
                        class="flex flex-row px-6 py-4 mb-2 font-bold text-white rounded-lg shadow-md transition duration-500 ease-in-out bg-white hover:bg-teal-300 transform hover:-translate-y-1 hover:scale-10 p-5 bg-teal-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mt-1 h-7 w-7" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="ml-3">
                            Add Question
                        </p>
                    </div>
                </a>
            </div>
        @endif

        <h1 class="mb-2 text-xl font-bold text-gray-700">Top 5 Rated Instructors</h1>
        <div class="flex flex-col max-w-sm px-6 py-4 mx-auto bg-white rounded-lg shadow-md">
            <ul class="-mx-4">
                @forelse ($instructors_sidebar as $instructor)
                    <li class="grid grid-cols-5">
                        <div class="col-span-3 flex">
                            <img src="{{ $instructor->user->image ? $instructor->user->image : '/user_10.jpg' }}"
                                alt="avatar" class="object-cover rounded-full">
                            <div class="flex flex-col text-sm text-gray-700 ">
                                <a href="{{ route('instructor.show', $instructor) }}"
                                    class="mx-2 font-bold text-gray-700 hover:underline">{{ $instructor->user->name }}</a>
                                <div class="flex flex-row items-center">
                                    <div class="flex mx-2">
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
                                                        @for ($i = 0; $i < 4; $i++)
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" class="h-5 w-5 text-yellow-500">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                </path>
                                                            </svg>
                                                        @endfor
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor"
                                                            class="h-5 w-5 text-yellow-500">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                            </path>
                                                        </svg>
                                                    @elseif ($rate < 4 && $rate>= 3 )
                                                            @for ($i = 0; $i < 3; $i++)
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    class="h-5 w-5 text-yellow-500">
                                                                    <path
                                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                    </path>
                                                                </svg>
                                                            @endfor
                                                            @for ($i = 0; $i < 2; $i++)
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
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
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 20 20" fill="currentColor"
                                                                        class="h-5 w-5 text-yellow-500">
                                                                        <path
                                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                        </path>
                                                                    </svg>
                                                                @endfor
                                                                @for ($i = 0; $i < 3; $i++)
                                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor"
                                                                        class="h-5 w-5 text-yellow-500">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                                        </path>
                                                                    </svg>
                                                                @endfor

                                                            @elseif ($rate < 2 && $rate>= 1 )
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 20 20" fill="currentColor"
                                                                        class="h-5 w-5 text-yellow-500">
                                                                        <path
                                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                        </path>
                                                                    </svg>
                                                                    @for ($i = 0; $i < 4; $i++)
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            fill="none" viewBox="0 0 24 24"
                                                                            stroke="currentColor"
                                                                            class="h-5 w-5 text-yellow-500">
                                                                            <path stroke-linecap="round"
                                                                                stroke-linejoin="round" stroke-width="2"
                                                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                                            </path>
                                                                        </svg>
                                                                    @endfor
                                                                @elseif ($rate == 0) <svg
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke="currentColor"
                                                                        class="h-5 w-5 text-yellow-500">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                                                        </path>
                                                                    </svg>

                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                </div>

                                <span class="ml-2">
                                    Courses Created : {{ $instructor->courses->count() }}
                                </span>
                            </div>
                        </div>
                        @auth
                            <div>
                                @livewire('social.follow' ,['user' => $instructor->user])
                            </div>
                        @endauth
                    </li>
                @empty

                @endforelse
            </ul>
        </div>
    </div>
    <div class="px-8 mt-4">
        <h1 class="mb-4 text-xl font-bold text-gray-700">Categories</h1>
        <div class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white rounded-lg shadow-md">
            <ul>
                @forelse ($categories_sidebar as $category)
                    <li>
                        <a href="{{ route('category.show', $category) }}"
                            class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">-
                            {{ $category->name }}
                        </a>
                    </li>
                @empty

                @endforelse

            </ul>
        </div>
    </div>
    <h1 class="px-8 mt-4 text-xl font-bold text-gray-700">Recent Questions</h1>

    @forelse ($questions_sidebar as $question)
        <div class="px-8 mt-4">
            <div class="flex flex-col max-w-sm px-8 py-6 mx-auto bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-center"><a
                        href="{{ route('category.show', $question->category) }}"
                        class="px-2 py-1 text-sm text-green-100 bg-gray-600 rounded hover:bg-gray-500">{{ $question->category->name }}</a>
                </div>
                <div class="mt-4"><a href="{{ route('question.show', $question) }}"
                        class="text-lg font-medium text-gray-700 hover:underline">{{ $question->question }}</a></div>
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center">
                        <img src="{{ $question->user->image ? $question->user->image : '/user_10.jpg' }}"
                            alt="avatar" class="object-cover rounded-full"><a href="#"
                            class="mx-3 text-sm text-gray-700 hover:underline">{{ $question->user->name }}</a>
                    </div><span
                        class="text-sm font-light text-gray-600">{{ $question->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

    @empty

    @endforelse
</div>
