@extends('layouts.care')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Fault Codes</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Manage Fault Codes</h2>
    </div>

    <div id="companies" data-list='{"valueNames":["fault_code"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search Fault Code"
                               aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <button class="btn btn-primary" onclick="showCreateModal()">
                        <span class="fas fa-plus me-2"></span>Create Fault Code
                    </button>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="fault_code" style="width:15%; min-width:200px;">
                            CODE
                        </th>
                        <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                            DESCRIPTION
                        </th>
                        <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">

                        </th>
                        <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">

                        </th>
                        <th class="sort align-middle text-end" scope="col" style="width:21%;  min-width:100px;">
                            ACTIONS
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list" id="setups-table-body">
                    @foreach($faultCodes as $row)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fault_code align-middle white-space-nowrap">
                                <h6 class="mb-0 ms-3 fw-semibold">{{ $row->code }}</h6>
                            </td>
                            <td class="city align-middle white-space-nowrap">
                                <span class="text-body">{{ $row->description }}</span>
                            </td>
                            <td class="city align-middle white-space-nowrap">

                            </td>
                            <td class="email align-middle white-space-nowrap">

                            </td>
                            <td class="last_active align-middle text-end white-space-nowrap text-body-tertiary">
                                <div class="btn-reveal-trigger position-static">
                                    <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
                                            type="button" data-bs-toggle="dropdown" data-boundary="window"
                                            aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                        <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true"
                                             focusable="false" data-prefix="fas" data-icon="ellipsis" role="img"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                  d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"></path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2" style="">
{{--                                        <a class="dropdown-item" href="{{route('fault-codes.edit', $row->id)}}">Edit</a>--}}
                                        <a class="dropdown-item" href="javascript:void(0)" data-id="{{ $row->id }}" onclick="showEditModal(event, this)">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('fault-codes.destroy', $row->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                <div class="col-auto d-flex">
                    <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
                    <a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1"
                                                                                      data-fa-transform="down-1"></span></a><a
                        class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span
                            class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
                <div class="col-auto d-flex">
                    <button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span>
                    </button>
                    <ul class="mb-0 pagination"></ul>
                                                              <button class="page-link pe-0" data-list-pagination="next"><span
                            class="fas fa-chevron-right"></span></button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Fault Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form action="{{ route('fault-codes.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input class="form-control" id="description" name="description" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Fault Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" class="form-control" id="code" name="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input class="form-control" id="description" name="description" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                 </div>
            </div>
        </div>
    </div>

@endsection


@push("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('createModal').addEventListener('hidden.bs.modal', function () {
                document.getElementById('createModal').querySelector('form').reset();
            });
        });

        function showCreateModal() {
            $('#createModal').modal('show');
        }

        function showEditModal(event, element) {
            event.preventDefault();
            const id = $(element).data('id');
            const formAction = '{{ route('fault-codes.update', ':id') }}'.replace(':id', id);
            $('#editModal form').attr('action', formAction);

            $.get('api/fault-codes/fetch-fault-code/' + id, function (data) {
                $('#editModal input[name="code"]').val(data.code);
                $('#editModal input[name="description"]').val(data.description);
            });

            $('#editModal').modal('show');
        }

    </script>
@endpush
