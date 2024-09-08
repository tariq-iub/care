@extends('layouts.pricing')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Checkout Success</div>

                    <div class="card-body">
                        <h1>Thank you for your purchase!</h1>
                        <p>Your session ID is: {{ $checkoutSession->id }}</p>
                        <p>You will be redirected to set your password in a few seconds...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        setTimeout(function () {
            window.location.href = "{{ route('show.new.password.form', ['id' => $user->id]) }}";
        }, 3000); // Redirect after 3 seconds
    </script>
@endpush
