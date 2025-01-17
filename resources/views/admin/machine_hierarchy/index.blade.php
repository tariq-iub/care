@extends('layouts.app')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Machines</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Machines Listing for Diagnosis</h2>
    </div>

    <div id="companies" data-list='{"valueNames":["machine", "company", "plant", "area"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <!-- Search Box -->
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search Machine"
                               aria-label="Search"/>
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <!-- Dropdowns (right aligned) -->
            <div class="d-flex justify-content-end gap-3 col-auto">
                <!-- Dropdown for Company -->
                <div class="col-auto">
                    <select id="companyDropdown" class="form-select w-100" style="min-width: 200px; max-width: 300px;">
                        <option value="">Select Company</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Dropdown for Plant -->
                <div class="col-auto">
                    <select id="plantDropdown" class="form-select w-100" style="min-width: 200px; max-width: 300px;"
                            disabled>
                        <option value="">Select Plant</option>
                    </select>
                </div>

                <!-- Dropdown for Area -->
                <div class="col-auto">
                    <select id="areaDropdown" class="form-select w-100" style="min-width: 200px; max-width: 300px;"
                            disabled>
                        <option value="">Select Area</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table id="dataTable" class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="machine"
                            style="width:15%; min-width:200px;">
                            Machine Name
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="company"
                            style="width:15%; min-width:200px;">
                            COMPANY
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="plant" style="width:15%; min-width:200px;">
                            Plant
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="area" style="width:15%; min-width:200px;">
                            Area
                        </th>
                        <th class="sort align-middle text-end" scope="col" style="width:21%;  min-width:100px;">
                            ACTIONS
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list" id="setups-table-body">
                    @foreach($machines as $row)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static"
                            data-company-id="{{ $row->area->plant->company->id }}" data-plant-id="{{ $row->plant->id }}"
                            data-area-id="{{ $row->area->id }}">
                            <td class="machine align-middle white-space-nowrap">
                                <h6 class="mb-0 ms-3 fw-semibold">{{ $row->machine_name }}</h6>
                            </td>
                            <td class="mid_setup align-middle white-space-nowrap">
                                <span class="text-body">{{ $row->area->plant->company->company_name }}</span>
                            </td>
                            <td class="plant align-middle white-space-nowrap">
                                <span class="text-body">{{ $row->plant->title }}</span>
                            </td>
                            <td class="area align-middle white-space-nowrap">
                                <span class="text-body">{{ $row->area->name }}</span>
                            </td>
                            <td class="last_active align-middle text-end white-space-nowrap text-body-tertiary">
                                <div class="btn-reveal-trigger position-static">
                                    <button
                                        class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
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

                                        <a class="dropdown-item" href="{{ route('machines.edit', $row->id) }}">Start Diagnosis</a>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            function filterTable() {
                var companyId = $('#companyDropdown').val();
                var plantId = $('#plantDropdown').val();
                var areaId = $('#areaDropdown').val();

                console.log("Selected IDs:", {companyId, plantId, areaId});

                $('#dataTable tbody tr').each(function () {
                    var rowCompanyId = $(this).data('company-id');  // Get from data-attribute
                    var rowPlantId = $(this).data('plant-id');
                    var rowAreaId = $(this).data('area-id');

                    console.log("Row IDs:", {rowCompanyId, rowPlantId, rowAreaId});

                    var showRow = true;

                    if (companyId && companyId !== "all" && rowCompanyId != companyId) {
                        showRow = false;
                    }
                    if (plantId && plantId !== "all" && rowPlantId != plantId) {
                        showRow = false;
                    }
                    if (areaId && areaId !== "all" && rowAreaId != areaId) {
                        showRow = false;
                    }

                    $(this).toggle(showRow);
                });
            }

            $('#companyDropdown, #plantDropdown, #areaDropdown').on('change', function () {
                filterTable();
            });
        });

        document.getElementById('companyDropdown').addEventListener('change', function () {
            let companyId = this.value;
            let plantDropdown = document.getElementById('plantDropdown');
            let areaDropdown = document.getElementById('areaDropdown');

            // Clear previous selections
            plantDropdown.innerHTML = '<option value="">Select Plant</option>';
            areaDropdown.innerHTML = '<option value="">Select Area</option>';

            if (companyId) {
                plantDropdown.disabled = false;

                // Fetch plants for selected company
                fetch(`/api/companies/${companyId}/plants`)
                    .then(response => response.json())
                    .then(data => {
                        data.plants.forEach(plant => {
                            let option = document.createElement('option');
                            option.value = plant.id;
                            option.textContent = plant.title;
                            plantDropdown.appendChild(option);
                        });
                    });
            } else {
                plantDropdown.disabled = true;
                areaDropdown.disabled = true;
            }
        });

        document.getElementById('plantDropdown').addEventListener('change', function () {
            let plantId = this.value;
            let areaDropdown = document.getElementById('areaDropdown');

            // Clear previous selections
            areaDropdown.innerHTML = '<option value="">Select Area</option>';

            if (plantId) {
                areaDropdown.disabled = false;

                // Fetch areas for selected plant
                fetch(`/api/plants/${plantId}/areas`)
                    .then(response => response.json())
                    .then(data => {
                        data.areas.forEach(area => {
                            let option = document.createElement('option');
                            option.value = area.id;
                            option.textContent = area.name;
                            areaDropdown.appendChild(option);
                        });
                    });
            } else {
                areaDropdown.disabled = true;
            }
        });
    </script>
@endpush
