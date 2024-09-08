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
                        @include('admin.pricing.partials.plan-card', ['plan' => $plan, 'features' => $features, 'user' => $user])
                    @endforeach
                </div>
            </div>

            <!-- Yearly Plans -->
            <div class="tab-pane fade" id="pills-yearly" role="tabpanel" aria-labelledby="pills-yearly-tab">
                <div class="row">
                    @foreach ($yearlyPlans as $plan)
                        @include('admin.pricing.partials.plan-card', ['plan' => $plan, 'features' => $features, 'user' => $user])
                    @endforeach
                </div>
            </div>

            <!-- Lifetime Plans -->
            <div class="tab-pane fade" id="pills-lifetime" role="tabpanel" aria-labelledby="pills-lifetime-tab">
                <div class="row">
                    @foreach ($lifetimePlans as $plan)
                        @include('admin.pricing.partials.plan-card', ['plan' => $plan, 'features' => $features, 'user' => $user])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
