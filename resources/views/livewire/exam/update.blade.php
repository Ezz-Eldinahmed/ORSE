<div class="p-3 bg-white">
    <x-show-alert />
    <style>
        .toggle-checkbox:checked {
            @apply: right-0 border-teal-600;
            right: 0;
            border-color: #68D391;
        }

        .toggle-checkbox:checked+.toggle-label {
            @apply: bg-teal-600;
            background-color: #68D391;
        }
    </style>

    <div class="relative inline-block w-10 mr-2 align-middle transition duration-500 ease-in select-none">
        <input type="checkbox" wire:click="examView({{ $exam }})" @if ($exam->view == 1) checked @endif name="toggle"
        id="toggle"
        class="absolute block w-6 h-6 bg-white border-4 rounded-full appearance-none cursor-pointer toggle-checkbox" />
        <label for="toggle"
            class="block h-6 overflow-hidden bg-gray-300 rounded-full cursor-pointer toggle-label"></label>
    </div>

    <label for="toggle" class="text-sm font-semibold text-gray-700">
        @if ($exam->view == 1)
        Disallow To Exam
        @else
        Allow To Exam
        @endif
    </label>

    <div class="flex justify-end mt-4">
        @include('components.editmodelup')
        <form wire:submit.prevent="examUpdate">
            @csrf
            @honeypot

            <div>
                <b>Exam Level</b>
                <label for="level" class="mt-2 mr-3">Choose Exam Level:</label>
                <select wire:model.lazy="level"
                    class="px-4 py-2 text-sm font-bold text-white bg-yellow-300 border border-gray-200 rounded-xl">
                    <option value="1">Easy</option>
                    <option value="2">Medium</option>
                    <option value="3">Hard</option>
                </select>
            </div>
            <div class="my-4">
                <button type="submit"
                    class="px-4 py-2 text-sm font-bold text-white transition-colors duration-150 ease-linear bg-yellow-300 border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Edit</button>
            </div>
        </form>
        <button @click="showModal = !showModal"
            class="float-right px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancel</button>

        @include('components.editmodeldown')

        <x-delete-model message="Are You Sure You Want Delete This Exam
        All Related Questions ?" />
    </div>

    <div x-data="{ showModal : false }">
        <!-- Button -->
        <button @click="showModal = !showModal"
            class="px-4 py-2 text-lg font-bold text-white bg-green-400 rounded-lg shadow-md">Add
            Question
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

                <form wire:submit.prevent="createExamQuestion">
                    @csrf
                    @honeypot

                    <div>
                        <p class="mb-2 font-semibold">Question</p>

                        <textarea type="text" wire:model.lazy="question" required rows="4" placeholder="Question .."
                            class="w-full p-2 mb-2 border border-gray-400 rounded outline-none">{{ old('question') }}</textarea>

                        <p class="mb-4 font-semibold">Answers Please Check Which Is Correct</p>
                    </div>
                    <div>
                        <input type="radio" wire:model.lazy="correct" name="correct" value="a">
                        <label for="a">a</label>
                        <input type="text" wire:model.lazy="a" value="{{ old('a') }}" required
                            placeholder="put the answer that will appear in a"
                            class="w-full p-2 mb-4 border border-gray-400 rounded outline-none">
                    </div>
                    <div>
                        <input type="radio" wire:model.lazy="correct" name="correct" value="b">
                        <label for="b">b</label>
                        <input type="text" wire:model.lazy="b" value="{{ old('b') }}" required
                            placeholder="put the answer that will appear in b"
                            class="w-full p-2 mb-4 border border-gray-400 rounded outline-none">
                    </div>
                    <div>
                        <input type="radio" wire:model.lazy="correct" name="correct" value="c">
                        <label for="c">c</label>
                        <input type="text" wire:model.lazy="c" value="{{ old('c') }}" required
                            placeholder="put the answer that will appear in c"
                            class="w-full p-2 mb-4 border border-gray-400 rounded outline-none">
                    </div>
                    <div>
                        <input type="radio" wire:model.lazy="correct" name="correct" value="d">
                        <label for="d">d</label>
                        <input type="text" wire:model.lazy="d" value="{{ old('d') }}" required
                            placeholder="put the answer that will appear in d"
                            class="w-full p-2 mb-4 border border-gray-400 rounded outline-none">
                    </div>
                    <div>
                        <label for="difficulty">Choose Question difficulty:</label>
                        <select wire:model.lazy="difficulty"
                            class="px-4 py-2 ml-2 text-lg font-bold text-white bg-blue-500 rounded-lg shadow-md">
                            <option value="1">Easy</option>
                            <option value="2">Medium</option>
                            <option value="3">Hard</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 mt-4 text-lg font-bold text-white bg-blue-500 rounded-lg shadow-md">Submit</button>
                </form>
                <button @click="showModal = !showModal"
                    class="float-right px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancel</button>
            </div>
        </div>
    </div>

    @forelse ($exam->examQuestions as $examQuestion)
    @livewire('exam-question-edit',['examQuestion' => $examQuestion],key($examQuestion->id))
    @empty
    <p class="p-2 m-3 font-bold text-white bg-purple-400 shadow-lg">No Questions Added To This Exam</p>
    @endforelse

</div>
