@extends('layouts.app')
@section('content')

<x-header-component message="Post & Comment" header="Timeline" />

<div class="overflow-x-hidden bg-gray-100">
    <div class="grid my-5 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3">
        <div class="col-span-2">
            @livewire('social.timeline')
        </div>
        <div>
            <x-side-bar />
        </div>
    </div>
</div>
@endsection
