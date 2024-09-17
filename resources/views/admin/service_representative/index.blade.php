@extends('layouts.care')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Service Reps</li>
        </ol>
    </nav>

    <h2 class="text-bold text-body-emphasis mb-5">Service Representatives</h2>

    <div id="users" data-list='{"valueNames":["name","email","contact","address"],"page":10,"pagination":true}'>
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

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('service-reps.create') }}">
                        <span class="fas fa-plus me-2"></span>Add Service Rep
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1 mt-3">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="name" style="width:20%; min-width:200px;">
                            Representative Name
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="email" style="width:20%; min-width:200px;">
                            Email
                        </th>
                        <th class="sort align-middle pe-3" scope="col" data-sort="contact" style="width:10%; min-width:200px;">
                            Contact No
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="address" style="width:30%; min-width:200px;">
                            Address
                        </th>
                        <th class="align-middle text-end" scope="col" style="width:10%;">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list" id="users-table-body">
                    @foreach($service_reps as $row)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle white-space-nowrap name">
                                @php
                                    $src = url('assets/img/users/user1.png');
                                    if($row->avatar)
                                        $src = Storage::url($row->avatar);
                                @endphp
                                <a class="d-flex align-items-center text-body text-hover-1000 ps-2" href="#">
                                    <div class="avatar avatar-m">
                                        <img class="rounded-circle" src="{{ $src }}" alt="">
                                    </div>
                                    <h6 class="mb-0 ms-3 fw-semibold">{{ $row->service_rep_name }}</h6>
                                </a>
                            </td>

                            <td class="align-middle white-space-nowrap email">
                                <a class="fw-semibold" href="mailto:{{ $row->email }}">{{ $row->email }}</a>
                            </td>

                            <td class="align-middle white-space-nowrap text-body contact">
                                <h6>{{ $row->phone_number }}</h6>
                                <div class="small">
                                    <h6>{{ $row->fax_number }}</h6>
                                </div>
                            </td>

                            <td class="align-middle white-space-nowrap text-body city">
                                <h6>{{ $row->address }}</h6>
                                <div class="small">
                                    <div class="row">
                                        <div class="col-auto">
                                            <h6>{{ $row->country }}</h6>
                                        </div>
                                        <div class="col-auto">
                                            <h6>{{ $row->city }}</h6>
                                        </div>
                                        <div class="col-auto">
                                            <h6>{{ $row->state }}</h6>
                                        </div>
                                        <div class="col-auto">
                                            <h6>{{ $row->zip }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="last_active align-middle text-end white-space-nowrap text-body-tertiary">
                                <div class="btn-reveal-trigger position-static">
                                    <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
                                            type="button" data-bs-toggle="dropdown" data-boundary="window"
                                            aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                        <span class="fas fa-ellipsis fs-10"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2" style="">
                                        <a class="dropdown-item" href="{{ route('service-reps.edit', $row->id) }}">Edit</a>
                                        <a class="dropdown-item" href="{{ route('service-reps.show', $row->id) }}">Show</a>
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

@endsection

@push("scripts")

@endpush
