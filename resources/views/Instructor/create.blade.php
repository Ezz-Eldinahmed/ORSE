@extends('layouts.app')

@section('content')

<x-header-component message="Instructor" header="Join AS Instructor" />

<div class="overflow-x-hidden bg-gray-100">
    <x-show-alert />
    <div class="sm:max-w-7xl w-full bg-white z-10 relative flex items-center justify-center">

        <form class="my-10 space-y-3" action="{{route('instructor.store')}}" enctype="multipart/form-data"
            method="POST">
            @csrf
            @honeypot

            <div class="grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label class="text-lg font-bold text-gray-500 tracking-wide">Certification</label><br>
                    <input name="certification" value="{{old('certification')}}" required placeholder="Make it specific"
                        class="p-3 border border-gray-500 w-full rounded-lg focus:outline-none focus:border-indigo-500"
                        type="text">
                </div>

                <div>
                    <label class="text-lg font-bold text-gray-500 tracking-wide">Category</label><br>
                    <select class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        name="category_id">
                        @foreach ($categories as $category)
                        <option value="{{($category->id)}}">{{($category->name)}}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-500 tracking-wide">Attach Resume</label>
                    <div class="flex items-center justify-center w-full">
                        <label
                            class="flex flex-col rounded-lg border-4 border-dashed w-full h-30 p-10 group text-center">
                            <div
                                class="h-full w-full text-center flex flex-col items-center justify-center items-center  ">
                                <div class="flex flex-auto w-2/5 mx-auto -mt-10">
                                </div>
                                <p class="pointer-none text-gray-500 ">select a
                                    file from your computer</p>
                            </div>

                            <input type="file" name="resume" class="hidden">
                        </label>
                    </div>

                    <p class="text-sm pt-2 text-gray-500">
                        <span>File type: doc,pdf</span>
                    </p>

                    <button type="submit"
                        class="my-2 w-full flex justify-center bg-blue-500 text-gray-100 p-4 rounded-full tracking-wide
                                    font-semibold  focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
                        Apply
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
