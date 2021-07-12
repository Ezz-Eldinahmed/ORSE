@extends('layouts.guest')
@section('content')

    <x-header-component message="Question" header="Ask" />

    <div class="overflow-x-hidden bg-gray-100">
        <div class="grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 gap-4 m-5 my-5">
            <div class="col-span-2">
                <h1 class="text-xl font-bold text-gray-700">Question</h1>
                @livewire('question.create')
            </div>
            <div>
                <x-side-bar />
            </div>
        </div>
    </div>

@endsection
