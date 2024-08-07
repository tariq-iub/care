@extends('layouts.care')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Companies</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Manage Companies</h2>
    </div>

    <div id="companies" data-list='{"valueNames":["company"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search Company"
                               aria-label="Search"/>
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('company.create') }}">
                        <span class="fas fa-plus me-2"></span>Add Company
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="company" style="width:15%; min-width:200px;">
                            COMPANIES
                        </th>
                        <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                            CONTACT NAME
                        </th>
                        <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                            CITY
                        </th>
                        <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                            PHONE & EMAIL
                        </th>
                        <th class="sort align-middle text-end" scope="col" style="width:21%;  min-width:100px;">
                            ACTIONS
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list" id="setups-table-body">
                    @foreach($companies as $row)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="company align-middle white-space-nowrap">
                                <h6 class="mb-0 ms-3 fw-semibold">{{ $row->company_name }}</h6>
                            </td>
                            <td class="city align-middle white-space-nowrap">
                                <span class="text-body">{{ $row->contact_name }}</span>
                            </td><td class="city align-middle white-space-nowrap">
                                <span class="text-body">{{ $row->city }}</span>
                            </td>
                            <td class="email align-middle white-space-nowrap">
                                <span class="text-body">{{ $row->phone_number }}</span>
                                <br>
                                <a class="fw-semibold" href="mailto:{{ $row->email }}">{{ $row->email }}</a>
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
                                        <a class="dropdown-item" href="javascript:void(0)" data-id="{{ $row->id }}" onclick="openEditModal(event, {{ $row->id }})">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-id="{{ $row->id }}" onclick="openShowCompanyModal(event, {{ $row->id }})">Show</a>
                                        <a class="dropdown-item" href="{{route('plant.index', [$row->id] )}}">Manage Plants</a>
                                        <a class="dropdown-item" href="{{route('company.manage_users', [$row->id] )}}">Manage Users</a>
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

    @include('admin.plants.edit')
    @include('admin.plants.show')
@endsection

@push("scripts")
    <script>
        function openEditModal(event, id) {
            event.preventDefault();
            $.get(`/api/company/fetch-company/${id}`, function(response) {
                let company = response.company;

                $('#edit-company-name').val(company.company_name);
                $('#edit-address').val(company.address);
                $('#edit-city').val(company.city);
                $('#edit-state').val(company.state);
                $('#edit-zip').val(company.zip);
                $('#edit-country').val(company.country);
                $('#edit-contact-name').val(company.contact_name);
                $('#edit-contact-title').val(company.contact_title);
                $('#edit-phone-number').val(company.phone_number);
                $('#edit-alt-phone-number').val(company.alt_phone_number);
                $('#edit-fax-number').val(company.fax_number);
                $('#edit-email-address').val(company.email);


                var modal = new bootstrap.Modal(document.getElementById('edit-company'), {});
                modal.show();
            });
        }

        function openShowCompanyModal(event, id) {
            event.preventDefault();
            $.get(`/api/company/fetch-company/${id}`, function(response) {
                let company = response.company;

                $('#show-company-name').val(company.company_name);
                $('#show-address').val(company.address);
                $('#show-city').val(company.city);
                $('#show-state').val(company.state);
                $('#show-zip').val(company.zip);
                $('#show-country').val(company.country);
                $('#show-contact-name').val(company.contact_name);
                $('#show-contact-title').val(company.contact_title);
                $('#show-phone-number').val(company.phone_number);
                $('#show-alt-phone-number').val(company.alt_phone_number);
                $('#show-fax-number').val(company.fax_number);
                $('#show-email-address').val(company.email);

                var modal = new bootstrap.Modal(document.getElementById('show-company'), {});
                modal.show();
            });
        }
    </script>
@endpush

