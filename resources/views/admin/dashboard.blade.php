@extends('layouts.dashboard')
@section('content')

<div>
    <div class="px-5 py-3 mb-2 shadow-sm rounded-md bg-white">
        <h4 class="text-2xl font-semibold text-gray-700">{{$gain}}</h4>
        <div class="text-gray-500">Total Gain</div>
    </div>
</div>

<div class="grid md:grid-cols-3 sm:grid-cols-2 lg:grid-cols-5 gap-4">
    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$users}}</h4>
                <div class="text-gray-500">ALL Users</div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$courses}}</h4>
                <div class="text-gray-500">Total Courses</div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$questions}}</h4>
                <div class="text-gray-500">Questions</div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$interviewer}}</h4>
                <div class="text-gray-500">Interviewers</div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$categories}}</h4>
                <div class="text-gray-500">Categories</div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$certificates}}</h4>
                <div class="text-gray-500">Certificates</div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$comments}}</h4>
                <div class="text-gray-500">Comments</div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$contact}}</h4>
                <div class="text-gray-500">Contact Us</div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$videos}}</h4>
                <div class="text-gray-500">Videos</div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$exam}}</h4>
                <div class="text-gray-500">Exams</div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$lesson}}</h4>
                <div class="text-gray-500">Lessons</div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$rate}}</h4>
                <div class="text-gray-500">Rates</div>
            </div>
        </div>
    </div>

    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$replies}}</h4>
                <div class="text-gray-500">Replies</div>
            </div>
        </div>
    </div>
    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$seens}}</h4>
                <div class="text-gray-500">Seens</div>
            </div>
        </div>
    </div>
    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$payments}}</h4>
                <div class="text-gray-500">Payments</div>
            </div>
        </div>
    </div>
    <div>
        <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white">
            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$joins}}</h4>
                <div class="text-gray-500">Joines</div>
            </div>
        </div>
    </div>
</div>
@endsection
