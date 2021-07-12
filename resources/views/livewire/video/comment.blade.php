<div class="m-2">
    <div id="task-comments" class="overflow-auto h-40">
        <x-show-alert />

        @forelse ($comments as $comment)
            <div class="text-sm mb-2 flex flex-start items-center">
                <div>
                    <a href="#"
                        class="cursor-pointer flex items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                        <img alt="avatar" class="rounded-full mr-4 shadow-lg mb-4"
                            src="{{ $comment->user->image ? $comment->user->image : '/user_10.jpg' }}">
                    </a>
                </div>
                <p class="font-bold ml-2">
                    <a class="cursor-pointer">{{ $comment->user->name }}</a>
                    <span class="text-gray-700 font-medium ml-1">
                        {{ $comment->comment }}
                    </span>
                </p>
                <div>
                    <p class="text-gray-700 font-sm ml-2 float-right">
                        {{ $comment->created_at->diffForHumans() }}
                    </p>
                </div>

                @can('comment', $comment)
                    <x-delete-model message="Are You Sure You Want Delete This
                Comment?" :deleted=$comment />
                @endcan
            </div>

        @empty
        @endforelse

    </div>
    @auth
        <section class="rounded-b-lg mt-2">
            <form method="POST" wire:submit.prevent="create({{ $video }})">
                @csrf
                @honeypot
                <input type="hidden">

                <textarea class="w-full shadow-inner p-1 border-0 mb-1 rounded-lg shadow-md focus:shadow-outline text-sm"
                    placeholder="Add Comment here." wire:model.lazy="comment" required name="comment"
                    id="comment_content"></textarea>
                <button class="font-semibold py-1 px-2 bg-purple-400 text-sm text-white shadow-md rounded-lg ">Comment
                </button>
            </form>
        </section>
    @endauth
</div>
