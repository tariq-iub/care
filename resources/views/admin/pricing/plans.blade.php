@extends('layouts.pricing')

@section('content')
    <div class="container mt-5">
        <!-- Tabs Navigation -->
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-monthly-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-monthly" type="button" role="tab" aria-controls="pills-monthly"
                        aria-selected="true">Monthly
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-yearly-tab" data-bs-toggle="pill" data-bs-target="#pills-yearly"
                        type="button" role="tab" aria-controls="pills-yearly" aria-selected="false">Yearly
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-lifetime-tab" data-bs-toggle="pill" data-bs-target="#pills-lifetime"
                        type="button" role="tab" aria-controls="pills-lifetime" aria-selected="false">Lifetime
                </button>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content" id="pills-tabContent">
            <!-- Monthly Plans -->
            <div class="tab-pane fade show active" id="pills-monthly" role="tabpanel"
                 aria-labelledby="pills-monthly-tab">
                <div class="row">
                    @foreach ($monthlyPlans as $plan)
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                            <img class="mb-4 d-dark-none" src="{{ asset('assets/img/spot-illustrations/13.png') }}" alt="" width="120" height="96">

                            <img class="mb-4 d-light-none" src="{{ asset('assets/img/spot-illustrations/dark_13.png') }}" alt="" width="120" height="96">

                            <div class="mb-sm-5 pricing-column-title-box">
                                <h3 class="mb-2">{{ $plan->title }}</h3>
                                <p class="text-800 mb-0 pe-3">{{ $plan->description }}</p>
                            </div>

                            <div class="d-flex align-items-center mb-4">
                                <h3 class="display-3 fw-bolder">{{ $plan->price }}</h3>
                            </div>

                            <button class="btn btn-lg w-100 mb-6 btn-outline-primary">Buy</button>

                            <h5 class="mb-4">What’s included</h5>

                            <ul class="fa-ul" style="--fa-li-margin: 1.5em;">
                                @foreach($features as $feature)
                                    @if ($loop->first)
                                        <li class="text-body-secondary mb-2">@include('admin.pricing.components.blue-tick') {{ $feature->name }}</li>
                                    @else
                                        @if($plan->features->contains('id', $feature->id) && $plan->features->where('id', $feature->id)->first()->pivot->is_available)
                                            <li class="mb-2 text-body">@include('admin.pricing.components.feature-available') {{ $feature->name }}</li>
                                        @else
                                            <li class="mb-2 text-body-quaternary">@include('admin.pricing.components.feature-unavailable') {{ $feature->name }}</li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Yearly Plans -->
            <div class="tab-pane fade" id="pills-yearly" role="tabpanel" aria-labelledby="pills-yearly-tab">
                <div class="row">
                    @foreach ($yearlyPlans as $plan)
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                            <img class="mb-4 d-dark-none" src="{{ asset('assets/img/spot-illustrations/13.png') }}" alt="" width="120" height="96">

                            <img class="mb-4 d-light-none" src="{{ asset('assets/img/spot-illustrations/dark_13.png') }}" alt="" width="120" height="96">

                            <div class="mb-sm-5 pricing-column-title-box">
                                <h3 class="mb-2">{{ $plan->title }}</h3>
                                <p class="text-800 mb-0 pe-3">{{ $plan->description }}</p>
                            </div>

                            <div class="d-flex align-items-center mb-4">
                                <h3 class="display-3 fw-bolder">{{ $plan->price }}</h3>
                            </div>

                            <button class="btn btn-lg w-100 mb-6 btn-outline-primary">Buy</button>

                            <h5 class="mb-4">What’s included</h5>

                            <ul class="fa-ul" style="--fa-li-margin: 1.5em;">
                                @foreach($features as $feature)
                                    @if ($loop->first)
                                        <li class="text-body-secondary mb-2">@include('admin.pricing.components.blue-tick') {{ $feature->name }}</li>
                                    @else
                                        @if($plan->features->contains('id', $feature->id) && $plan->features->where('id', $feature->id)->first()->pivot->is_available)
                                            <li class="mb-2 text-body">@include('admin.pricing.components.feature-available') {{ $feature->name }}</li>
                                        @else
                                            <li class="mb-2 text-body-quaternary">@include('admin.pricing.components.feature-unavailable') {{ $feature->name }}</li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Lifetime Plans -->
            <div class="tab-pane fade" id="pills-lifetime" role="tabpanel" aria-labelledby="pills-lifetime-tab">
                <div class="row">
                    @foreach ($lifetimePlans as $plan)
                        <div class="col-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                            <img class="mb-4 d-dark-none" src="{{ asset('assets/img/spot-illustrations/13.png') }}" alt="" width="120" height="96">

                            <img class="mb-4 d-light-none" src="{{ asset('assets/img/spot-illustrations/dark_13.png') }}" alt="" width="120" height="96">

                            <div class="mb-sm-5 pricing-column-title-box">
                                <h3 class="mb-2">{{ $plan->title }}</h3>
                                <p class="text-800 mb-0 pe-3">{{ $plan->description }}</p>
                            </div>

                            <div class="d-flex align-items-center mb-4">
                                <h3 class="display-3 fw-bolder">{{ $plan->price }}</h3>
                            </div>

                            <button class="btn btn-lg w-100 mb-6 btn-outline-primary">Buy</button>

                            <h5 class="mb-4">What’s included</h5>

                            <ul class="fa-ul" style="--fa-li-margin: 1.5em;">
                                @foreach($features as $feature)
                                    @if ($loop->first)
                                        <li class="text-body-secondary mb-2">@include('admin.pricing.components.blue-tick') {{ $feature->name }}</li>
                                    @else
                                        @if($plan->features->contains('id', $feature->id) && $plan->features->where('id', $feature->id)->first()->pivot->is_available)
                                            <li class="mb-2 text-body">@include('admin.pricing.components.feature-available') {{ $feature->name }}</li>
                                        @else
                                            <li class="mb-2 text-body-quaternary">@include('admin.pricing.components.feature-unavailable') {{ $feature->name }}</li>
                                        @endif
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
