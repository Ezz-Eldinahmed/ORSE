@extends('layouts.guest')
@section('content')
    <x-header-component message="All Categories" header="Categories" />
    <div class="overflow-x-hidden bg-gray-100">
        @livewire('category.search')
    </div>
@endsection
