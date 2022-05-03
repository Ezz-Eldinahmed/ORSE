<div>

    <head>
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    </head>

    <div class="mx-4 my-4 rounded shadow-xl">
        <div id="slider" class="swiper-container">
            <div class="swiper-wrapper">
                @forelse ($post->image as $image )
                <div class="swiper-slide">
                    <img src="/storage/image/{{ $image->image }}" class="max-h-80" alt="thumbnail" loading="lazy" />
                </div>
                @empty

                @endforelse
            </div>
            <div class="hidden w-16 h-16 text-xs text-teal-500 bg-white rounded-full md:flex swiper-button-prev"></div>
            <div class="hidden w-16 h-16 text-xs text-teal-500 bg-white rounded-full md:flex swiper-button-next"></div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="px-3 py-2 text-lg font-semibold text-white bg-teal-400 rounded">
            <a href="{{ route('profile', $post->user) }}">{{ $post->user->name }}
            </a>
        </div>
        <div class="flex justify-between bg-gray-300">
            <div>
                <button wire:click.prevent="like({{ $post }})" class="mt-2 ml-3">
                    <div class="flex">
                        <p class="mr-2">{{ $post->likes->count() }}</p>

                        @if ($post->likes()->where('user_id', auth()->user()->id)->first() != null)

                        @if ($post->likes()->where('user_id', auth()->user()->id)->first()->like == 1)
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        @endif
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        @endif
                    </div>
                </button>
            </div>
            <div class="flex p-1">
                <div class="flex mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-1 " fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mx-1">{{ $post->created_at->diffForHumans() }}</p>
                </div>
                @can('postEdit', $post)
                <div class="mx-2">
                    <x-delete-model message="Are You Sure You Want Delete This Post?" :deleted=$post />
                </div>
                @include('components.editmodelup')
                <form wire:submit.prevent="edit">
                    @csrf
                    @honeypot

                    <div>
                        <label class="text-lg font-bold tracking-wide text-gray-500">Title</label>
                        <input wire:model="title" value="{{ $post->title }}" required placeholder="Title"
                            class="w-full p-3 border border-gray-500 rounded-lg focus:outline-none focus:border-indigo-500"
                            type="text">
                    </div>
                    <div>
                        <label class="my-6 text-lg font-bold tracking-wide text-gray-500">Body</label>
                        <textarea wire:model="body" required placeholder="Body" rows="4"
                            class="w-full p-3 border border-gray-500 rounded-lg focus:outline-none focus:border-indigo-500"
                            type="text">{{ $post->body }}
                                    </textarea>
                    </div>
                    <div>
                        <label class="text-sm font-bold tracking-wide text-gray-500">Attach
                            Image</label>
                        <div class="flex items-center justify-center w-full">
                            <label
                                class="flex flex-col w-full p-10 text-center border-4 border-dashed rounded-lg h-30 group">
                                <div class="flex flex-col items-center justify-center w-full h-full text-center ">
                                    <div class="flex flex-auto mx-auto -mt-10">
                                    </div>
                                    <p class="text-gray-500 pointer-none ">select file from your
                                        computer</p>
                                </div>
                                <input type="file" wire:model="images_input" multiple class="hidden">
                            </label>
                        </div>
                        <p class="pt-2 text-sm text-gray-500">
                            <span>File type: jpg,jpeg,png,gif</span>
                        </p>
                    </div>
                    <div class="grid gap-2 md:grid-cols-4 sm:grid-cols-3 lg:grid-cols-5">
                        @forelse ($images as $image)
                        <div>
                            <img src="/storage/image/{{ $image->image }}" width="200px">
                            <button wire:click.prevent="deleteImage({{ $image }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                        @empty

                        @endforelse
                        @forelse ($images_input as $image_input)
                        <div><img src="{{ $image_input->temporaryUrl() }}" width="200px"></div>
                        @empty

                        @endforelse
                    </div>

                    <div class="mt-2">
                        <button type="submit"
                            class="px-4 py-2 font-semibold tracking-wide text-gray-100 transition duration-300 ease-in bg-yellow-300 rounded shadow-lg cursor-pointer focus:outline-none focus:shadow-outline hover:bg-blue-600">
                            Edit
                        </button>
                        <div wire:loading wire:target="edit">
                            <x-loading />
                        </div>
                    </div>
                </form>
                <button @click="showModal = !showModal"
                    class="px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancel</button>

                @include('components.editmodeldown')
                @endcan
            </div>
        </div>
        <div class="px-4 py-2 bg-white shadow">
            <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
            <p class="px-2 my-2 mr-1 text-lg font-semibold">{{ $post->body }}</p>
        </div>
        <!-- comment form -->
        <div class="flex shadow-lg">
            <form wire:submit.prevent="comment" class="w-full px-4 pt-2 bg-white rounded-lg">
                @csrf
                @honeypot
                <div class="flex flex-wrap mb-3 -mx-3">
                    <div class="w-full px-3 mb-2 md:w-full">
                        <textarea
                            class="w-full px-4 font-medium leading-normal bg-gray-100 border border-gray-400 rounded resize-none focus:outline-none focus:bg-white"
                            wire:model="comment" rows="3" placeholder='Type Your Comment'
                            required>{{ old('comment') }}</textarea>
                    </div>
                    <div class="ml-3">
                        <input type='submit'
                            class="px-2 py-1 mr-1 font-medium tracking-wide text-gray-700 bg-white border border-gray-400 rounded-lg hover:bg-gray-100"
                            value='Comment'>
                    </div>
                </div>
            </form>
        </div>
        <div class="overflow-y-scroll max-h-60">
            @forelse ($post->comment as $comment)
            <div class="bg-white">
                <div class="flex p-3 mt-3">
                    <img class="rounded-full" src="{{ $comment->user->image ? $comment->user->image : '/user_sm.jpg' }}"
                        alt="avatar" loading='lazy' width="5%">
                    <p class="ml-3 font-semibold">{{ $comment->user->name }}</p>
                </div>
                <p class="mx-3">{{ $comment->comment }}</p>
                <div class="flex justify-end">
                    @can('comment', $comment)
                    <div class="mr-3">
                        <x-delete-model message="Are You Sure You Want Delete This Comment?" method='deleteComment'
                            :deleted=$comment />
                    </div>
                    @endcan
                    <p class="mr-3">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty

            @endforelse
        </div>
    </div>
</div>
<script>
    var mySwiper = new Swiper('.swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // If we need pagination
        pagination: {
            el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // And if we need scrollbar
        scrollbar: {
            el: '.swiper-scrollbar',
        },
    })
</script>
