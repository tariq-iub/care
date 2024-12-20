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
                    Upload a new data file with related information.
                </h5>
            </div>

            <div class="col-auto">
                <a href="{{ route('data.index') }}" class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Discard</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Upload Data</button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                <div class="mb-5">
                    <h5>Plant</h5>
                    <select class="form-select" id="plant" name="plant_id" required>
                        <option value="">Select Plant</option>
                        @foreach($plants as $plant)
                            <option value="{{ $plant->id }}">{{ $plant->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-5">
                    <h5>Area</h5>
                    <select class="form-select" id="area" name="area_id" required>
                        <option value="">Select Area</option>
                    </select>
                </div>

                <div class="mb-5">
                    <h5>Machine</h5>
                    <select class="form-select" id="machine" name="machine_id" required>
                        <option value="">Select Machine</option>
                    </select>
                </div>

                <div class="mb-5">
                    <h5>Vibration Location</h5>
                    <select class="form-select" id="vibration_location" name="vibration_location_id" required>
                        <option value="">Select Vibration Location</option>
                    </select>
                </div>

                <div class="mb-5">
                    <h5>Data File</h5>
                    <input type="file" class="form-control" id="data-file" name="file" required>
                    @if($errors->has('file'))
                        <div class="text-danger small">
                            {{ $errors->first('file') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $('#plant').on('change', function () {
            let plantId = $(this).val();
            $('#area').empty().append('<option value="">Select Area</option>');
            if (plantId) {
                fetch(`{{ url('api/plants') }}/${plantId}/areas`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(area => {
                            $('#area').append(`<option value="${area.id}">${area.name}</option>`);
                        });
                    });
            }
        });

        $('#area').on('change', function () {
            let areaId = $(this).val();
            $('#machine').empty().append('<option value="">Select Machine</option>');
            if (areaId) {
                fetch(`{{ url('api/areas') }}/${areaId}/machines`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(machine => {
                            $('#machine').append(`<option value="${machine.id}">${machine.name}</option>`);
                        });
                    });
            }
        });

        $('#machine').on('change', function () {
            let machineId = $(this).val();
            $('#vibration_location').empty().append('<option value="">Select Vibration Location</option>');
            if (machineId) {
                fetch(`{{ url('api/machines') }}/${machineId}/vibration-locations`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(location => {
                            $('#vibration_location').append(`<option value="${location.id}">${location.name}</option>`);
                        });
                    });
            }
        });
    </script>
@endpush
