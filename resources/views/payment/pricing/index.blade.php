@extends('layouts.pricing')

@section('content')
    <nav class="mb-2" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="#!">Pages</a></li>
            <li class="breadcrumb-item active">Pricing</li>
        </ol>
    </nav>

    <h2 class="mb-7">Pricing</h2>

    <div class="row g-7 g-lg-11 mb-7">
        <div class="col-12 col-sm-6 col-xxl-3"><img class="mb-4 d-dark-none"
                                                    src="{{ asset('assets/img/spot-illustrations/13.png') }}" alt=""
                                                    width="120" height="96"><img class="mb-4 d-light-none"
                                                                                 src="{{ asset('assets/img/spot-illustrations/dark_13.png') }}"
                                                                                 alt="" width="120" height="96">
            <div class="mb-sm-5 pricing-column-title-box">
                <h3 class="mb-2">Learner</h3>
                <p class="text-800 mb-0 pe-3">For individuals who are interested in giving it a shot first.</p>
            </div>
            <div class="d-flex align-items-center mb-4">
                <h3 class="display-3 fw-bolder">Free</h3>
            </div>
            <button class="btn btn-lg w-100 mb-6 btn-outline-primary">Buy</button>
            <h5 class="mb-4">What’s included</h5>
            <ul class="fa-ul" style="--fa-li-margin: 1.5em;">
                <li class="text-800 mb-2"><span class="fa-li"><svg class="svg-inline--fa fa-check text-primary"
                                                                   aria-hidden="true" focusable="false"
                                                                   data-prefix="fas" data-icon="check" role="img"
                                                                   xmlns="http://www.w3.org/2000/svg"
                                                                   viewBox="0 0 448 512" data-fa-i2svg=""><path
                                fill="currentColor"
                                d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg>
                        <!-- <span class="fas fa-check text-primary"></span> Font Awesome fontawesome.com --></span>Timeline
                </li>
                <li class="mb-2 text-500"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-300" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-300"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-xmark fa-stack-1x fa-inverse text-600" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="xmark" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-times text-600"></span> Font Awesome fontawesome.com --></span></span>Advanced
                    Search
                </li>
                <li class="mb-2 text-500"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-300" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-300"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-xmark fa-stack-1x fa-inverse text-600" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="xmark" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-times text-600"></span> Font Awesome fontawesome.com --></span></span>Custom
                    fields
                </li>
                <li class="mb-2 text-500"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-300" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-300"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-xmark fa-stack-1x fa-inverse text-600" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="xmark" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-times text-600"></span> Font Awesome fontawesome.com --></span></span>Task
                    dependencies
                </li>
                <li class="mb-2 text-500"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-300" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-300"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-xmark fa-stack-1x fa-inverse text-600" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="xmark" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-times text-600"></span> Font Awesome fontawesome.com --></span></span>Private
                    teams &amp; projects
                </li>
            </ul>
        </div>
        <div class="col-12 col-sm-6 col-xxl-3"><img class="mb-4 d-dark-none"
                                                    src="{{ asset('assets/img/spot-illustrations/14.png') }}" alt=""
                                                    width="120" height="96"><img class="mb-4 d-light-none"
                                                                                 src="{{ asset('assets/img/spot-illustrations/dark_14.png') }}"
                                                                                 alt="" width="120" height="96">
            <div class="mb-sm-5 pricing-column-title-box">
                <h3 class="mb-2">Starter</h3>
                <p class="text-800 mb-0 pe-3">For teams that need to create project plans with confidence.</p>
            </div>
            <div class="d-flex align-items-center mb-4">
                <h3 class="display-3 fw-bolder">$14.99</h3>
                <h5 class="fs-0 fw-normal ms-1">/ month</h5>
            </div>
            <button class="btn btn-lg w-100 mb-6 btn-outline-primary">Buy</button>
            <h5 class="mb-4">What’s included</h5>
            <ul class="fa-ul" style="--fa-li-margin: 1.5em;">
                <li class="text-800 mb-2"><span class="fa-li"><svg class="svg-inline--fa fa-check text-primary"
                                                                   aria-hidden="true" focusable="false"
                                                                   data-prefix="fas" data-icon="check" role="img"
                                                                   xmlns="http://www.w3.org/2000/svg"
                                                                   viewBox="0 0 448 512" data-fa-i2svg=""><path
                                fill="currentColor"
                                d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg>
                        <!-- <span class="fas fa-check text-primary"></span> Font Awesome fontawesome.com --></span>Timeline
                </li>
                <li class="mb-2 text-900"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-success" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-success"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-check fa-stack-1x fa-inverse text-white" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="check" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-check text-white"></span> Font Awesome fontawesome.com --></span></span>Advanced
                    Search
                </li>
                <li class="mb-2 text-500"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-300" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-300"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-xmark fa-stack-1x fa-inverse text-600" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="xmark" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-times text-600"></span> Font Awesome fontawesome.com --></span></span>Custom
                    fields
                </li>
                <li class="mb-2 text-500"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-300" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-300"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-xmark fa-stack-1x fa-inverse text-600" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="xmark" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-times text-600"></span> Font Awesome fontawesome.com --></span></span>Task
                    dependencies
                </li>
                <li class="mb-2 text-500"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-300" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-300"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-xmark fa-stack-1x fa-inverse text-600" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="xmark" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-times text-600"></span> Font Awesome fontawesome.com --></span></span>Private
                    teams &amp; projects
                </li>
            </ul>
        </div>
        <div class="col-12 col-sm-6 col-xxl-3"><img class="mb-4 d-dark-none"
                                                    src="{{ asset('assets/img/spot-illustrations/15.png') }}" alt=""
                                                    width="120" height="96"><img class="mb-4 d-light-none"
                                                                                 src="{{ asset('assets/img/spot-illustrations/dark_15.png') }}"
                                                                                 alt="" width="120" height="96">
            <div class="mb-sm-5 pricing-column-title-box">
                <h3 class="mb-2">Team</h3>
                <p class="text-800 mb-0 pe-3">For teams that need to manage work across initiatives.</p>
            </div>
            <div class="d-flex align-items-center mb-4">
                <h3 class="display-3 fw-bolder">$49.99</h3>
                <h5 class="fs-0 fw-normal ms-1">/ month</h5>
            </div>
            <button class="btn btn-lg w-100 mb-6 btn-primary">Buy</button>
            <h5 class="mb-4">What’s included</h5>
            <ul class="fa-ul" style="--fa-li-margin: 1.5em;">
                <li class="text-800 mb-2"><span class="fa-li"><svg class="svg-inline--fa fa-check text-primary"
                                                                   aria-hidden="true" focusable="false"
                                                                   data-prefix="fas" data-icon="check" role="img"
                                                                   xmlns="http://www.w3.org/2000/svg"
                                                                   viewBox="0 0 448 512" data-fa-i2svg=""><path
                                fill="currentColor"
                                d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg>
                        <!-- <span class="fas fa-check text-primary"></span> Font Awesome fontawesome.com --></span>Timeline
                </li>
                <li class="mb-2 text-900"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-success" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-success"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-check fa-stack-1x fa-inverse text-white" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="check" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-check text-white"></span> Font Awesome fontawesome.com --></span></span>Advanced
                    Search
                </li>
                <li class="mb-2 text-900"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-success" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-success"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-check fa-stack-1x fa-inverse text-white" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="check" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-check text-white"></span> Font Awesome fontawesome.com --></span></span>Custom
                    fields<span class="badge badge-phoenix badge-phoenix-primary ms-2 fs--2">New</span></li>
                <li class="mb-2 text-500"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-300" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-300"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-xmark fa-stack-1x fa-inverse text-600" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="xmark" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-times text-600"></span> Font Awesome fontawesome.com --></span></span>Task
                    dependencies
                </li>
                <li class="mb-2 text-500"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-300" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-300"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-xmark fa-stack-1x fa-inverse text-600" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="xmark" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-times text-600"></span> Font Awesome fontawesome.com --></span></span>Private
                    teams &amp; projects
                </li>
            </ul>
        </div>
        <div class="col-12 col-sm-6 col-xxl-3"><img class="mb-4 d-dark-none"
                                                    src="{{ asset('assets/img/spot-illustrations/16.png') }}" alt=""
                                                    width="120" height="96"><img class="mb-4 d-light-none"
                                                                                 src="{{ asset('assets/img/spot-illustrations/dark_16.png') }}"
                                                                                 alt="" width="120" height="96">
            <div class="mb-sm-5 pricing-column-title-box">
                <h3 class="mb-2">Industry</h3>
                <p class="text-800 mb-0 pe-3">For organizations that need additional security and support.</p>
            </div>
            <div class="d-flex align-items-center mb-4">
                <h3 class="display-3 fw-bolder">$149.99</h3>
                <h5 class="fs-0 fw-normal ms-1">/ month</h5>
            </div>
            <button class="btn btn-lg w-100 mb-6 btn-outline-primary">Buy</button>
            <h5 class="mb-4">What’s included</h5>
            <ul class="fa-ul" style="--fa-li-margin: 1.5em;">
                <li class="text-800 mb-2"><span class="fa-li"><svg class="svg-inline--fa fa-check text-primary"
                                                                   aria-hidden="true" focusable="false"
                                                                   data-prefix="fas" data-icon="check" role="img"
                                                                   xmlns="http://www.w3.org/2000/svg"
                                                                   viewBox="0 0 448 512" data-fa-i2svg=""><path
                                fill="currentColor"
                                d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg>
                        <!-- <span class="fas fa-check text-primary"></span> Font Awesome fontawesome.com --></span>Timeline
                </li>
                <li class="mb-2 text-900"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-success" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-success"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-check fa-stack-1x fa-inverse text-white" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="check" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-check text-white"></span> Font Awesome fontawesome.com --></span></span>Advanced
                    Search
                </li>
                <li class="mb-2 text-900"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-success" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-success"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-check fa-stack-1x fa-inverse text-white" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="check" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-check text-white"></span> Font Awesome fontawesome.com --></span></span>Custom
                    fields<span class="badge badge-phoenix badge-phoenix-primary ms-2 fs--2">New</span></li>
                <li class="mb-2 text-900"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-success" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-success"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-check fa-stack-1x fa-inverse text-white" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="check" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-check text-white"></span> Font Awesome fontawesome.com --></span></span>Task
                    dependencies
                </li>
                <li class="mb-2 text-900"><span class="fa-li me-2 stack-icon-item"><span class="fa-stack fs--3"><svg
                                class="svg-inline--fa fa-circle fa-stack-2x text-success" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="circle" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256z"></path></svg>
                            <!-- <span class="fas fa-circle fa-stack-2x text-success"></span> Font Awesome fontawesome.com --><svg
                                class="svg-inline--fa fa-check fa-stack-1x fa-inverse text-white" aria-hidden="true"
                                focusable="false" data-prefix="fas" data-icon="check" role="img"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path
                                    fill="currentColor"
                                    d="M438.6 105.4C451.1 117.9 451.1 138.1 438.6 150.6L182.6 406.6C170.1 419.1 149.9 419.1 137.4 406.6L9.372 278.6C-3.124 266.1-3.124 245.9 9.372 233.4C21.87 220.9 42.13 220.9 54.63 233.4L159.1 338.7L393.4 105.4C405.9 92.88 426.1 92.88 438.6 105.4H438.6z"></path></svg>
                            <!-- <span class="fas fa-stack-1x fa-inverse fa-check text-white"></span> Font Awesome fontawesome.com --></span></span>Private
                    teams &amp; projects
                </li>
            </ul>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
