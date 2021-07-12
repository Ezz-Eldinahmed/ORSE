<div>
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">

    <div>
        <button onclick="openModal()"
            class="px-4 py-2 mb-3 ml-2 text-lg font-bold text-white bg-teal-400 rounded-lg shadow-md">Add Post</button>
    </div>

    <div class="fixed inset-0 z-50 flex items-center justify-center w-full overflow-hidden main-modal h-100 animated fadeIn faster"
        style="background: rgba(0,0,0,.8);">
        <div
            class="z-50 w-11/12 mx-auto overflow-y-auto bg-white border border-teal-500 rounded shadow-lg modal-container md:max-w-xl">
            <div class="px-6 py-4 text-left modal-content">
                <!--Title-->
                <div class="flex items-center justify-between">
                    <p class="text-2xl font-bold">Add New Post</p>
                    <div class="z-50 cursor-pointer modal-close">
                        <svg class="text-black fill-current" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>
                <!--Body-->
                <div class="my-5">
                    <x-show-alert />
                    <form wire:submit.prevent="create">
                        @csrf
                        @honeypot

                        <div class="my-2">
                            <label class="text-lg font-bold tracking-wide text-gray-500">Title</label>
                            <input wire:model="title" value="{{ old('title') }}" required placeholder="Title"
                                class="w-full p-3 border border-gray-500 rounded-lg focus:outline-none focus:border-indigo-500"
                                type="text">
                        </div>
                        <div class="my-2">
                            <label class="text-lg font-bold tracking-wide text-gray-500">Body</label>
                            <textarea wire:model="body" required placeholder="Body" rows="4"
                                class="w-full p-3 border border-gray-500 rounded-lg focus:outline-none focus:border-indigo-500"
                                type="text">{{ old('body') }}
                            </textarea>
                        </div>
                        <div class="my-2">
                            <label class="text-sm font-bold tracking-wide text-gray-500">Attach Image</label>
                            <div class="flex items-center justify-center w-full">
                                <label
                                    class="flex flex-col w-full p-10 text-center border-4 border-dashed rounded-lg h-30 group">
                                    <div class="flex flex-col items-center justify-center w-full h-full text-center">
                                        <div class="flex flex-auto mx-auto -mt-10">
                                        </div>
                                        <p class="text-gray-500 pointer-none ">select a
                                            file from your computer
                                        </p>
                                    </div>
                                    <input type="file" wire:model="images" multiple class="hidden">
                                </label>
                            </div>
                            <p class="pt-2 text-sm text-gray-500">
                                <span>File type: jpg , jpeg , png , gif</span>
                            </p>
                        </div>
                        <div class="grid gap-2 md:grid-cols-4 sm:grid-cols-3 lg:grid-cols-5">
                            @forelse ($images as $image)
                            <div><img src="{{ $image->temporaryUrl() }}" width="200px"></div>
                            @empty

                            @endforelse
                        </div>

                        <!--Footer-->
                        <div class="flex justify-end pt-2">
                            <button
                                class="px-4 py-2 font-semibold tracking-wide text-gray-100 transition duration-300 ease-in bg-pink-500 rounded shadow-lg cursor-pointer focus:outline-none focus:shadow-outline hover:bg-blue-600">Confirm</button>

                            <div wire:loading wire:target="create">
                                <x-loading />
                            </div>
                        </div>
                    </form>
                    <button
                        class="px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-200 modal-close rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    @forelse ($posts as $post)
    @livewire('social.post',['post' => $post],key($post->id))
    @empty

    @endforelse

    <script src="{{ asset('js/modal.js') }}" defer></script>

</div>
