<div>
    @can('takeExam',$course)
    @if ($course->exams->where('view', 1)->count() > 0)
    <div class="-mx-8">
        <div class="px-8 pb-2">
            <h1 class="mb-2 text-xl font-bold text-gray-700">Exam</h1>
            <div class="flex flex-col max-w-sm px-6 py-4 mx-auto bg-white rounded-lg shadow-md">
                @forelse ($course->exams->where('view',1) as $exam)
                <p class="mb-5">
                    <a class="px-4 py-2 text-sm font-bold text-white bg-blue-400 rounded-lg shadow-md"
                        href="{{ route('exam.take', $exam) }}">Take Exam level : {{ $exam->level }} And Get
                        Certificate
                    </a>
                </p>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    @endif
    @endcan

    @can('viewCourse', $course)
    @if ($course->exams->count() > 0)
    <div class="-mx-8">
        <div class="px-8 pb-2">
            <h1 class="mb-2 text-xl font-bold text-gray-700">Exam</h1>
            <div class="flex flex-col max-w-sm px-6 py-4 mx-auto bg-white rounded-lg shadow-md">
                @forelse ($course->exams as $exam)
                <p class="mb-5">
                    <a class="px-4 py-2 text-sm font-bold text-white bg-blue-400 rounded-lg shadow-md"
                        href="{{ route('exam.show', $exam) }}">Exam level : {{ $exam->level }}
                    </a>
                </p>
                @empty
                @endforelse
            </div>
        </div>
    </div>
    @endif

    <div x-data="{ showModal : false }">
        <!-- Button -->
        <ul class="max-w-sm px-4 py-4 mb-3 bg-white rounded-lg shadow-md">
            <button @click="showModal = !showModal"
                class="px-4 py-1 ml-2 font-semibold text-gray-200 bg-red-500 border border-red-500 rounded cursor-pointer btn">Create
                Exam
            </button>
        </ul>
        <!-- Modal Background -->
        <div x-show="showModal"
            class="fixed top-0 bottom-0 left-0 right-0 z-50 flex items-center justify-center overflow-auto text-gray-500 bg-black bg-opacity-50"
            x-transition:enter="transition ease duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <!-- Modal -->
            <div x-show="showModal" class="max-w-3xl p-6 mx-10 bg-white shadow-2xl rounded-xl sm:w-10/12"
                @click.away="showModal = false" x-transition:enter="transition ease duration-100 transform"
                x-transition:enter-start="opacity-0 scale-90 translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease duration-100 transform"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-90 translate-y-1">

                <form method="POST" action="{{ route('exam.store', $course) }}">
                    @csrf
                    @honeypot
                    <div class="px-8 py-4">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">
                                <label for="level">Choose Exam Level:</label>
                                <select name="level"
                                    class="px-4 py-2 ml-2 text-lg font-bold text-white bg-blue-500 rounded-lg shadow-md">
                                    <option value="1">Easy</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Hard</option>
                                </select>
                            </h2>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-4 py-2 text-lg font-bold text-white bg-blue-500 rounded-lg shadow-md">Submit</button>
                        </div>
                    </div>
                </form>
                <button @click="showModal = !showModal"
                    class="px-4 py-2 ml-3 text-sm font-bold text-gray-500 transition-colors duration-150 ease-linear bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-0 hover:bg-gray-50 focus:bg-indigo-100 focus:text-indigo">Cancel</button>
            </div>
        </div>
    </div>
    @endcan
</div>
