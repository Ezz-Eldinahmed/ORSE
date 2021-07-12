@extends('layouts.dashboard')
@section('content')

<x-show-alert />

<div class="grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 gap-2">
    @forelse ($exams as $exam)
    <div class="py-2 px-8 bg-white shadow-lg rounded-lg my-2">

        <div>
            <a href="{{route('exam.show',$exam)}}">
                <h2 class="text-gray-800 text-xl font-semibold">On Course : {{$exam->course->name}}</h2>
                <p class="text-gray-600">
                    <h3>Level : {{$exam->level}}</h3>
                    <h3>Exam Questions : {{$exam->examQuestions->count()}}</h3>
                </p>
            </a>
        </div>
        <div class="flex justify-end">
            <a href="{{route('exam.show',$exam)}}" class="mr-3 text-md font-medium text-indigo-500">
                Exam Show
            </a>
        </div>
    </div>
    @empty
    <p class="bg-purple-400 shadow-lg font-bold p-5 rounded m-5 text-white">No Exam Founded</p>
    @endforelse
</div>
<x-paginator :paginator=$exams />

@endsection
