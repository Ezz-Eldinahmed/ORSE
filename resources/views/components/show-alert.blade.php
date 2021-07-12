<div>
    <div class="mt-4">
        @if($errors->any())
        <div class="px-6 py-4 mb-4 bg-red-100">
            @foreach ($errors->all() as $error)
            <li class="text-md font-bold text-red-500 text-sm">{{ $error }}</li>
            @endforeach
        </div>
        @endif

        @if (session()->has('success'))
        <div class="p-2">
            <div class="inline-flex items-center bg-white leading-none text-green-600 rounded-full p-2 shadow text-sm">
                <span
                    class="inline-flex bg-green-600 text-white rounded-full h-6 px-3 justify-center items-center text-">SUCCESS</span>
                <span class="inline-flex px-2">{{ session()->get('success') }}</span>
            </div>
        </div>
        @endif

        @if (session()->has('danger'))
        <div class="p-2">
            <div class="inline-flex items-center bg-white leading-none text-red-600 rounded-full p-2 shadow text-sm">
                <span
                    class="inline-flex bg-red-600 text-white rounded-full h-6 px-3 justify-center items-center text-">Failed</span>
                <span class="inline-flex px-2">{{ session()->get('danger') }}</span>
            </div>
        </div>
        @endif

        @if (session()->has('message'))
        <div class="p-2">
            <div class="inline-flex items-center bg-white leading-none text-blue-600 rounded-full p-2 shadow text-sm">
                <span
                    class="inline-flex bg-blue-600 text-white rounded-full h-6 px-3 justify-center items-center text-">Info</span>
                <span class="inline-flex px-2">{{ session()->get('message') }}</span>
            </div>
        </div>
        @endif
    </div>
</div>
