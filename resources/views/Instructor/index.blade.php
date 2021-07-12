@extends('layouts.dashboard')
@section('content')

<x-show-alert />

<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Instructor Name
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Instructor Email
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Rate
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Category
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Created at
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Created at
                    </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($instructors as $instructor)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <img class="rounded-full"
                                    src="{{($instructor->user->image ? $instructor->user->image : '/user_10.jpg')}}"
                                    alt="avatar" />
                            </div>
                            <div class="ml-3">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    <a href="{{route('instructor.show',$instructor)}}">{{$instructor->user->name}}</a>
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{$instructor->user->email}}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap">{{$instructor->valueRate() == 0 ? '-' : $instructor->valueRate() / $instructor->rates->count() }}
                        </p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="text-blue-500 whitespace-no-wrap">
                            @forelse($instructor->categories as $category)
                            <form method="POST"
                                onsubmit="return confirm('Do you really want to Delete Instructor from this category?');"
                                action="{{route('instructor_category.destroy',[$instructor,$category])}}">
                                @csrf
                                @method('DELETE')
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                            <li>
                                <a href="{{route('resume.show',[$instructor,$category])}}">Download the Resume</a>
                            </li>
                            <li>
                                <a href="/storage/{{$category->pivot->resume}}" target="_blank">Show the Resume</a>
                            </li>
                            <li>
                                <a href="{{route('category.show',$category)}}">{{($category->name)}}</a>
                            </li>
                            <li>Request : {{ ($category->pivot->approved ? 'Accepted' : 'Pending') }}</li>

                            <form method="POST" class="pt-2"
                                action="{{route('instructor.approve',[$instructor,$category])}}">
                                @csrf
                                @honeypot

                                <button class="transition duration-500 ease-in-out bg-white hover:bg-blue-700 transform hover:-translate-y-1 hover:scale-10 text-white font-bold py-2 px-4 rounded
                                    {{($category->pivot->approved) ? 'bg-blue-500' : 'bg-green-500'}}">
                                    {{($category->pivot->approved) ? 'Remove' : ' Make '}}
                                </button>
                            </form>
                            @empty
                            @endforelse
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                            <span class="relative">{{$instructor->created_at->diffForHumans()}}</span>
                        </span>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                            <span class="relative">{{$instructor->updated_at->diffForHumans()}}</span>
                        </span>
                    </td>

                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                            <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                            <span class="relative">
                                <form method="POST" onsubmit="return confirm('Do you really want to Delete?');"
                                    action="{{route('instructor.destroy',$instructor)}}">
                                    @csrf
                                    @honeypot
                                    @method('DELETE')
                                    <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </span>
                        </span>
                    </td>
                </tr>
                @empty
                <p class="bg-purple-400 shadow-lg font-bold p-5 rounded m-5 text-white">No Instructor Founded</p>
                @endforelse
            </tbody>
        </table>
        <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
            <x-paginator :paginator=$instructors />
        </div>
    </div>
</div>
@endsection
