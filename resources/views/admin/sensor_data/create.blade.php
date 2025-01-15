@extends('layouts.care')

@section('title', 'Create Sensor Data')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('sensor_data.index') }}">Sensor Data</a>
            </li>
            <li class="breadcrumb-item active">Create Sensor Data</li>
        </ol>
    </nav>

    <form method="POST" action="{{ route('sensor_data.store') }}">
        @csrf

        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Create Sensor Data</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Fill in the details to create a new sensor data entry.
                </h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('sensor_data.index') }}" class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Cancel</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Create</button>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger mb-5">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-5">
            <div class="col-md-6">
                <div class="mb-5">
                    <h5>Data File ID</h5>
                    <input class="form-control" type="number" id="data_file_id" name="data_file_id" value="{{ old('data_file_id') }}" required>
                </div>
                <div class="mb-5">
                    <h5>X</h5>
                    <input class="form-control" type="number" step="any" id="X" name="X" value="{{ old('X') }}" required>
                </div>
                <div class="mb-5">
                    <h5>Y</h5>
                    <input class="form-control" type="number" step="any" id="Y" name="Y" value="{{ old('Y') }}" required>
                </div>
                <div class="mb-5">
                    <h5>Z</h5>
                    <input class="form-control" type="number" step="any" id="Z" name="Z" value="{{ old('Z') }}" required>
                </div>
            </div>
        </div>
    </form>
@endsection
