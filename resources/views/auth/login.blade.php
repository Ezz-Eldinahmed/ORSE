@extends('layouts.login')

@section('content')

<section class="flex items-stretch text-white">
    <div class="lg:flex w-1/2 hidden bg-yellow-300 bg-no-repeat bg-cover relative items-center">
        <div class="absolute bg-red opacity-20 inset-0 z-0"></div>
        <div class="w-full px-24 z-10">
            <h1 class="text-5xl font-bold text-left tracking-wide">ORSE</h1>
            <p class="text-3xl my-4">Learn And Improve Your Self</p>
        </div>
    </div>

    <div class="lg:w-1/2 w-full flex items-center justify-center text-center md:px-16 pb-13 z-0"
        style="background-color: #128386;">
        <div class="absolute lg:hidden z-10 inset-0 bg-gray-500 bg-no-repeat bg-cover items-center">
            <div style="background-color: #128386" class="absolute opacity-60 inset-0 z-0"></div>
        </div>
        <div class="w-full py-6 z-20">
            <div class="grid justify-items-center">
                <img src="/images/logo_login.png" width="20%">
            </div>
            <div class="py-6 space-x-2">
                <a href="login/facebook"><span
                        class="w-10 h-10 items-center bg-blue-600 justify-center hover:bg-blue-900 inline-flex rounded-full font-bold text-lg border-2 border-white">f</span></a>
                <a href="login/google"><span
                        class="w-10 h-10 items-center bg-red-600 justify-center hover:bg-red-900 inline-flex rounded-full font-bold text-lg border-2 border-white">G+</span></a>
                <p class="text-gray-100 pt-4 uppercase">
                    or use email your account
                </p>

            </div>

            <x-show-alert />

            <form method="POST" action="{{ route('login') }}" class="sm:w-2/3 w-full px-4 lg:px-0 mx-auto">
                @csrf

                <div class="pb-2">
                    <input type="email" name="email" id="email" autofocus required placeholder="Email"
                        value="{{old('email')}}" class="block w-full p-4 text-black text-lg rounded-md bg-white">
                </div>
                <div class="pb-2 pt-4">
                    <input class="block w-full p-4 text-lg text-black rounded-md bg-white" placeholder="Password"
                        class="block mt-1 w-full" type="password" name="password" required>
                </div>

                <a class="underline text-sm text-white hover:text-yellow-300" href="{{ route('register') }}">
                    {{ __('Register New Account') }}
                </a>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-white">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="text-right text-yellow-400 hover:underline hover:text-yellow-200">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-white hover:text-yellow-200"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                </div>

                <div class="px-4 pb-2 pt-4">

                    <button
                        class="uppercase block w-full p-4 text-lg rounded-full bg-indigo-500 hover:bg-indigo-600 focus:outline-none">sign
                        in</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
