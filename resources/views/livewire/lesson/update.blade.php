<div class="px-8 py-4 bg-white rounded-lg shadow-lg">
    <div>
        <h2 class="text-2xl font-semibold text-gray-800">{{ $lesson->name }}</h2>
        <p class="mt-2 text-lg text-gray-600">{{ $lesson->description }}</p>
    </div>
    <div class="flex justify-end">
        <a href="#" class="font-medium text-indigo-500 text-md">Added
            {{ $lesson->created_at->diffForHumans() }}</a>

        <p class="mx-2 text-sm font-medium text-indigo-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <span class="ml-2 text-indigo-500">
                {{ $lesson->seens()->count() }}
            </span>
        </p>
        @can('viewCourse', $lesson->course)
        @include('components.editmodelup')
        <form method="POST" wire:submit.prevent="edit({{ $lesson }})">
            @csrf
            @honeypot

            <div class="grid gap-4 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-2">
                <input type="text" wire:model.lazy="name" required
                    class="p-2 border border-gray-400 rounded outline-none" placeholder="Make it specific">

                <textarea class="p-2 border border-gray-400 rounded outline-none" required wire:model.lazy="description"
                    placeholder="Description" rows="3"></textarea>
                <!-- buttons -->
                <div class="flex buttons">
                    <button
                        class="p-1 px-4 ml-2 font-semibold text-white bg-yellow-300 border border-yellow-500 rounded cursor-pointer btn">
                        Update
                    </button>
                </div>
            </div>
        </form>
        <button @click="showModal = !showModal"
            class="float-right px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancel</button>

        @include('components.editmodeldown')
        <x-delete-model message="Are You Sure You Want Delete This Lesson And
                                        All Related Videos ?" :deleted=$lesson />
        @endcan

    </div>
    <b>By : </b><a href="{{ route('instructor.show', $lesson->course->instructor) }}">
        {{ $lesson->course->instructor->user->name }}
    </a>
</div>
