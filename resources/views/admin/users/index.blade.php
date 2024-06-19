@extends('layouts.care')
@section('title', 'CARE Users')
@section('page-title', 'Users')
@section('page-message', "User management along with their roles.")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Users List</h4>
                    </div>
                    <a href="{{ route('users.create') }}" class="btn btn-outline-primary">
                        <i class="ri-add-circle-line"></i>Add User
                    </a>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover table-bordered mt-4" style="width:100%">
                            <thead>
                            <tr>
                                <th></th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th class="text-center">Status</th>
                                <th>Role</th>
                                <th>Action</th>
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
    <script>
        $(function () {
            var table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {data: 'avatar', name: 'avatar', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'status', name: 'status'},
                    {data: 'role', name: 'role'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                createdRow: function (row, data, dataIndex) {
                    $('td', row).eq(0).addClass('text-center');
                    $('td', row).eq(3).addClass('text-center');
                }
            });
        });
    </script>
@endpush
