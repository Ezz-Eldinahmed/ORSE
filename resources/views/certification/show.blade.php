@extends('layouts.app')

@section('content')

<x-header-component message="Certification" header="{{$certification->course->name}}" />

<div class="overflow-x-hidden bg-gray-100">

    <div class="px-8 py-4 my-5 bg-white rounded-lg shadow-lg">
        <div>
            <h2 class="text-4xl font-bold text-gray-800">Certificate of {{$certification->course->name}}</h2>
            <p class="mt-2 text-xl font-semibold text-gray-600">{{$certification->course->description}}</p>

            @if ($certification->status == 'pass')
            <p class="p-3 mt-2 text-2xl font-semibold text-white bg-green-400">
                You have {{$certification->status}} to completed the {{$certification->course->name}}
                As you get {{$certification->grade}} / {{$certification->full_mark}}</p>
            @else
            <p class="p-3 mt-2 text-2xl font-semibold text-white bg-red-400">
                You have {{$certification->status}} to completed the {{$certification->course->name}}
                As you get {{$certification->grade}} / {{$certification->full_mark}}</p>
            @endif
        </div>
        <div class="flex justify-end mt-4">
            <a href="#" class="text-xl font-medium text-indigo-500">{{$certification->user->name}}</a>
        </div>

        <p class="mt-2 text-2xl font-semibold text-gray-600">from www.orse.com</p>
        <p class="mt-2 text-2xl font-semibold text-gray-600">Issued on: {{$certification->created_at}}</p>

    </div>

</div>
@endsection
