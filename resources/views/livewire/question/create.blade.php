<div>
    @auth
        <x-show-alert />

        <form wire:submit.prevent="createQuestion">
            @csrf
            @honeypot
            <div class="flex flex-col p-4 text-gray-800 border border-gray-300 shadow-lg">
                <textarea wire:model="question" placeholder="Many other will answer."
                    class="h-40 p-3 border border-gray-300 outline-none">{{ old('question') }}
                </textarea>
                <p class="pt-2">Category</p>
                <select wire:model="category_id" class="pt-2">
                    <option class="text-sm text-gray-200">
                        <-- Select Category -->
                    </option>
                    @forelse ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @empty
                    @endforelse
                </select>
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
                <div class="grid gap-2 md:grid-cols-4 sm:grid-cols-3 lg:grid-cols-5">
                    @forelse ($images as $image)
                        <div><img src="{{ $image->temporaryUrl() }}" width="200px"></div>
                    @empty

                    @endforelse
                </div>

                <div class="flex mt-2 buttons">
                    <button type="submit"
                        class="p-2 px-4 ml-2 font-semibold text-gray-200 bg-indigo-500 border border-indigo-500 cursor-pointer btn">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    @endauth

    <div class="grid gap-2 p-5 m-2 bg-white shadow-lg md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-2">
        <div class="pb-2">
            <p class="mb-2 font-semibold">Show Question Related To This Categroy</p>
            <select wire:model.lazy="category_filter" class="w-full p-2 bg-gray-200 ">
                @forelse ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="m-4">
            <label for="search" class="sr-only">Search</label>
            <input type="search" class="w-full p-2 mt-4 bg-gray-200 border-0 rounded shadow"
                wire:model.debounce.200ms="search" name="search" placeholder="Search ...">
        </div>
    </div>

    @forelse ($questions as $question)
        <div class="mt-3">
            <div
                class="max-w-3xl px-6 pb-3 transition duration-500 ease-in-out transform bg-white rounded-lg shadow-md hover:bg-gray-200 hover:-translate-y-1 hover:scale-10">
                <div
                    class="rounded grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-{{ $question->image->count() }} my-4">
                    @forelse ($question->image as $image )
                        <div>
                            <img src="/storage/image/{{ $image->image }}" alt="thumbnail" loading="lazy" />
                        </div>
                    @empty

                    @endforelse
                </div>
                <div class="flex items-center justify-between">
                    <span class="font-light text-gray-600">{{ $question->created_at->diffForHumans() }}</span><a
                        href="{{ route('categories.show', $question->category) }}"
                        class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500">{{ $question->category->name }}</a>
                </div>
                <div class="mt-2"><a href="{{ route('question.show', $question) }}"
                        class="text-xl font-semibold text-gray-700">{{ $question->question }}</a>
                </div>
                <div class="flex items-center justify-end">
                    <a href="{{ route('profile', $question->user) }}" class="flex items-center"><img
                            src="{{ $question->user->image ? $question->user->image : '/user_10.jpg' }}" alt="avatar"
                            class="hidden object-cover mx-4 rounded-full sm:block">
                        <h1 class="font-bold text-gray-700 hover:underline">{{ $question->user->name }}</h1>
                    </a>
                </div>
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <p class="ml-3">{{ $question->seens_count }}
                    </p>
                </div>
            </div>
        </div>
    @empty
        <p class="p-5 m-5 font-bold text-white bg-pink-400 rounded-md shadow-lg">No Question Founded
        </p>
    @endforelse

    <x-Links-component :paginator=$questions />
</div>
