<div>
    @if (auth()->user()->id != $user->id)
        <button wire:click.prevent="follow({{ $user }})"
            class="font-semibold text-white bg-yellow-300 rounded py-1 px-2">
            @if (auth()->user()->following($user))
                UnFollow
            @else
                Follow
            @endif
        </button>
    @endif
</div>
