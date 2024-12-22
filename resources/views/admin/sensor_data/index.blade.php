@extends('layouts.care')

@section('title', 'Sensor Data')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Sensor Data</li>
        </ol>
    </nav>

    <h2 class="text-bold text-body-emphasis mb-5 fs-4">Sensor Data</h2>

    <div id="sensor-data" data-list='{"valueNames":["data_file_id","X","Y","Z"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search sensor data" aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <a class="btn btn-primary fs-9" href="{{ route('sensor_data.create') }}">
                    <span class="fas fa-plus me-2 fs-9"></span>Add Sensor Data
                </a>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="data_file_id" style="width:25%; min-width:150px;">
                            DATA FILE ID
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="X" style="width:25%; min-width:150px;">
                            X
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="Y" style="width:25%; min-width:150px;">
                            Y
                        </th>
                        <th class="sort align-middle" scope="col" data-sort="Z" style="width:25%; min-width:150px;">
                            Z
                        </th>
                        <th class="sort align-middle text-end" scope="col" style="width:10%; min-width:100px;">
                            ACTIONS
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list" id="sensor-data-table-body">
                    @foreach($sensorData as $data)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="data_file_id align-middle white-space-nowrap fs-9">{{ $data->data_file_id }}</td>
                            <td class="X align-middle white-space-nowrap fs-9">{{ $data->X }}</td>
                            <td class="Y align-middle white-space-nowrap fs-9">{{ $data->Y }}</td>
                            <td class="Z align-middle white-space-nowrap fs-9">{{ $data->Z }}</td>
                            <td class="actions align-middle text-end white-space-nowrap text-body-tertiary fs-9">
                                <div class="btn-reveal-trigger position-static">
                                    <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-9"
                                            type="button" data-bs-toggle="dropdown" data-boundary="window"
                                            aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                        <svg class="svg-inline--fa fa-ellipsis fs-9" aria-hidden="true"
                                             focusable="false" data-prefix="fas" data-icon="ellipsis" role="img"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor"
                                                  d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"></path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                        <a class="dropdown-item" href="{{ route('sensor_data.edit', $data->id) }}">
                                            Edit
                                        </a>
                                        <form action="{{ route('sensor_data.destroy', $data->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item text-danger" type="submit">Remove</button>
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
@endsection

@push('scripts')
    <!-- Add any custom scripts here if needed -->
@endpush
