@extends('layouts.app')
@section('title', 'Welcome')
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
                <div class="slider-logo wow fadeInUp" data-wow-duration="0.6s">
                    <img class="logo img-fluid" src="{{ asset('assets/images/logo-full.png') }}" alt="image">
                </div>
                <div class="text-center slider-text m-3 wow fadeInUp" data-wow-duration="0.8s">
                    <p class="mb-0">CARE 360 - Device Monitoring <br> IoT System For Your Industry</p>
                </div>
            </div>
        </div>
    </div>
@endsection
