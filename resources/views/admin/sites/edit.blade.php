@extends('layouts.care')
@section('title', 'Factories')
@section('page-title', 'Edit Factory')
@section('page-message', "Edit factory data.")

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">{{ $factory->title }}</h4>
                    </div>
                </div>

                <div class="iq-card-body">
                    <form action="{{ route('factories.update', $factory->id) }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="title">Factory Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ $factory->title }}" required>
                                <div class="invalid-feedback">
                                    Provide complete factory name.
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="address">Factory Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="address" name="address"
                                       value="{{ $factory->address }}" required>
                                <div class="invalid-feedback">
                                    Provide complete factory address.
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="owner_name">Owner Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="owner_name" name="owner_name"
                                       value="{{ $factory->owner_name }}" required>
                                <div class="invalid-feedback">
                                    Provide factory owner's name.
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="owner_cnic">Owner's CNIC</label>
                                <input type="text" class="form-control" id="owner_cnic" name="owner_cnic"
                                       value="{{ $factory->owner_cnic }}" >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email"
                                       value="{{ $factory->email }}" required>
                                <div class="invalid-feedback">
                                    Provide a valid email address for correspondence.
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="contact_no">Contact No</label>
                                <input type="text" class="form-control" id="contact_no" name="contact_no"
                                       value="{{ $factory->contact_no }}" >
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fax">Fax</label>
                                <input type="text" class="form-control" id="fax" name="fax"
                                       value="{{ $factory->fax }}" >
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Factory Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
