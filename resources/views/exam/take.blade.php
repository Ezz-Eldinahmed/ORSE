@extends('layouts.guest')
@section('content')

<x-header-component message="Exam" header="{!!$exam->course->name!!}" />

<div class="overflow-x-hidden bg-gray-100">
    @if($exam->examQuestions->count() > 0)
    <x-show-alert />

    <form method="POST" action="{{route('exam.submit',$exam)}}">
        @csrf
        @honeypot
        <div class="px-8 py-4 my-2 bg-white rounded-lg shadow-lg">
            @forelse ($exam->examQuestions as $question)
            <ul class="flex flex-col">
                <h2 class="text-3xl font-semibold text-gray-800">{!!$question->question!!}</h2>

                <label class="p-3 mt-2 bg-gray-200">
                    <input type="radio" name="{{$question->id}}" value="a" class="text-red-600 bg-green-300 w-7 h-7 form-radio">
                    <span class="px-2 py-1 text-xl rounded-lg">{{ $question->a }}</span>
                </label>

                <label class="p-3 mt-2 bg-gray-200">
                    <input type="radio" name="{{$question->id}}" value="b"
                        class="text-blue-400 bg-green-300 w-7 h-7 form-radio"><span
                        class="px-2 py-1 text-xl rounded-lg">{{ $question->b }}</span>
                </label>

                <label class="p-3 mt-2 bg-gray-200">
                    <input type="radio" name="{{$question->id}}" value="c"
                        class="text-yellow-300 bg-green-300 w-7 h-7 form-radio"><span
                        class="px-2 py-1 text-xl rounded-lg">{{ $question->c }}</span>
                </label>

                <label class="p-3 mt-2 bg-gray-200">
                    <input type="radio" name="{{$question->id}}" value="d"
                        class="text-green-600 bg-green-300 w-7 h-7 form-radio"><span
                        class="px-2 py-1 text-xl rounded-lg">{{ $question->d }}</span>
                </label>
            </ul>

            <div class="flex justify-end">
                <a href="#" class="text-sm font-medium text-blue-500">Mark : {!!$question->difficulty!!}</a>
            </div>
            @empty

            @endforelse

            <button type="submit"
                class="px-4 py-2 ml-2 text-lg font-bold text-white bg-red-400 rounded-lg shadow-md">Submit
            </button>
        </div>
    </form>
    @endif

</div>
@endsection
