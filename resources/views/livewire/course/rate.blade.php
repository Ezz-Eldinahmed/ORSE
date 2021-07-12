<div>
    <style>
        .rating {
            display: inline-block;
            position: relative;
            height: 10px;
            line-height: 10px;
            font-size: 30px;
        }

        .rating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
        }

        .rating label:last-child {
            position: static;
        }

        .rating label:nth-child(1) {
            z-index: 5;
        }

        .rating label:nth-child(2) {
            z-index: 4;
        }

        .rating label:nth-child(3) {
            z-index: 3;
        }

        .rating label:nth-child(4) {
            z-index: 2;
        }

        .rating label:nth-child(5) {
            z-index: 1;
        }

        .rating label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .rating label .icon {
            float: left;
            color: transparent;
        }

        .rating label:last-child .icon {
            color: rgb(14, 2, 2);
        }

        .rating:not(:hover) label input:checked~.icon,
        .rating:hover label:hover input~.icon {
            color: rgb(255, 238, 0);
        }

        .rating label input:focus:not(:checked)~.icon:last-child {
            color: #000;
            text-shadow: 0 0 5px #09f;
        }
    </style>

    <div class="px-8 py-4 bg-white rounded-lg shadow-lg">
        <div>
            <h2 class="text-2xl font-semibold text-gray-800">{{$course->name}}</h2>
            <p class="mt-2 text-lg text-gray-600">{{$course->description}}</p>
        </div>
        <div class="flex mt-3">
            <div class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                        clip-rule="evenodd" />
                </svg>
                <p class="ml-1">{{$course->price == 0 ? 'Free' : $course->price }}</p>
            </div>
            <div class="mx-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <p class="mx-2">{{$course->valueRate() == 0 ? '-' : $course->valueRate() / $course->rates->count() }}
                </p>
            </div>
            <div class="mx-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                        clip-rule="evenodd" />
                </svg>
                <p class="mx-1">
                    {{ $course->rates->count() }}
                </p>
            </div>
        </div>
        <div class="flex mt-2">
            <div class="mr-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path
                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                </svg>
                <p>{{$course->presentation }}</p>
            </div>
            <div class="mx-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.933 12.8a1 1 0 000-1.6L6.6 7.2A1 1 0 005 8v8a1 1 0 001.6.8l5.333-4zM19.933 12.8a1 1 0 000-1.6l-5.333-4A1 1 0 0013 8v8a1 1 0 001.6.8l5.333-4z" />
                </svg>
                <p>{{$course->speed }}</p>
            </div>
            <div class="mx-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <p>{{$course->assignments }}</p>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <p>By <a href="{{route('instructor.show',$course->instructor)}}">
                    {{$course->instructor->user->name}}</a></p>
            <a href="#" class="mx-3 font-medium text-indigo-500 text-md">Added
                {{$course->created_at->diffForHumans()}}</a>
            <p class="mx-2 text-sm font-medium text-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span class="ml-2 text-indigo-500">
                    {{$course->seens()->count()}}
                </span>
            </p>

            @can('viewCourse', $course)
            @include('components.editmodelup')
            <form method="POST" wire:submit.prevent="edit">
                @csrf
                @honeypot
                <div class="grid gap-4 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-2">
                    <div>
                        <h4>Name</h4>
                        <input type="text" wire:model.lazy="name" required
                            class="w-full p-2 border border-gray-400 rounded outline-none"
                            placeholder="Make it specific">
                    </div>
                    <div>
                        <h4>Presentation</h4>
                        <select wire:model="presentation"
                            class="w-full p-2 mb-2 border border-gray-400 rounded outline-none">
                            <option selected value="Slides">Slides</option>
                            <option value="FreeHand">Freehand Digital Illustration</option>
                            <option value="Talking">Talking</option>
                        </select>
                    </div>
                    <div>
                        <h4>Speed</h4>
                        <select wire:model="speed" class="w-full p-2 mb-2 border border-gray-400 rounded outline-none">
                            <option value="Slow" selected>Slow</option>
                            <option value="Normal">Normal</option>
                            <option value="Fast">Fast</option>
                        </select>
                    </div>
                    <div>
                        <h4>Requested Price</h4>
                        <input type="number" placeholder="Requested Price" wire:model.lazy="price" required
                            class="w-full p-2 mb-2 border border-gray-400 rounded outline-none">
                    </div>
                    <textarea class="p-2 mb-2 border border-gray-400 rounded outline-none" wire:model.lazy="description"
                        required placeholder="Description" rows="3"></textarea>

                    <div class="flex flex-row">
                        With Assignments
                        <label class="inline-flex items-center mx-3">
                            <input type="radio" wire:model.lazy="assignments" value="on"
                                {{$course->assignments == 'on' ? "checked" : ''}}
                                class="w-5 h-5 text-blue-600 form-radio" checked>
                            <span class="ml-2 text-gray-700">on</span>
                        </label>

                        <label class="inline-flex items-center mx-3">
                            <input type="radio" wire:model.lazy="assignments" value="off"
                                {{$course->assignments == 'off' ? "checked" : ''}}
                                class="w-5 h-5 text-red-600 form-radio">
                            <span class="ml-2 text-gray-700">off</span>
                        </label>
                    </div>

                    <!-- buttons -->
                    <div class="flex buttons">
                        <button
                            class="p-1 px-4 ml-2 font-semibold text-gray-200 bg-indigo-500 border border-indigo-500 cursor-pointer btn">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
            <button @click="showModal = !showModal"
                class="float-right px-4 py-2 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancel
            </button>
            @include('components.editmodeldown')
            <div class="ml-3">
                <x-delete-model message="Are You Sure You Want Delete This Course And All Related Lessons?" />
            </div>
            @endcan
        </div>

        @can('rateCourse',$course)

        <form class="my-4 rating" method="POST">
            @csrf
            @honeypot

            <label>
                <input type="radio" wire:click.prevent="rate(1)" value="1" />
                <span class="icon">★</span>
            </label>
            <label>
                <input type="radio" wire:click.prevent="rate(2)" value="2" />
                <span class="icon">★</span>
                <span class="icon">★</span>
            </label>
            <label>
                <input type="radio" wire:click.prevent="rate(3)" value="3" />
                <span class="icon">★</span>
                <span class="icon">★</span>
                <span class="icon">★</span>
            </label>
            <label>
                <input type="radio" wire:click.prevent="rate(4)" value="4" />
                <span class="icon">★</span>
                <span class="icon">★</span>
                <span class="icon">★</span>
                <span class="icon">★</span>
            </label>
            <label>
                <input type="radio" wire:click.prevent="rate(5)" value="5" />
                <span class="icon">★</span>
                <span class="icon">★</span>
                <span class="icon">★</span>
                <span class="icon">★</span>
                <span class="icon">★</span>
            </label>
        </form>
        @endcan
        @auth

        @can('joinCourse',$course)
        <form method="POST" action="{{route('course.join',$course)}}">
            @csrf
            @honeypot

            <button class="px-4 py-2 text-lg font-bold text-white bg-purple-400 rounded-lg shadow-md">
                Join
            </button>
        </form>
        @endcan

        @endauth
        @guest
        <form method="POST" action="{{route('course.join',$course)}}">
            @csrf
            @honeypot

            <button class="px-4 py-2 text-lg font-bold text-white bg-purple-400 rounded-lg shadow-md">
                Join
            </button>
        </form>
        @endguest
    </div>
</div>
