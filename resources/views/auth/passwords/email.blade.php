@extends('layouts.app')
@section('title', 'Reset Password')

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
                                    <h4 class="card-title">CARE 360 - {{ __('Reset Password') }}</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">{{ __('Email Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary px-5 mr-2">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
