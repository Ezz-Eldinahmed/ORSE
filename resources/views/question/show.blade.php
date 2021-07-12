@extends('layouts.guest')
@section('content')

    <x-header-component message="Question ?" header="Ask" />

    <div class="overflow-x-hidden bg-gray-100">

        <div class="grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 ml-3">
            <div class="col-span-2">
                @livewire('question.update',['question' => $question])
            </div>
            <x-side-bar />
        </div>
    </div>
@endsection
