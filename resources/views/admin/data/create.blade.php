@extends('layouts.app')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('data.index') }}">Data Files</a></li>
            <li class="breadcrumb-item active">Add Data File</li>
        </ol>
    </nav>

    <form action="{{ route('data.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Create Data File</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Add a new data file with hierarchical selections.
                </h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('data.index') }}" class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Discard</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Add Data File</button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                <div class="mb-5">
                    <h5>Data File</h5>
                    <input type="file" class="form-control" id="data_file" name="file" required>
                    <div class="invalid-feedback">Data file needs to be selected.</div>
                </div>

                <div class="mb-5">
                    <div class="d-flex align-items-center">
                        <h5 class="me-3">File Name</h5>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="toggle_file_name" checked>
                            <label class="form-check-label" for="toggle_file_name">Use Original File Name</label>
                        </div>
                    </div>

                    <input type="text" class="form-control" id="file_name" name="file_name" required disabled>
                    <div class="invalid-feedback">Data file name needs to be selected.</div>
                </div>

                <div class="mb-5">
                    <h5>Company</h5>
                    <select class="form-select select2" id="company_id" name="company_id" required>
                        <option value="">Select Company</option>
                        @foreach($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <h5>Plant</h5>
                    <select class="form-select select2" id="plant_id" name="plant_id" required>
                        <option value="">Select Plant</option>
                    </select>
                </div>

                <div class="mb-5">
                    <h5>Area</h5>
                    <select class="form-select select2" id="area_id" name="area_id" required>
                        <option value="">Select Area</option>
                    </select>
                </div>

                <div class="mb-5">
                    <h5>Machine</h5>
                    <select class="form-select select2" id="machine_id" name="machine_id" required>
                        <option value="">Select Machine</option>
                    </select>
                </div>

                <div class="mb-5">
                    <h5>Vibration Location</h5>
                    <select class="form-select select2" id="vibration_location_id" name="vibration_location_id"
                            required>
                        <option value="">Select Vibration Location</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Auto-fill file name when a file is selected
            $('#data_file').change(function () {
                const fileName = $(this).val().split('\\').pop();
                if ($('#toggle_file_name').is(':checked')) {
                    $('#file_name').val(fileName);
                }
            });

            // Enable or disable the file name input based on toggle switch
            $('#toggle_file_name').change(function () {
                if ($(this).is(':checked')) {
                    $('#file_name').prop('disabled', true);
                    const fileName = $('#data_file').val().split('\\').pop();
                    $('#file_name').val(fileName); // Reset to original file name
                } else {
                    $('#file_name').prop('disabled', false).val($('#data_file').val().split('\\').pop());
                }
            });

            $('#company_id').change(function () {
                let companyId = $(this).val();
                $('#plant_id').empty().append('<option value="">Select Plant</option>');
                if (companyId) {
                    fetch(`/api/companies/${companyId}/plants`)
                        .then(response => response.json())
                        .then(data => {
                            data.plants.forEach(plant => {
                                $('#plant_id').append(`<option value="${plant.id}">${plant.title}</option>`);
                            });
                        });
                }
            });

            $('#plant_id').change(function () {
                let plantId = $(this).val();
                $('#area_id').empty().append('<option value="">Select Area</option>');
                if (plantId) {
                    fetch(`/api/plants/${plantId}/areas`)
                        .then(response => response.json())
                        .then(data => {
                            data.areas.forEach(area => {
                                $('#area_id').append(`<option value="${area.id}">${area.name}</option>`);
                            });
                        });
                }
            });

            $('#area_id').change(function () {
                let areaId = $(this).val();
                $('#machine_id').empty().append('<option value="">Select Machine</option>');
                if (areaId) {
                    fetch(`/api/areas/${areaId}/machines`)
                        .then(response => response.json())
                        .then(data => {
                            data.machines.forEach(machine => {
                                $('#machine_id').append(`<option value="${machine.id}">${machine.machine_name}</option>`);
                            });
                        });
                }
            });

            $('#machine_id').change(function () {
                let machineId = $(this).val();
                $('#vibration_location_id').empty().append('<option value="">Select Vibration Location</option>');
                if (machineId) {
                    fetch(`/api/machines/${machineId}/vibration-locations`)
                        .then(response => response.json())
                        .then(data => {
                            data.vibrationLocations.forEach(location => {
                                $('#vibration_location_id').append(`<option value="${location.id}">${location.location_name}</option>`);
                            });
                        });
                }
            });
        });
    </script>
@endpush
