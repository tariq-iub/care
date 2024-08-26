@extends('layouts.auth')

@section('content')
    <div class="px-xxl-5">
        <div class="text-center mb-6">
            <h4 class="text-body-highlight">Set Password</h4>
            <p class="text-body-tertiary mb-5">Enter password below to set a password for your <br class="d-sm-none"/>account.
            </p>
            <form class="mb-5" method="POST" action="{{ route('update.new.password') }}">
                @csrf
                <input type="hidden" name="userId" value="{{ $userId }}">

                <div class="mb-3 text-start">
                    <label class="form-label" for="password">Password</label>
                    <div class="form-icon-container">
                        <input class="form-control form-icon-input @error('password') is-invalid @enderror"
                               id="password" name="password" type="password" placeholder="Password"
                               required autocomplete="current-password"/>
                        <span class="fas fa-key text-body fs-9 form-icon"></span>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label" for="password-confirm">Confirm Password</label>
                    <div class="form-icon-container">
                        <input class="form-control form-icon-input" type="password"
                               id="password-confirm" name="password_confirmation" required
                               autocomplete="current-password" placeholder="Current Password"/>
                        <span class="fas fa-key text-body fs-9 form-icon"></span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">Set Password</button>
            </form>
        </div>
    </div>
@endsection
