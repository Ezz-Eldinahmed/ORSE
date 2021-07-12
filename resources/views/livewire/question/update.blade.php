<div class="mr-3">
    <x-show-alert />
    <div class="px-8 py-6 bg-white rounded-lg shadow-lg">
        <div>
            <div class="rounded grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-{{ $question->image->count() }}">
                @forelse ($question->image as $image )
                <div>
                    <img src="/storage/image/{{ $image->image }}" alt="thumbnail" loading="lazy" />
                </div>
                @empty

                @endforelse
            </div>
            <p class="font-medium text-right text-blue-500">Category
                {{ $question->category->name }}
            </p>
            <a href="{{ route('profile', $question->user) }}">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $question->user->name }}</h2>
                <p class="mt-2 text-xl text-gray-600">{{ $question->question }}</p>
            </a>
        </div>

        <div class="flex justify-end mt-4">
            <a href="#" class="mr-3 text-sm font-medium text-indigo-500">Added
                {{ $question->created_at->diffForHumans() }}
            </a>
            <a class="mr-2 text-sm font-medium text-indigo-500"><svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <p class="ml-2">
                    {{ $question->seens()->count() }}
                </p>
            </a>
            @can('viewQuestion', $question)
            <div class="mx-2">
                <x-delete-model message="Are You Sure You Want Delete This Question And All Replys Related?" />
            </div>
            <div class="mx-2">
                @include('components.editmodelup')
                <form method="POST" wire:submit.prevent="editQuestion">
                    @csrf
                    @honeypot

                    <p>Question</p>
                    <textarea wire:model.lazy="question_edit" placeholder="Many other will answer."
                        class="w-full h-40 p-3 border border-gray-300 outline-none">{{ $question_edit }}
                                                        </textarea>

                    <p class="m-2">Category</p>
                    <select wire:model="category_id" class="p-2 mb-2 bg-gray-200">
                        @forelse ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                        @empty

                        @endforelse
                    </select>

                    <div class="flex buttons">
                        <button
                            class="p-1 px-4 ml-2 font-semibold text-white bg-yellow-300 border border-yellow-500 cursor-pointer btn">
                            Edit
                        </button>
                    </div>
                </form>
                <button @click="showModal = !showModal"
                    class="float-right px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancel</button>

                @include('components.editmodeldown')
            </div>
            @endcan
        </div>
    </div>
    @livewire('question.reply',['question' => $question])
</div>
