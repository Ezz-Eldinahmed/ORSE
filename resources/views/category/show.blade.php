@extends('layouts.guest')
@section('content')

<x-header-component header="{{$category->name}}" message="Category" />
<div class="overflow-x-hidden bg-gray-100">

    @can('AddCourse', $category)

    <div x-data="{ showModal : false }">
        <!-- Button -->
        <button @click="showModal = !showModal"
            class="px-4 py-2 mt-2 ml-2 text-lg font-bold text-white bg-green-400 rounded-lg shadow-md">Add
            Course
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

                <form method="POST" action="{{route('course.store',$category)}}">
                    @csrf
                    @honeypot

                    <div class="grid grid-cols-2 gap-2">
                        <div>
                            <h4>Name</h4>
                            <input type="text" name="name" required value="{{old('name')}}"
                                class="w-full p-2 border border-gray-400 rounded outline-none"
                                placeholder="Make it specific">
                        </div>
                        <div>
                            <h4>Presentation</h4>
                            <select name="presentation"
                                class="w-full p-2 mb-2 border border-gray-400 rounded outline-none">
                                <option selected value="Slides">Slides</option>
                                <option value="FreeHand">Freehand Digital Illustration</option>
                                <option value="Talking">Talking</option>
                            </select>
                        </div>

                        <div>
                            <h4>Speed</h4>
                            <select name="speed" class="w-full p-2 mb-2 border border-gray-400 rounded outline-none">
                                <option value="Slow" selected>Slow</option>
                                <option value="Normal">Normal</option>
                                <option value="Fast">Fast</option>
                            </select>
                        </div>

                        <div>
                            <h4>Requested Price</h4>
                            <input type="number" placeholder="Requested Price" name="price" value="{{old('price')}}"
                                required class="w-full p-2 mb-2 border border-gray-400 rounded outline-none">
                        </div>

                        <textarea class="p-2 mb-2 border border-gray-400 rounded outline-none" required
                            name="description" placeholder="Description" value="{{old('description')}}"
                            rows="3">{{old('description')}}</textarea>

                        <div class="mt-2">
                            With Assignments
                            <label class="mx-3">
                                <input type="radio" name="assignments" value="on"
                                    class="w-5 h-5 text-blue-600 form-radio" checked>
                                <span class="ml-2 text-gray-700">on</span>
                            </label>

                            <label class="mx-3">
                                <input type="radio" name="assignments" value="off"
                                    class="w-5 h-5 text-red-600 form-radio">
                                <span class="ml-2 text-gray-700">off</span>
                            </label>
                        </div>

                        <!-- buttons -->
                        <div class="flex buttons">
                            <button
                                class="p-1 px-4 ml-2 font-semibold text-gray-200 bg-indigo-500 border border-indigo-500 cursor-pointer btn">
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

    <div class="grid gap-4 m-5 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3">
        <div class="col-span-2">
            <x-show-alert />

            @livewire('category.update',['category'=>$category])

            @if ($category->courses()->where('approved', 1)->get()->count() > 0)
            <p class="p-5 mt-5 font-bold text-white bg-green-400 rounded-md shadow-lg">All Courses Of This
                Category</p>
            @endif

            @forelse ($category->courses()->where('approved', 1)->with(['instructor'])->withCount('seens')->get() as
            $course)
            <div
                class="px-8 py-4 my-5 transition duration-500 ease-in-out transform bg-white rounded-lg shadow-lg hover:bg-gray-200 hover:-translate-y-1 hover:scale-10">
                <div>
                    <a href="{{route('course.show',$course)}}">
                        <h2 class="text-2xl font-semibold text-gray-800">{{$course->name}}</h2>
                        <p class="mt-2 text-gray-600">{{$course->description}}</p>
                    </a>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="#" class="font-medium text-indigo-500 text-md">Added
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
                            {{$course->seens_count}}
                        </span>
                    </p>
                </div>
                <a href="{{route('instructor.show',$course->instructor)}}">
                    <p> By : {{$course->instructor->user->name}}</p>
                </a>
            </div>

            @empty
            <p class="p-2 m-3 font-bold text-white bg-purple-400 shadow-lg">This Category Have No Courses Yet</p>
            @endforelse

        </div>
        <x-side-bar />
    </div>
</div>
@endsection
