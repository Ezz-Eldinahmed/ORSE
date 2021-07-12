@extends('layouts.guest')

@section('content')

<x-header-component message="All Courses" header="Courses" />

<div class="overflow-x-hidden bg-gray-100">

    <div class="text-gray-700 bg-gray-100">
        @livewire('course.search')
    </div>
</div>

@endsection
