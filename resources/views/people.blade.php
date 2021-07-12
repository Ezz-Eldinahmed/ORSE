@extends('layouts.app')

@section('content')

    <x-header-component message="All Users" header="People" />

    <div class="overflow-x-hidden bg-gray-100">

        <div class="bg-gray-100 text-gray-700">
            @livewire('social.people')
        </div>
    </div>

@endsection
