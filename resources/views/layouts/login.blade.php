<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ORSE') }}</title>

    <link rel="icon" href="/images/logo_sm.png" type="image/png" sizes="16x16">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H98G6TSBNK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-H98G6TSBNK');
    </script>
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
    @auth
    @livewire('navigation-menu')
    @endauth
    @guest
    <x-nav-bar-component />
    @endguest

    @yield('content')
    @stack('modals')

    @livewireScripts

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

    <script src="{{ mix('js/app.js') }}" defer></script>

</body>

</html>
