<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .error-bg {
            background-image: url("https://i.pinimg.com/originals/78/54/dc/7854dccccc6f6abb22aea0fc7426df42.jpg");
        }

        .tracking-tighter-less {
            letter-spacing: -0.75rem;
        }

        .text-shadow {
            text-shadow: -8px 0 0 rgb(102 123 242);
        }
    </style>
</head>

<body>
    <div class="flex items-center justify-center max-h-full min-h-screen max-w-full min-w-screen bg-blue-500 bg-fixed bg-cover error-bg"
        style="background-image: url('/images/error.jpg');">

        <div class="container">
            <div class="row">
                <div class="col-sm-8 offset-sm-2 text-gray-50 text-center">
                    <div class="relative">
                        <h1 class="relative text-9xl tracking-tighter-less text-shadow font-sans font-bold">
                            <span>@yield('code')</span></h1>
                        <span class="absolute top-0 -ml-12 text-gray-600 font-semibold">Oops!</span>
                    </div>
                    <h5 class="text-gray-700 font-semibold">@yield('message')</h5>
                    <p class="text-gray-700 mt-2 mb-6">we are sorry, but the page you requested was not found</p>
                    <a href="{{route('home')}}"
                        class="bg-yellow-400  px-5 py-3 text-sm shadow-sm font-medium tracking-wider text-gray-50 rounded-full hover:shadow-lg">
                        Got to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
