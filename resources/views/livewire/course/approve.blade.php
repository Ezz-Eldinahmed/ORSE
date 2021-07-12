<div>
    <x-show-alert />

    <div class="flex flex-col my-2 sm:flex-row">
        <div class="flex flex-row mb-1 sm:mb-0">
            <div class="relative">
                <select wire:model='course_filter'
                    class="block w-full h-full px-4 py-2 pr-8 leading-tight text-gray-700 bg-white border-t border-b border-r border-gray-400 rounded-r appearance-none sm:rounded-r-none sm:border-r-0 focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                    <option value='all'>All</option>
                    <option value='ِapproved'>ِApproved</option>
                    <option value='pending'>Pending</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg>
                </div>
            </div>
        </div>
        <div class="relative block">
            <span class="absolute inset-y-0 left-0 flex items-center h-full pl-2">
                <svg viewBox="0 0 24 24" class="w-4 h-4 text-gray-500 fill-current">
                    <path
                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                    </path>
                </svg>
            </span>
            <input placeholder="Search" wire:model.debounce.200ms="search" type="search"
                class="block w-full py-2 pl-8 pr-6 text-sm text-gray-700 placeholder-gray-400 bg-white border border-b border-gray-400 rounded-l rounded-r appearance-none sm:rounded-l-none focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
        </div>
    </div>

    <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            Name
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            Description
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            Approved
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            Instructor
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            Price
                        </th>
                        <th
                            class="px-5 py-3 text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-100 border-b-2 border-gray-200">
                            Created at
                            <button wire:click.prevent="sortDesc()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button wire:click.prevent="sortAsc()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 13l-5 5m0 0l-5-5m5 5V6" />
                                </svg> </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                    <tr>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="p-3 font-medium text-white whitespace-no-wrap bg-yellow-300 rounded">
                                        <a href="{{ route('course.show', $course) }}">
                                            {{ $course->name }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900">
                                {{ $course->description }}
                            </p>
                        </td>
                        <td class="px-5 py-5 bg-white border-b border-gray-200 text-md">
                            <p class="text-gray-900 whitespace-no-wrap">
                                <form method="POST" wire:submit.prevent="approve({{ $course }})">
                                    @csrf
                                    @honeypot

                                    <button class="button">
                                        <span>
                                            @if ($course->approved == 1)
                                            <span class="px-2 py-3 text-white bg-green-300 rounded">Approved</span>
                                            @else
                                            <span class="px-2 py-3 text-white bg-blue-300 rounded">pending</span>
                                            @endif
                                        </span>
                                    </button>
                                </form>
                            </p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $course->instructor->user->name }}
                            </p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $course->price }}
                            </p>
                        </td>
                        <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                            <span class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                <span aria-hidden class="absolute inset-0 bg-green-200 rounded-full opacity-50"></span>
                                <span class="relative">{{ $course->created_at->diffForHumans() }}</span>
                            </span>
                        </td>
                    </tr>
                    @empty
                    <p class="p-5 m-5 font-bold text-white bg-purple-400 rounded shadow-lg">No Course Founded</p>
                    @endforelse

                </tbody>
            </table>

        </div>
        <x-Links-component :paginator=$courses />
    </div>
</div>
