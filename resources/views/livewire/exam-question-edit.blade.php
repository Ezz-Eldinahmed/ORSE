<div>
    <div class="px-8 py-4 my-2 bg-white rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold text-gray-800">{!!$examQuestion->question!!}</h2>
        <ul>
            <p class="mt-2 text-gray-600">
                Correct Answer : {!!$examQuestion->correct!!}
            </p>
            <p class="mt-2 text-gray-600">
                a : {!!$examQuestion->a!!}
            </p>
            <p class="mt-2 text-gray-600">
                b : {!!$examQuestion->b!!}</p>
            <p class="mt-2 text-gray-600">
                c : {!!$examQuestion->c!!}</p>
            <p class="mt-2 text-gray-600">
                d : {!!$examQuestion->d!!}</p>
        </ul>
        <div class="flex justify-end">
            <a href="#" class="mx-3 text-sm font-medium text-indigo-500">Difficulty :
                {!!$examQuestion->difficulty!!}</a>

            @include('components.editmodelup')
            <form wire:submit.prevent="updateExamQuestion">
                @csrf
                @honeypot

                <p class="mb-4 font-semibold">Question</p>
                <textarea type="text" wire:model.lazy="question" required rows="4" placeholder="Question .."
                    class="w-full p-2 mb-2 border border-gray-400 rounded outline-none"></textarea>
                <p class="mb-4 font-semibold">Answers Please Check Which Is Correct</p>
                <div>
                    <input type="radio" wire:model.lazy="correct" name="correct" value="a">
                    <label for="a">a</label>
                    <input type="text" wire:model.lazy="a" required placeholder="put the answer that will appear in a"
                        class="w-full p-2 mb-4 border border-gray-400 rounded outline-none">
                </div>
                <div>
                    <input type="radio" wire:model.lazy="correct" name="correct" value="b">
                    <label for="b">b</label>
                    <input type="text" wire:model.lazy="b" required placeholder="put the answer that will appear in b"
                        class="w-full p-2 mb-4 border border-gray-400 rounded outline-none">
                </div>
                <div>
                    <input type="radio" wire:model.lazy="correct" name="correct" value="c">
                    <label for="c">c</label>
                    <input type="text" wire:model.lazy="c" required placeholder="put the answer that will appear in c"
                        class="w-full p-2 mb-4 border border-gray-400 rounded outline-none">
                </div>
                <div>
                    <input type="radio" wire:model.lazy="correct" name="correct" value="d">
                    <label for="d">d</label>
                    <input type="text" wire:model.lazy="d" required placeholder="put the answer that will appear in d"
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
                    class="px-4 py-2 mt-4 text-lg font-bold text-white bg-yellow-300 rounded-lg shadow-md">Submit</button>
            </form>

            <button @click="showModal = !showModal"
                class="float-right px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-100 focus:text-indigo">Cancel</button>
            @include('components.editmodeldown')
            <x-delete-model message="Are You Sure You Want Delete This Question?" />
        </div>
    </div>
</div>
