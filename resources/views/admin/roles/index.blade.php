@extends('layouts.care')
@section('title', 'CARE Roles')
@section('page-title', 'Roles')
@section('page-message', "Manage user roles.")

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">User Roles</h4>
                    </div>
                    <a href="javascript:void(0)" class="btn btn-outline-primary"
                       data-toggle="modal" data-target=".bd-add-modal-lg">
                        <i class="ri-add-circle-line"></i>Add Role
                    </a>
                </div>

                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-hover table-bordered mt-4" style="width:100%">
                            <thead>
                            <tr>
                                <th class="text-center">ID#</th>
                                <th>Role Title</th>
                                <th>Menus Attached</th>
                                <th>Created At</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $row)
                            <tr>
                                <td class="text-center">{{ $row->id }}</td>
                                <td>{{ $row->title }}</td>
                                <td>
                                    {{ ($row->id == 1) ? "All" : "" }}
                                </td>
                                <td class="text-center">
                                    {{ $row->created_at->format('d-m-Y h:i:s A') }}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-outline-secondary" href="{{ route('roles.edit', $row->id) }}">
                                        <i class="ri-pencil-line"></i> Edit Role
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-add-modal-lg" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="replace-form" method="POST" action="{{ route('roles.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="record-id" name="id" value="">
                        <div class="form-group">
                            <label for="data-file">Role Title</label>
                            <input type="text" class="form-control" name="title" required>
                            <div class="invalid-feedback">Please provide a suitable role title.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
