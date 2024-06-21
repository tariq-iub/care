@extends('layouts.app')
@section('title', 'Confirm Password')

@section('content')
    <div id="home">
        <div class="main-slider">
            <div id="container-inside">
                <svg class="editorial"
                     xmlns="https://www.w3.org/2000/svg"
                     xmlns:xlink="https://www.w3.org/1999/xlink"
                     viewBox="0 24 150 28"
                     preserveAspectRatio="none">
                    <defs>
                        <path id="gentle-wave"
                              d="M-160 44c30 0
                                 58-18 88-18s
                                 58 18 88 18
                                 58-18 88-18
                                 58 18 88 18
                                 v44h-352z" />
                    </defs>
                    <g class="parallax">
                        <use xlink:href="#gentle-wave" x="50" y="0" fill="#4329b7"/>
                        <use xlink:href="#gentle-wave" x="50" y="3" fill="#382299"/>
                        <use xlink:href="#gentle-wave" x="50" y="6" fill="#38258e"/>
                    </g>
                </svg>
            </div>
            <div class="slider-content">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="iq-card">
                            <div class="iq-card-header pt-3">
                                <div class="iq-header-title">
                                    <h4 class="card-title">CARE 360 - {{ __('Confirm Password') }}</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                {{ __('Please confirm your password before continuing.') }}

                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary px-5 mr-2">
                                        {{ __('Confirm Password') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link float-right" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
