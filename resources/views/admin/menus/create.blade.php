@extends('layouts.care')
@section('title', 'Create Menu')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Menu List</h4>
                    </div>
                    <a href="#" class="btn btn-outline-primary">
                        <i class="ri-add-circle-line"></i>Add Menu
                    </a>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-hover table-bordered mt-4" style="width:100%">
                            <thead>
                            <tr>
                                <th class="text-center">ID#</th>
                                <th>Title</th>
                                <th>Icon</th>
                                <th>Route</th>
                                <th>Parent Menu</th>
                                <th class="text-center">Display Order</th>
                                <th>Level</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
