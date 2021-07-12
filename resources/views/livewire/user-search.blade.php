<div>
    <div class="relative mx-4 lg:mx-0">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                <path
                    d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </svg>
        </span>

        <input type="search" wire:model.debounce.200ms="search" name="search"
            class="w-32 pl-10 pr-4 rounded-md form-input sm:w-64 focus:border-indigo-600" type="text"
            placeholder="Search">
    </div>

    <x-show-alert />

    <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            User Name
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            Email
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            Created at
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            Block
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="rounded-full" src="{{($user->image ? $user->image : '/user_10.jpg')}}"
                                        alt="avatar" />
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        <a href="{{route('admin.show',$user)}}">{{$user->name}}</a>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">{{$user->email}}</p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{$user->created_at->diffForHumans()}}
                            </p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                <span aria-hidden class="absolute inset-0 bg-green-200 rounded-full opacity-50"></span>
                                <span class="relative">
                                    <button
                                        onclick="block('Are you Sure You Want To Delete?') || event.preventDefault()"
                                        wire:click.prevent="block({{$user->id}})">@if($user->blocked_at != null)
                                        {{$user->blocked_at}}
                                        @else
                                        Block
                                        @endif
                                    </button>
                                </span>
                            </span>
                        </td>
                    </tr>
                    @empty
                    <p class="p-5 m-5 font-bold text-white bg-purple-400 rounded shadow-lg">No User Founded</p>
                    @endforelse

                </tbody>
            </table>

        </div>
        <x-Links-component :paginator=$users />
    </div>
</div>
