@extends('layouts.app')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('inspections.index') }}">Inspections</a></li>
            <li class="breadcrumb-item active">Edit Inspection</li>
        </ol>
    </nav>

    <form action="{{ route('inspections.update', $inspection->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Edit Inspection</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Update the inspection details.
                </h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('inspections.index') }}"
                   class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Cancel</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Update Inspection</button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                <div class="mb-5">
                    <h5>Title</h5>
                    <input type="text" class="form-control" id="title" name="title"
                           value="{{ old('title', $inspection->title) }}" required>
                    @if($errors->has('title'))
                        <div class="text-danger small">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="mb-5">
                    <h5>Visitor Name</h5>
                    <input type="text" class="form-control" id="visitor_name" name="visitor_name"
                           value="{{ old('visitor_name', $inspection->visitor_name) }}">
                </div>

                <div class="mb-5">
                    <h5>Scheduled At</h5>
                    <input type="datetime-local" class="form-control" id="scheduled_at" name="scheduled_at"
                           value="{{ old('scheduled_at', $inspection->scheduled_at ? $inspection->scheduled_at->format('Y-m-d\TH:i') : '') }}">
                </div>

                <div class="mb-5">
                    <h5>Taken Up</h5>
                    <select class="form-select" id="taken_up" name="taken_up" required>
                        <option value="1" {{ old('taken_up', $inspection->taken_up) == 1 ? 'selected' : '' }}>
                            Yes
                        </option>
                        <option value="0" {{ old('taken_up', $inspection->taken_up) == 0 ? 'selected' : '' }}>
                            No
                        </option>
                    </select>
                </div>

                <div class="mb-5">
                    <h5>Status</h5>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Pending" {{ old('status', $inspection->status) == "Pending" ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="In Progress" {{ old('status', $inspection->status) == "In Progress" ? 'selected' : '' }}>
                            In Progress
                        </option>
                        <option value="Completed" {{ old('status', $inspection->status) == "Completed" ? 'selected' : '' }}>
                            Completed
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class="row g-2">
                    <div class="col-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Type</h4>

                                <div class="row gx-3">
                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="mb-4">
                                            <div class="d-flex flex-wrap mb-2">
                                                <h5 class="mb-0 text-body-highlight me-2">Select Type</h5>
                                            </div>
                                            <select class="form-select" id="type" name="type">
                                                <option value="">None</option>
                                                <option value="visit" {{ old('type', $inspection->type) == "visit" ? 'selected' : '' }}>
                                                    Visit
                                                </option>
                                                <option value="remote" {{ old('type', $inspection->type) == "remote" ? 'selected' : '' }}>
                                                    Remote
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row gx-3">
                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="mb-4">
                                            <div class="d-flex flex-wrap mb-2">
                                                <h5 class="mb-0 text-body-highlight me-2">Select Inspection Type</h5>
                                            </div>
                                            <select class="form-select" id="inspection_type" name="inspection_type">
                                                <option value="">None</option>
                                                <option value="Routine" {{ old('inspection_type', $inspection->inspection_type) == "Routine" ? 'selected' : '' }}>
                                                    Routine
                                                </option>
                                                <option value="Emergency" {{ old('inspection_type', $inspection->inspection_type) == "Emergency" ? 'selected' : '' }}>
                                                    Emergency
                                                </option>
                                                <option value="Post-Maintenance" {{ old('inspection_type', $inspection->inspection_type) == "Post-Maintenance" ? 'selected' : '' }}>
                                                    Post-Maintenance
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
