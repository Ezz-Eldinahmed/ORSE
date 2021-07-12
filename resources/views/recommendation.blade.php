@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <x-header-component message="Take Task" header="Recommendation" />

    <div class="overflow-x-hidden bg-gray-100">
        <div class="container flex flex-col px-4 py-6 mx-auto text-lg text-center bg-white rounded-lg shadow-md">
            <ul id="quiz" class="list-group">
            </ul>
            <div class="container text-center results hide">
                <form>
                    @csrf
                    <p id="results"></p>
                </form>
            </div>
            <div class="container mt-5 text-center bottom">
                <button id="submit-btn"
                    class="px-2 py-1 text-lg text-green-100 bg-gray-600 rounded hover:bg-gray-500">Submit</button>

                <button id="retake-btn"
                    class="px-2 py-1 text-lg text-green-100 bg-gray-600 rounded hide hover:bg-gray-500">Retake Quiz</button>
            </div>
        </div>
    </div>
    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

@endsection
