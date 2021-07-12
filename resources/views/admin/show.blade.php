@extends('layouts.dashboard')
@section('content')

<x-show-alert />

<div class="py-2">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-10 overflow-hidden bg-white shadow-xl sm:rounded-lg">

            <p class="text-lg">User Name : {{$user->name}}</p>
            <p class="text-lg"> User Email : {{$user->email}}</p>

            <form method="POST" class="pt-5" action="{{route('store.interviewer',$user)}}">
                @csrf
                <label>
                    <span>Category</span>
                    <select class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
                        name="category_id">
                        @forelse($categories as $category)
                        <option value="{{($category->id)}}">{{($category->name)}}
                        </option>
                        @empty

                        @endforelse
                    </select>
                </label>
                <button class="px-4 py-2 font-bold text-white bg-yellow-300 rounded hover:bg-gray-400">
                    Make Interviewer
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
