@extends('layouts.guest')

@section('content')

<x-header-component message="Contact Us Whatever You Face" header="Contact Us" />

<div class="sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-5">
        <x-show-alert />

        <form class="m-7" method="POST" action="{{route('contact.store')}}">
            @csrf
            @honeypot

            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                    <label class="appearance-none block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-first-name">
                        Name
                    </label>
                    <input
                        class="w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-first-name" type="text" placeholder="Enter your name.." value="{{old('name')}}"
                        name="name">
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-email">
                        Email
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-email" type="text" type="email" required value="{{old('email')}}" name="email"
                        placeholder="Enter Email ..">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">

                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="appearance-none block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-phone">
                        Phone Number
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-phone" required class="form-control" value="{{old('phone')}}" name="phone"
                        placeholder="Enter Phone Number..">
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="appearance-none block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-subject">
                        Subject
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 focus:outline-none focus:bg-white focus:border-gray-500"
                        required value="{{old('subject')}}" name="subject" placeholder="Subject.." id="grid-subject"
                        type="text">
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                        for="grid-message">
                        Message
                    </label>
                    <textarea
                        class="w-full bg-gray-100 text-gray-700 border border-gray-200 rounded py-3 px-2 focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-message" placeholder="Enter Message .." required name="message" rows=5
                        type="text">{{old('message')}}</textarea>
                </div>
            </div>
            <x-jet-button class="flex justify-end bg-green-700">
                {{ __('Send') }}
            </x-jet-button>
        </form>
    </div>
</div>

@endsection
