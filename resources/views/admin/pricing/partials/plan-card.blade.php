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

    <form action="{{ route('checkout') }}" method="POST">
        @csrf
        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}">
        <input type="hidden" id="plan_id" name="plan_id" value="{{ $plan->id }}">
        <button type="submit" class="btn btn-lg w-100 mb-6 btn-outline-primary">Buy</button>
    </form>

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

@push('scripts')
    <script>
    </script>
@endpush
