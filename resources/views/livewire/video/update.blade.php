<div>
    <div
        class="px-4 py-4 my-4 transition duration-500 ease-in-out bg-white rounded-lg shadow-lg hover:bg-gray-200 hover:-translate-y-1 hover:scale-10">
        <div>
            <a href="{{ route('video.show', $video) }}">
                <h2 class="text-lg font-semibold text-gray-800">{{ $video->name }}</h2>
                <p class="text-gray-600 text-md">{{ $video->description }}</p>
            </a>
        </div>
        <div class="flex justify-end">
            <a href="#" class="text-sm font-medium text-indigo-500">Added
                {{ $video->created_at->diffForHumans() }}</a>

            <p class="mx-2 text-sm font-medium text-indigo-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span class="ml-2 text-indigo-500">
                    {{ $video->seens()->count() }}
                </span>
            </p>
            @can('viewCourse', $video->lesson->course)
            @include('components.editmodelup')
            <form method="POST" wire:submit.prevent="edit({{ $video }})">
                @csrf
                @honeypot

                <div class="grid gap-2 md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-2">
                    <div>
                        <input type="text" wire:model.lazy="name_edit" value="{{ $name_edit }}"
                            class="w-full p-2 mb-2 border border-gray-400 outline-none" placeholder="Make it specific">
                    </div>
                    <div>
                        <textarea class="w-full p-2 mb-2 border border-gray-400 outline-none" required
                            wire:model.lazy="description_edit"
                            placeholder="Description">{{ $description_edit }}</textarea>
                    </div>
                </div>
                <label class="font-bold tracking-wide text-gray-500 text-md">Attach Video</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col w-full p-10 text-center border-4 border-dashed rounded-lg h-30 group">
                        <div class="flex flex-col items-center justify-center w-full h-full text-center ">
                            <p class="text-gray-500 pointer-none "><span class="text-sm">Drag and
                                    drop</span>
                                files here or click
                        </div>

                        <input type="file" wire:model.lazy="path_edit" accept="video/mp4,video/x-m4v,video/*"
                            class="hidden">
                    </label>
                </div>

                <p class="pt-2 text-sm text-gray-500">
                    <span>File type: Video</span>
                </p>
                <div class="flex mt-2 buttons">
                    <button
                        class="p-1 px-4 ml-2 font-semibold text-gray-200 bg-indigo-500 border border-indigo-500 cursor-pointer btn">
                        Edit
                    </button>
                </div>
                <div wire:loading wire:target="edit">
                    <x-loading />
                </div>
            </form>
            <button @click="showModal = !showModal"
                class="float-right px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancel</button>

            @include('components.editmodeldown')
            <x-delete-model message='Are You Sure You Want Delete This Video?' />
        </div>
        @endcan
    </div>
</div>
