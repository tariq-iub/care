@extends('layouts.app')
@section('title', 'Email Verification')

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
                                    <h4 class="card-title">CARE 360 - {{ __('Verify Your Email Address') }}</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }},
                                <form method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary px-5 m-0 align-baseline">
                                        {{ __('click here to request another') }}
                                    </button>.
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
