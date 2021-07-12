@extends('layouts.app')
@section('content')

<x-header-component message="Edit" />

<section class="section gb nopadtop">
    <div class="container">
        <div class="boxed">
            <div class="row">
                <div class="col-md-8">

                    <x-show-alert />

                    <form method="POST" action="{{ route('user.update',auth()->user()->id) }}">
                        @csrf
                        @honeypot
                        @method('PUT')

                        <div class="form-group row">
                            <h4 for="name" class="col-md-6">{{ __('User Name') }}</h4>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <h4 for="email" class="col-md-6">{{ __('E-Mail Address') }}</h4>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" disabled value="{{  $user->email  }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- end row -->
        </div><!-- end boxed -->
</section>

@endsection
