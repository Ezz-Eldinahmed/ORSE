<div class="max-w-xs px-4 py-2 bg-white rounded-lg shadow-lg">
    <div>
        <p class="font-semibold text-gray-800 text-md">
            <a href="{{route($route ,$redirect)}}" class="text-gray-500 text-md">
                {{ $message }}
                <span class="text-blue-500 font-regular">{{ $action }} </span>
            </a>
        </p>
    </div>
    <div class="flex justify-end mt-2">
        <p class="text-sm text-indigo-500">
            {{ $notification->created_at->diffForHumans()}}
        </p>
    </div>
</div>
