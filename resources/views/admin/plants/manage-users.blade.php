@extends('layouts.care')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/company') }}">Companies</a></li>
            <li class="breadcrumb-item active">Company Users</li>
        </ol>
    </nav>

    <h2 class="text-bold text-body-emphasis mb-5">Company Users</h2>
    <div class="row">
        <div class="col-12 col-md-8 mb-4 pe-md-4">
            <div id="users" data-list='{"valueNames":["user","email","status","role"],"page":10,"pagination":true}'>
                <div class="row align-items-center justify-content-between g-3 mb-4">
                    <div class="col col-auto">
                        <div class="search-box">
                            <form class="position-relative">
                                <input class="form-control search-input search" type="search" placeholder="Search users"
                                       aria-label="Search"/>
                                <span class="fas fa-search search-box-icon"></span>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
                    <div class="table-responsive scrollbar ms-n1 ps-1">
                        <table class="table table-sm fs-9 mb-0">
                            <thead>
                            <tr>
                                <th class="sort align-middle" scope="col" data-sort="user" style="width:15%; min-width:140px;">
                                    USER
                                </th>
                                <th class="sort align-middle" scope="col" data-sort="email" style="width:15%; min-width:140px;">
                                    EMAIL
                                </th>
                                <th class="sort align-middle pe-3" scope="col" data-sort="status"
                                    style="width:20%; min-width:140px;">
                                    STATUS
                                </th>
                                <th class="sort align-middle" scope="col" data-sort="role" style="width:10%;">
                                    Access Level
                                </th>
                                <th class="sort align-middle text-end" scope="col" style="width:15%;  min-width:100px;">
                                    ACTIONS
                                </th>
                            </tr>
                            </thead>
                            <tbody class="list" id="users-table-body">
                            @foreach($users as $row)
                                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                                    <td class="customer align-middle white-space-nowrap">
                                        @php
                                            $src = url('assets/img/users/user1.png');
                                            if($row->avatar)
                                                $src = Storage::url($row->avatar);
                                        @endphp
                                        <a class="d-flex align-items-center text-body text-hover-1000 ps-2" href="#">
                                            <div class="avatar avatar-m">
                                                <img class="rounded-circle" src="{{ $src }}" alt="">
                                            </div>
                                            <h6 class="mb-0 ms-3 fw-semibold">{{ $row->name }}</h6>
                                        </a>
                                    </td>
                                    <td class="email align-middle white-space-nowrap">
                                        <a class="fw-semibold" href="mailto:{{ $row->email }}">{{ $row->email }}</a>
                                    </td>
                                    <td class="mobile_number align-middle white-space-nowrap">
                                        @if($row->status == 1)
                                            <span class="badge badge-phoenix fs-10 badge-phoenix-success">
                                            <span class="badge-label">Active</span>
                                        </span>
                                        @else
                                            <span class="badge badge-phoenix fs-10 badge-phoenix-warning">
                                            <span class="badge-label">Blocked</span>
                                        </span>
                                        @endif
                                    </td>
                                    <td class="city align-middle white-space-nowrap text-body">
                                        {{ $row->access_level }}
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
                                                <a class="dropdown-item" href="javascript:void(0)" data-id="{{$row->user_id}}" onclick="showEditUserModal(event, {{$row->user_id}})">Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0)"
                                                   onclick="document.querySelector(`#update-status-{{ $row->user_id }}`).submit();">
                                                    Change Status
                                                </a>
                                                <form id="update-status-{{ $row->user_id }}"
                                                      action="{{ route('company_users.status', $row->user_id) }}" method="POST"
                                                      style="display:none;">
                                                    @csrf
                                                    @method("PUT")
                                                    <input type="hidden" name="status" value="{{ !$row->status }}">
                                                    <input type="hidden" name="company_id" value="{{ $id }}">
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#!">Remove</a>
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
        </div>

        <div class="col-12 col-md-4">
            <div class="card shadow-none border ms-md-4" data-component-card="data-component-card">
                <div class="card-header border-bottom bg-body">
                    <div class="row g-3 justify-content-between align-items-center">
                        <div class="col-12 col-md">
                            <h4 class="text-body mb-0" id="vertical-wizard">
                                Add Company User
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="card-body mb-0">
                    <form method="POST" action="{{ route('company.store_user') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="company_id" value="{{ $id }}">
                        <div class="mb-5">
                            <h5>User Name</h5>
                            <input class="form-control" type="text" name="name" placeholder="User Name"
                                   value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-5">
                            <h5>User Image</h5>
                            <input type="file" class="form-control" id="photo_path" name="photo_path" accept="image/*">
                        </div>

                        <div class="mb-5">
                            <h5>Email</h5>
                            <input class="form-control" type="email" name="email" placeholder="User Email"
                                   value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-5">
                            <h5>Access Level</h5>
                            <select class="form-select" name="access_level" required>
                                <option value="">Select Access Level</option>
                                <option value="owner">Owner</option>
                                <option value="employee" selected>Employee</option>
                            </select>
                        </div>

                        <div class="mb-5">
                            <h5>Status</h5>
                            <select class="form-select" name="status" required>
                                <option value="">Select Status</option>
                                <option value="1" selected>Active</option>
                                <option value="0">Blocked</option>
                            </select>
                        </div>

                        <div class="mb-5">
                            <h5>Password</h5>
                            <input class="form-control" type="password" name="password" placeholder="User Password"
                                   value="{{ old('password') }}" required>
                        </div>

                        <div class="mb-5">
                            <h5>Confirm Password</h5>
                            <input class="form-control" type="password" name="password_confirmation"
                                   placeholder="Confirm Password"
                                   value="{{ old('password_confirmation') }}" required>
                        </div>

                        <div class="mb-5">
                            <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Add user</button>
    {{--                        <a class="btn btn-outline-secondary" href="{{ route('users.index') }}">Cancel</a>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-user" tabindex="-1" aria-labelledby="scrollingLongModalLabel2" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollingLongModalLabel2">Modal title</h5>
                    <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">
                        <form id="wizardVerticalForm1" novalidate="novalidate" data-wizard-form="1">
                            <div class="row g-3">
                                <input type="hidden" name="company_id" value="{{ $id }}">
                                <input type="hidden" name="user_id">
                                <div class="mb-5">
                                    <h5>User Name</h5>
                                    <input class="form-control" type="text" name="name" placeholder="User Name"
                                           value="{{ old('name') }}" required>
                                </div>

                                <div class="mb-5">
                                    <h5>User Image</h5>
                                    <input type="file" class="form-control" id="photo_path" name="photo_path" accept="image/*">
                                </div>

                                <div class="mb-5">
                                    <h5>Email</h5>
                                    <input class="form-control" type="email" name="email" placeholder="User Email"
                                           value="{{ old('email') }}" required>
                                </div>

                                <div class="mb-5">
                                    <h5>Access Level</h5>
                                    <select class="form-select" name="access_level" required>
                                        <option value="">Select Access Level</option>
                                        <option value="owner">Owner</option>
                                        <option value="employee">Employee</option>
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <h5>Status</h5>
                                    <select class="form-select" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Blocked</option>
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <h5>Password</h5>
                                    <input class="form-control" type="password" name="password" placeholder="User Password"
                                           value="{{ old('password') }}" required>
                                </div>

                                <div class="mb-5">
                                    <h5>Confirm Password</h5>
                                    <input class="form-control" type="password" name="password_confirmation"
                                           placeholder="Confirm Password"
                                           value="{{ old('password_confirmation') }}" required>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="button" id="save-button">Save</button>
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push("scripts")
    <script>
        function showEditUserModal(event, userId){
            $.get(`/api/company/users/${userId}`, function(response){
                console.log(response);
                let user = response.user;
                let form = document.querySelector("#edit-user form");
                form.querySelector("input[name=user_id]").value = user.user_id;
                form.querySelector("input[name=name]").value = user.name;
                form.querySelector("input[name=email]").value = user.email;
                console.log(user.status);
                if(user.status){
                    form.querySelector("select[name=status]").value = 1;
                } else {
                    form.querySelector("select[name=status]").value = 0;
                }

                form.querySelector("select[name=access_level]").value = user.access_level;
                let modal = new bootstrap.Modal(document.getElementById('edit-user'),{});
                modal.show();
            });
        }

        $("#save-button").click(function(){
            let form = document.querySelector("#edit-user form");

            let formData = new FormData(form);

            $.ajax({
                url: '/api/company/update-user',
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log(response);
                    location.reload();
                }
            });
        });
    </script>
@endpush
