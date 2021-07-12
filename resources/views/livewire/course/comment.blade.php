<div>
    <x-show-alert />

    <form method="POST" wire:submit.prevent="create({{ $course }})">
        @csrf
        @honeypot

        <input type="hidden">
        <textarea class="w-full shadow-inner p-4 border-0 mb-2 rounded-lg focus:shadow-outline text-xl"
            placeholder="Add Comment Here." wire:model.lazy="comment" required cols="6" rows="3"
            id="comment_content">{{ old('comment') }}</textarea>
        <button class="font-semibold py-1 px-2 bg-purple-400 text-lg text-white shadow-md rounded-lg ">Comment
        </button>
    </form>

    <div id="task-comments" class="pt-3">
        <!--     comment-->
        @forelse ($comments as $comment)
            <div
                class="bg-white transition duration-500 ease-in-out bg-white hover:bg-gray-200 hover:-translate-y-1 hover:scale-10 rounded-lg p-3 shadow-lg mb-4">
                <p class="text-sm text-right">{{ $comment->created_at->diffForHumans() }}</p>
                <div class="flex flex-row justify-start mr-2">
                    <img alt="avatar" class="rounded-full mr-4 shadow-lg mb-2"
                        src="{{ $comment->user->image ? $comment->user->image : '/user_10.jpg' }}">
                    <h3 class="text-purple-600 font-semibold text-lg text-center md:text-left ">
                        {{ $comment->user->name }}
                    </h3>
                </div>
                <p class="text-gray-600 text-lg font-semibold text-center md:text-left ">
                    {{ $comment->comment }}</p>

                @can('comment', $comment)
                    <x-delete-model message="Are You Sure You Want Delete This
                    Comment?" :deleted=$comment />
                @endcan
            </div>
        @empty
            <p class="bg-purple-400 shadow-lg font-bold p-2 mt-2 text-white">No Comment Added Yet</p>
        @endforelse
    </div>
</div>
