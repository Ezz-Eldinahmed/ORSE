<div class="px-8 py-4 bg-white rounded-lg shadow-lg">
    <div>
        <h2 class="text-2xl font-semibold text-gray-800">{{$category->name}}</h2>
        <p class="mt-2 text-lg text-gray-600">{{$category->description}}</p>
    </div>
    <div class="flex justify-end mt-4">
        <a href="#" class="mr-3 font-medium text-indigo-500 text-md">Added
            {{$category->created_at->diffForHumans()}}
        </a>
        @can('view-admin', auth()->user())

        @include('components.editmodelup')
        <form method="POST" wire:submit.prevent="edit">
            @csrf
            @honeypot

            <h3>Name</h3>
            <input type="text" required class="w-full p-2 mb-4 border border-gray-400 outline-none"
                wire:model.lazy="name">

            <h3>Description</h3>
            <textarea type="text" required class="w-full p-2 mb-4 border border-gray-400 outline-none"
                wire:model.lazy="description" cols="40" rows="5"></textarea>

            <div class="flex buttons">
                <button
                    class="p-1 px-4 ml-2 font-semibold text-gray-200 bg-indigo-500 border border-yellow-500 cursor-pointer btn">
                    Edit
                </button>
            </div>
        </form>
        <button @click="showModal = !showModal"
            class="float-right px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-200 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-50 focus:text-indigo">Cancel</button>

        @include('components.editmodeldown')
        <x-delete-model message="Are You Sure You Want Delete This Category And
            All Related Courses?" />
        @endcan
    </div>
</div>
