@extends('layouts.app')

@section('content')

<x-header-component message="Admin Panel" header="{!!$interviewer->user->name!!}" />
<div class="overflow-x-hidden bg-gray-100">
    <div class="max-w-7xl py-4 px-8 bg-white shadow-lg rounded-lg">
        <div>
            <h2 class="text-gray-800 text-3xl font-semibold"> Interviewer Name : {{$interviewer->user->name}}<br>
                Interviewer Email : {{$interviewer->user->email}}<br>
            </h2>

            <div class="py-4 px-8 text-xl">
                interviewer Categories To :

                @forelse($interviewer->categories as $category)
                <ul>
                    <li><a href="{{route('category.show',$category)}}">
                            {{($category->name)}}</a></li>
                    <li>{{$category->description }}</li>
                    <li>Approved : {{ ($category->pivot->approved ? 'Accepted' : 'Pending') }}</li>
                    <li>interviewer Created At : {{$interviewer->created_at->diffForHumans()}}</li>
                </ul>
                @empty
                interviewer Didn't Request Any
                @endforelse
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <a href="#" class="text-xl font-medium text-indigo-500">{{$interviewer->created_at->diffForHumans()}}</a>
        </div>
        <div class="flex justify-end mt-4">
            <a href="#" class="text-xl font-medium text-indigo-500">
                <form method="POST" onsubmit="return confirm('Do you really want to Delete?');"
                    action="{{route('interviewer.destroy',$interviewer)}}">
                    @csrf
                    @method('DELETE')
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </form>
            </a>
        </div>
    </div>
</div>

@endsection
