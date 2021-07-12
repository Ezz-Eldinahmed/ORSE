<div>

    <x-show-alert />
    @auth
    <form method="POST" class="mt-5" wire:submit.prevent="create">
        @csrf
        @honeypot

        <textarea class="w-full p-4 mb-2 text-xl rounded-lg shadow-inner focus:shadow-outline"
            placeholder="Try To Give Best Answer.." cols="3" rows="3" wire:model.lazy="answer"
            name="answer">{{ old('answer') }}</textarea>
        <div class="my-2">
            <label class="text-sm font-bold tracking-wide text-gray-500">Attach Image</label>
            <div class="flex items-center justify-center w-full">
                <label class="flex flex-col w-full p-10 text-center border-4 border-dashed rounded-lg h-30 group">
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
        <div class="grid gap-2 my-2 md:grid-cols-4 sm:grid-cols-3 lg:grid-cols-5">
            @forelse ($images as $image)
            <div><img src="{{ $image->temporaryUrl() }}" width="200px"></div>
            @empty

            @endforelse
        </div>

        <button class="px-4 py-2 text-lg font-bold text-white bg-purple-400 rounded-lg shadow-md">Reply
        </button>
    </form>
    @endauth

    <div id="task-comments" class="pt-4">
        @forelse ($replys as $reply)
        <div
            class="p-3 mb-4 transition duration-500 ease-in-out bg-white rounded-lg shadow-lg hover:bg-gray-200 hover:-translate-y-1 hover:scale-10">
            <div class="rounded grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-{{ $reply->image->count() }}">
                @forelse ($reply->image as $image )
                <div>
                    <img src="/storage/image/{{ $image->image }}" alt="thumbnail" loading="lazy" />
                </div>
                @empty

                @endforelse
            </div>
            <div class="mr-2">
                <a href="{{ route('profile', $reply->user) }}">
                    <img alt="avatar" class="mb-4 mr-4 rounded-full shadow-lg"
                        src="{{ $reply->user->image ? $reply->user->image : '/user_10.jpg' }}">
                    <h3 class="mt-2 text-lg font-semibold text-center text-purple-600 md:text-left ">
                        {{ $reply->user->name }}
                    </h3>
                </a>
            </div>
            <p class="text-sm font-semibold text-right">Added {{ $reply->created_at->diffForHumans() }}</p>
            <div class="flex ml-3 text-center text-gray-600 md:text-left">
                @if ($reply->question->bestReply == $reply->id)
                <svg xmlns="http://www.w3.org/2000/svg" class="bg-green-200 rounded rounded-full h-15 w-15" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                @endif
            </div>
            <p class="ml-5 text-xl font-semibold">{{ $reply->answer }}</p>
            <div class="flex justify-end">
                @can('bestReply', $reply)
                <button wire:click.prevent="setBestReply({{ $reply }})"><svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 mb-2 mr-3 bg-green-300 rounded" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
                @endcan

                @can('editReply', $reply)

                <div x-data="{ showModal : false }">
                    <!-- Button -->
                    <button wire:click.prevent="pressButton({{ $reply }})" @click="showModal = !showModal"
                        class="mr-3 font-medium text-indigo-500 text-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                    <!-- Modal Background -->
                    <div x-show="showModal"
                        class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto text-gray-500 bg-black bg-opacity-50"
                        x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <!-- Modal -->
                        <div x-show="showModal" class="max-w-3xl p-6 mx-10 bg-white rounded-lg shadow-2xl sm:w-10/12"
                            @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-90 translate-y-1"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease duration-100 transform"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                            @if (session()->has('updatereply'))
                            <div class="py-4 text-left bg-gradient-to-r from-gray-500 lg:px-4">
                                <div class="flex items-center p-2 leading-none text-indigo-100 bg-blue-500 lg:rounded-full lg:inline-flex"
                                    role="alert">
                                    <span
                                        class="flex-auto mr-2 font-semibold text-left">{{ session()->get('updatereply') }}</span>
                                    <svg class="w-4 h-4 opacity-75 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z" />
                                    </svg>
                                </div>
                            </div>
                            @endif
                            <form method="POST" wire:submit.prevent="editReply({{ $reply }})">
                                @csrf
                                @honeypot

                                <textarea class="w-full p-4 mb-2 text-xl rounded-lg shadow-md focus:shadow-outline"
                                    placeholder="Try To Give Best Answer.." cols="6" rows="3"
                                    wire:model.lazy="answer_edit">{{ $reply->answer }}</textarea>
                                <button
                                    class="px-4 py-2 text-lg font-bold text-white bg-yellow-300 rounded-lg shadow-md">Edit
                                </button>
                            </form>
                            <button @click="showModal = !showModal"
                                class="float-right px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancel</button>
                        </div>
                    </div>
                </div>
                <x-delete-model message="Are You Sure You Want Delete This Reply ?" :deleted=$reply />
                @endcan
            </div>
        </div>
        @empty
        <p class="p-5 mt-5 font-bold text-white bg-purple-400 shadow-lg">No Reply Founded Yet</p>
        @endforelse
    </div>
</div>
