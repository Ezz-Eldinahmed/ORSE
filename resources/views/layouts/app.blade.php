<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H98G6TSBNK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-H98G6TSBNK');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ORSE') }}</title>

    <link rel="icon" href="/images/logo_sm.png" type="image/png" sizes="16x16">

    <meta name="ORSE" content="E-learning Platform">
    <meta property="og:title" content="ORSE" />
    <meta property="og:type" content="Learning Platform Improve Your Ability" />
    <meta property="og:url" content="https://www.orse.herokuapp.com/" />
    <meta property="og:image" content="/images/logo_sm.png" />
    <meta name="description" content="E-Learning Platform">
    <meta name="keywords"
        content="Course,Study,Learning,E-Learning,Platform,Improve,orse,categories,free,learning,question,notification,welcome,ORSE,people,social">
    <meta name="author" content="ezzeldinahmed99@gmail.com">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles
    <style>
        html {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(13deg, #7bcfeb 14%, #e685d3 64%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(13deg, #c7ceff 14%, #f9d4ff 64%);
        }

        ::-webkit-scrollbar-track {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: inset 7px 10px 12px #f0f0f0;
        }
    </style>
</head>

<body>
    <div class="bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Content -->
        <main>
            <div class="flex bg-green-300">
                <div class="flex flex-col flex-1 overflow-hidden">
                    <div class="flex h-full">
                        <nav class="flex hidden w-1/6 h-full bg-gray-200 sm:block">
                        </nav>
                        <main class="flex flex-col w-full overflow-x-hidden overflow-y-auto bg-white">
                            @yield('content')
                        </main>
                        <nav class="flex hidden w-1/6 h-full bg-gray-200 sm:block">
                        </nav>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <x-footer-component />
    @stack('modals')

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

    <script src="{{ mix('js/app.js') }}" defer></script>
</body>

</html>
