<a href="{{route($route,$redirect)}}" class="flex items-center px-4 py-3 -mx-2 border-b hover:bg-gray-100">
    <p class="mx-2 text-sm text-gray-600">
        <span class="font-bold" href="#">
            {{$notification->data['user']['name']}}
        </span> {{ $message }}
        <span class="font-bold text-blue-500" href="#">{{$action}}</span>
        <small class="float-right pt-2">{{ $notification->created_at->diffForHumans()}}</small>
    </p>
</a>
