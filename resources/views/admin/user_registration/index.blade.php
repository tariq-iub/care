@extends('layouts.care')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">User Registration</li>
        </ol>
    </nav>

    <h2 class="text-bold text-body-emphasis mb-5">User Requests</h2>

    <div id="users" data-list='{"valueNames":["name","email","process","status"],"page":10,"pagination":true}'>
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
                    <button class="btn btn-link text-body me-4 px-0">
                        <span class="fa-solid fa-file-export fs-9 me-2"></span>Export
                    </button>
                    <a class="btn btn-primary" href="{{ route('users.create') }}">
                        <span class="fas fa-plus me-2"></span>Add user
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
                            Client Name
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="email" style="width:20%; min-width:200px;">
                            Email
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="process" style="width:40%; min-width:200px;">
                            Process Done
                        </th>
                        <th class="sort align-middle pe-3" scope="col" data-sort="status" style="width:10%;">
                            Status
                        </th>
                        <th class="align-middle text-end" scope="col" style="width:10%;">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list" id="users-table-body">
                    @foreach($userRegistrations as $row)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static"
                            data-user-id="{{ $row->id }}"
                            data-username="{{ $row->username }}"
                            data-email="{{ $row->email }}"
                            data-phone-no="{{ $row->phone_no }}"
                            data-company-name="{{ $row->company_name }}"
                            data-company-address="{{ $row->company_address }}"
                            data-company-city="{{ $row->company_city}}"
                            data-company-country="{{ $row->company_country }}"
                            data-company-state="{{ $row->company_state }}"
                            data-company-zip="{{ $row->company_zip }}"
                            data-contact-name="{{ $row->username }}"
                            data-contact-title="{{ $row->username }}">
                            <td class="align-middle white-space-nowrap name">
                                <a class="d-flex align-items-center text-body text-hover-1000 ps-2" href="#">
                                    <h6 class="mb-0 ms-3 fw-semibold">{{ $row->username }}</h6>
                                </a>
                            </td>

                            <td class="align-middle white-space-nowrap email">
                                <a class="fw-semibold" href="mailto:{{ $row->email }}">{{ $row->email }}</a>
                            </td>

                            <td class="align-middle text-body process">
                                @php
                                    $tasks = [
                                        'Respond' => $row->responder_id,
                                        'Remarks' => $row->remarks,
                                        'User Created' => $row->user_created_at,
                                        'Company Registered' => $row->company_registration_date,
                                        'Client Emailed' => $row->client_emailed,
                                        'Client Registered' => $row->client_registered,
                                    ];
                                @endphp

                                @foreach ($tasks as $taskName => $taskValue)
                                    <span class="badge badge-phoenix fs-10 {{ $taskValue ? 'badge-phoenix-success' : 'badge-phoenix-danger' }}">
                                        <span class="badge-label">{{ $taskName }}</span>
                                    </span>
                                @endforeach
                            </td>


                            <td class="align-middle white-space-nowrap status">
                                @if($row->client_registered)
                                    <span class="badge badge-phoenix fs-10 badge-phoenix-success">
                                    <span class="badge-label">Active</span>
                                </span>
                                @else
                                    <span class="badge badge-phoenix fs-10 badge-phoenix-warning">
                                    <span class="badge-label">Blocked</span>
                                </span>
                                @endif
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
                                        <a class="dropdown-item process-user-request-btn" href="#">Process User</a>
                                        <a class="dropdown-item resend-email-request-btn" href="#">Resend Email</a>
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
                    <a class="fw-semibold" href="#!" data-list-view="*">
                        View all
                        <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                    </a>
                    <a class="fw-semibold d-none" href="#!" data-list-view="less">
                        View Less
                        <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span>
                    </a>
                </div>
                <div class="col-auto d-flex">
                    <button class="page-link" data-list-pagination="prev">
                        <span class="fas fa-chevron-left"></span>
                    </button>
                    <ul class="mb-0 pagination"></ul>
                    <button class="page-link pe-0" data-list-pagination="next">
                        <span class="fas fa-chevron-right"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('admin.user_registration.partial.user_register_process')
@endsection

@push("scripts")
    <script>
        $(document).ready(function() {
            // Event listener for the edit button
            $('.process-user-request-btn').on('click', function(e) {
                e.preventDefault();

                console.log("button clicked");

                // Get the row containing the button
                const row = $(this).closest('tr');

                console.log(row.data);

                // Extract data from data attributes
                const userId = row.data('user-id');
                const username = row.data('username');
                const email = row.data('email');
                const phone = row.data('phone-no');
                const companyName = row.data('company-name');
                const companyAddress = row.data('company-address');
                const companyCity = row.data('company-city');
                const companyCountry = row.data('company-country');
                const companyState = row.data('company-state');
                const companyZip = row.data('company-zip');
                const contactName = row.data('contact-name');
                const contactTitle = row.data('contact-title');

                console.log(row.data);

                // Pass extracted data to the function to set modal values
                setModalValues(userId, username, email, phone, companyName, companyAddress, companyCity, companyCountry, companyState, companyZip, contactName, contactTitle);

                // Open the modal
                $('#processUserModal').modal('show');
            });

            $('.resend-email-request-btn').on('click', function(e) {
                e.preventDefault(); // Prevent the default action of the link

                const userId = $(this).closest('tr').data('user-id');
                const jsonData = JSON.stringify({ user_id: userId });
                var url = '/client/email-client';
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Assuming you have a meta tag with CSRF token

                console.log(jsonData);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: jsonData,
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        console.log("Success:", response);
                        // Finish the wizard or handle final step
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("Error:", textStatus, errorThrown);
                    }
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Select the form data and buttons
            const form1 = document.querySelector('#wizardForm1');
            const form2 = document.querySelector('#wizardForm2');
            const form3 = document.querySelector('#wizardForm3');
            const form4 = document.querySelector('#wizardForm4');
            const form5 = document.querySelector('#wizardForm5');
            const form6 = document.querySelector('#wizardForm6');
            const nextBtn = document.querySelector('[data-wizard-next-btn]');
            const prevBtn = document.querySelector('[data-wizard-prev-btn]');
            const wizardStep1 = document.querySelector('[data-wizard-step="1"]');
            const wizardStep2 = document.querySelector('[data-wizard-step="2"]');
            const wizardStep3 = document.querySelector('[data-wizard-step="3"]');
            const wizardStep4 = document.querySelector('[data-wizard-step="4"]');
            const wizardStep5 = document.querySelector('[data-wizard-step="5"]');
            const wizardStep6 = document.querySelector('[data-wizard-step="6"]');

            nextBtn.addEventListener('click', function(e) {
                e.preventDefault();

                let formData;
                let url;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                if (!wizardStep1.classList.contains('active') && wizardStep2.classList.contains('active') &&
                    !wizardStep3.classList.contains('active') && !wizardStep4.classList.contains('active') &&
                    !wizardStep5.classList.contains('active') && !wizardStep6.classList.contains('active')) {
                    formData = new FormData(form1);
                    url = '/client/update-responder';

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: JSON.stringify(Object.fromEntries(formData)),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log("Success:", response);
                            // Proceed to the next step
                            wizardStep1.classList.remove('active');
                            wizardStep2.classList.add('active');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error:", textStatus, errorThrown);
                        }
                    });
                } else if (!wizardStep1.classList.contains('active') && !wizardStep2.classList.contains('active') &&
                    wizardStep3.classList.contains('active') && !wizardStep4.classList.contains('active') &&
                    !wizardStep5.classList.contains('active') && !wizardStep6.classList.contains('active')) {
                    formData = new FormData(form2);
                    url = '/client/update-remarks';

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: JSON.stringify(Object.fromEntries(formData)),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log("Success:", response);
                            // Proceed to the next step
                            wizardStep2.classList.remove('active');
                            wizardStep3.classList.add('active');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error:", textStatus, errorThrown);
                        }
                    });
                } else if (!wizardStep1.classList.contains('active') && !wizardStep2.classList.contains('active') &&
                    !wizardStep3.classList.contains('active') && wizardStep4.classList.contains('active') &&
                    !wizardStep5.classList.contains('active') && !wizardStep6.classList.contains('active')) {
                    formData = new FormData(form3);
                    console.log(JSON.stringify(Object.fromEntries(formData)));
                    url = '/client/create-user';

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: JSON.stringify(Object.fromEntries(formData)),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log("Success:", response);
                            // Proceed to the next step
                            wizardStep3.classList.remove('active');
                            wizardStep4.classList.add('active');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error:", textStatus, errorThrown);
                        }
                    });
                } else if (!wizardStep1.classList.contains('active') && !wizardStep2.classList.contains('active') &&
                    !wizardStep3.classList.contains('active') && !wizardStep4.classList.contains('active') &&
                    wizardStep5.classList.contains('active') && !wizardStep6.classList.contains('active')) {
                    formData = new FormData(form4);
                    console.log(Object.fromEntries(formData));
                    url = '/client/create-company';

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: JSON.stringify(Object.fromEntries(formData)),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log("Success:", response);
                            // Proceed to the next step
                            wizardStep4.classList.remove('active');
                            wizardStep5.classList.add('active');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error:", textStatus, errorThrown);
                        }
                    });
                } else if (!wizardStep1.classList.contains('active') && !wizardStep2.classList.contains('active') &&
                    !wizardStep3.classList.contains('active') && !wizardStep4.classList.contains('active') &&
                    !wizardStep5.classList.contains('active') && wizardStep6.classList.contains('active')) {
                    formData = new FormData(form5);
                    url = '/client/email-client';

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: JSON.stringify(Object.fromEntries(formData)),
                        contentType: 'application/json',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            console.log("Success:", response);
                            // Finish the wizard or handle final step
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error("Error:", textStatus, errorThrown);
                        }
                    });
                } else {
                    console.log('No matching wizard step condition.');
                }
            });
        });

        function setModalValues(userId, userName, userEmail, userPhone, companyName, companyAddress, companyCity, companyCountry, companyState, companyZip, contactName, contactTitle) {
            document.getElementById('bootstrap-wizard-user-name').value = userName;
            document.getElementById('bootstrap-wizard-user-email').value = userEmail;
            document.getElementById('bootstrap-wizard-company-name').value = companyName;
            document.getElementById('bootstrap-wizard-company-address').value = companyAddress;
            document.getElementById('bootstrap-wizard-company-city').value = companyCity;
            document.getElementById('bootstrap-wizard-phone').value = userPhone;
            document.getElementById('bootstrap-wizard-email').value = userEmail;
            document.getElementById('bootstrap-wizard-company-country').value = companyCountry;
            document.getElementById('bootstrap-wizard-company-state').value = companyState;
            document.getElementById('bootstrap-wizard-company-zip').value = companyZip;

            document.getElementById('bootstrap-wizard-contact-name').value = contactName;
            document.getElementById('bootstrap-wizard-contact-title').value = contactTitle;

            $('#wizardForm1-user-id').val(userId);
            $('#wizardForm2-user-id').val(userId);
            $('#wizardForm3-user-id').val(userId);
            $('#wizardForm4-user-id').val(userId);
            $('#wizardForm5-user-id').val(userId);
        }
    </script>
@endpush
