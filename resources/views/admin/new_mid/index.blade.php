@extends('layouts.care')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">MIDs</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Manage MIDs</h2>
    </div>

    <div id="companies" data-list='{"valueNames":["machine"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search Machine"
                               aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#select-mid-setup">
                        <span class="fas fa-plus me-2"></span>Create New MID
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="machine" style="width:15%; min-width:200px;">
                            MID SETUP
                        </th>
                        <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                            Nominal Speed
                        </th>
                        <th class="sort align-middle" scope="col" style="width:21%;  min-width:100px;">
                            Secondary Speed Ratio
                        </th>
                        <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                            MID Rating
                        </th>
                        <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                            Machine Orientation
                        </th>
                        <th class="sort align-middle text-end" scope="col" style="width:21%;  min-width:100px;">
                            ACTIONS
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list" id="setups-table-body">
                    @foreach($midGeneral as $row)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="machine align-middle white-space-nowrap">
                                <span class="text-body">{{ $row->midSetup->id }} | {{ $row->midSetup->title }}</span>
                            </td>
                            <td class="mid_setup align-middle white-space-nowrap">
                                <span class="text-body">{{ $row->nominal_speed }} {{ $row->speed_unit }}</span>
                            </td>
                            <td class="plant align-middle white-space-nowrap">
                                <span class="text-body">{{ $row->secondary_speed_ratio }}</span>
                            </td>
                            <td class="plant align-middle white-space-nowrap">
                                <span class="text-body">{{ $row->mid_rating }}</span>
                            </td>
                            <td class="area align-middle white-space-nowrap">
                                <span class="text-body">{{ $row->machine_orientation }}</span>
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
                                        <a class="dropdown-item" href="{{route('new-mid.edit', $row->mid_setup_id)}}">Edit</a>
                                        <a class="dropdown-item" href="{{route('new-mid.show', $row->mid_setup_id)}}">Show</a>
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('machines.destroy', $row->id) }}" method="POST">
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

    <div class="modal fade" id="select-mid-setup" tabindex="-1" aria-labelledby="scrollingLongModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollingLongModalLabel2">Select MID Setup</h5>
                    <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">
                        <form id="wizardVerticalForm1" novalidate="novalidate" data-wizard-form="1">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label" for="fault-code">Select a MID Setup from the list</label>
                                    <select class="form-select" id="mid-setup" name="mid-setup">
                                        @foreach($midSetups as $mid_setup)
                                            <option value="{{$mid_setup->id}}">{{$mid_setup->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button class="btn btn-primary" data-bs-dismiss="modal" id="confirm-mid-selection">Ok</button>
                            <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push("scripts")
<script>
    $(document).ready(function () {
        $('#confirm-mid-selection').click(function () {
            const selectedId = $('#mid-setup').val();
            if (selectedId) {
                window.location.href = "{{ url('new-mid/create') }}" + "?mid_setup_id=" + selectedId;
            }
        });
    });
</script>

@endpush
