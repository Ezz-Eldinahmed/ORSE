@extends('layouts.app')

@section('content')
<x-header-component message="{{ __('Verify Your Email Address') }}" />

<section class="section gb nopadtop">
    <div class="container">
        <div class="boxed">
            <div class="row">
                <div class="col-md-8">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    <h4>{{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                    </h4>

                    <br>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf

                        <button type="submit"
                            class="btn btn-primary">{{ __('click here to request another') }}</button>.
                    </form>

                </div><!-- end row -->
            </div><!-- end boxed -->
        </div><!-- end container -->
</section>

@endsection
