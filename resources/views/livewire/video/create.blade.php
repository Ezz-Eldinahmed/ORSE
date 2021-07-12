<div>
    <div x-data="{ showModal : false }">
        <!-- Button -->
        <button @click="showModal = !showModal"
            class="px-4 py-2 ml-2 text-lg font-bold text-white bg-green-400 rounded-lg shadow-md">Add
            Video
        </button>

        <!-- Modal Background -->
        <div x-show="showModal"
            class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto text-gray-500 bg-black bg-opacity-50"
            x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <!-- Modal -->
            <div x-show="showModal" class="max-w-3xl p-6 mx-10 bg-white shadow-2xl rounded-xl sm:w-10/12"
                @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform"
                x-transition:enter-start="opacity-0 scale-90 translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease duration-100 transform"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                <x-show-alert />

                <form wire:submit.prevent="create({{ $lesson }})">
                    @csrf
                    @honeypot

                    <input type="text" wire:model.lazy="name" required value="{{ old('name') }}"
                        class="w-full p-2 mb-4 border border-gray-400 rounded outline-none"
                        placeholder="Make it specific">

                    <textarea class="w-full p-2 mb-4 border border-gray-400 rounded outline-none" required
                        wire:model.lazy="description" placeholder="Description"
                        rows="3">{{ old('description') }}</textarea>

                    <label class="font-bold tracking-wide text-gray-500 text-md">Attach Video</label>
                    <div class="flex items-center justify-center w-full">
                        <label
                            class="flex flex-col w-full p-10 text-center border-4 border-dashed rounded-lg h-30 group">
                            <div class="flex flex-col items-center justify-center w-full h-full text-center ">
                                <p class="text-gray-500 pointer-none "><span class="text-sm">Drag and drop</span>
                                    files here or click
                            </div>

                            <input type="file" wire:model.lazy="video" required accept="video/mp4,video/x-m4v,video/*"
                                class="hidden">
                        </label>
                    </div>
                    <p class="pt-2 text-sm text-gray-500">
                        <span>File type: Video</span>
                    </p>
                    <div class="flex mt-2 buttons">
                        <button
                            class="p-1 px-4 ml-2 font-semibold text-gray-200 bg-indigo-500 border border-indigo-500 cursor-pointer btn">
                            Create
                        </button>
                    </div>
                    <div wire:loading wire:target="create">
                        <x-loading />
                    </div>
                </form>
                <button @click="showModal = !showModal"
                    class="float-right px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-100 focus:text-indigo">Cancel</button>
            </div>
        </div>
    </div>
</div>
