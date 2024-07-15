@extends('layouts.care')
@section('title', 'Sites')
@section('page-title', 'Factory Sites')
@section('page-message', "Register and manage factory sites data.")

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Manage Site Templates</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="col-md-4">
                        <div class="list-group">
                            <a href="#" class="list-group-item active">
                                Factory-wise Sites
                            </a>

                            <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
                            <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
                            <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
                            <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">Vestibulum at eros</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
