@extends('layouts.auth')

@section('content')
    <div class="text-center mb-7">
        <h3 class="text-body-highlight">Sign In</h3>
        <p class="text-body-tertiary">Get access to your account</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- User Name -->
        <div class="mb-3 text-start">
            <label class="form-label" for="username">User Name</label>
            <div class="form-icon-container">
                <input class="form-control form-icon-input @error('username') is-invalid @enderror"
                       id="username" name="username" type="text" placeholder="Your Username"
                       value="{{ old('username') }}" required autocomplete="username" autofocus/>
                <span class="fas fa-user text-body fs-9 form-icon"></span>
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <!-- Email Address -->
        <div class="mb-3 text-start">
            <label class="form-label" for="email">Email Address</label>
            <div class="form-icon-container">
                <input class="form-control form-icon-input @error('email') is-invalid @enderror"
                       id="email" name="email" type="email" placeholder="name@example.com"
                       value="{{ old('email') }}" required autocomplete="email"/>
                <span class="fas fa-envelope text-body fs-9 form-icon"></span>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <!-- Phone No -->
        <div class="mb-3 text-start">
            <label class="form-label" for="phone">Phone No</label>
            <div class="form-icon-container">
                <input class="form-control form-icon-input @error('phone') is-invalid @enderror"
                       id="phone" name="phone" type="tel" placeholder="Your Phone Number"
                       value="{{ old('phone') }}" required autocomplete="tel"/>
                <span class="fas fa-phone text-body fs-9 form-icon"></span>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <!-- Company Name -->
        <div class="mb-3 text-start">
            <label class="form-label" for="company_name">Company Name</label>
            <div class="form-icon-container">
                <input class="form-control form-icon-input @error('company_name') is-invalid @enderror"
                       id="company_name" name="company_name" type="text" placeholder="Your Company Name"
                       value="{{ old('company_name') }}" required autocomplete="organization"/>
                <span class="fas fa-building text-body fs-9 form-icon"></span>
                @error('company_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <!-- Company Address -->
        <div class="mb-3 text-start">
            <label class="form-label" for="company_address">Company Address</label>
            <div class="form-icon-container">
                <input class="form-control form-icon-input @error('company_address') is-invalid @enderror"
                       id="company_address" name="company_address" type="text" placeholder="Your Company Address"
                       value="{{ old('company_address') }}" required autocomplete="street-address"/>
                <span class="fas fa-map-marker-alt text-body fs-9 form-icon"></span>
                @error('company_address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <!-- Company City -->
        <div class="mb-3 text-start">
            <label class="form-label" for="company_city">Company City</label>
            <div class="form-icon-container">
                <input class="form-control form-icon-input @error('company_city') is-invalid @enderror"
                       id="company_city" name="company_city" type="text" placeholder="Your Company City"
                       value="{{ old('company_city') }}" required autocomplete="address-level2"/>
                <span class="fas fa-city text-body fs-9 form-icon"></span>
                @error('company_city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
    </form>
    <div class="text-center d-flex justify-content-center align-items-center">
        <p class="fs-9 fw-bold mb-0 me-1">Already have an account?</p>
        <a class="fs-9 fw-bold" href="{{ route('login') }}">Login</a>
    </div>
@endsection
