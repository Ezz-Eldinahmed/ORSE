@extends('layouts.app')
@section('content')

    <x-header-component message="get certify on" header=" {!! $exam->course->name !!}" />

    <div class="overflow-x-hidden bg-gray-100">
        @livewire('exam.update',['exam' => $exam])
    </div>
@endsection
