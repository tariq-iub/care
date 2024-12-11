@extends('layouts.app')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('inspections.index') }}">Inspections</a></li>
            <li class="breadcrumb-item active">Add Inspection</li>
        </ol>
    </nav>

    <form action="{{ route('inspections.store') }}" method="POST">
        @csrf
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Create Inspection</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Add a new inspection.
                </h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('inspections.index') }}"
                   class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Discard</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Add Inspection</button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                <div class="mb-5">
                    <h5>Title</h5>
                    <input type="text" class="form-control" id="title" name="title"
                           value="{{ old('title') }}" required>
                    @if($errors->has('title'))
                        <div class="text-danger small">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                </div>

                <div class="mb-5">
                    <h5>Visitor Name</h5>
                    <input type="text" class="form-control" id="visitor_name" name="visitor_name"
                           value="{{ old('visitor_name') }}">
                </div>

                <div class="mb-5">
                    <h5>Scheduled At</h5>
                    <input type="date" class="form-control" id="scheduled_at" name="scheduled_at"
                           value="{{ old('scheduled_at') }}">
                </div>

                <div class="mb-5">
                    <h5>Taken Up</h5>
                    <select class="form-select" id="taken_up" name="taken_up" required>
                        <option value="1" {{ old('taken_up') ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('taken_up') ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="mb-5">
                    <h5>Status</h5>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Pending" {{ (old('status') == "Pending") ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="In Progress" {{ (old('status') == "In Progress") ? 'selected' : '' }}>In
                            Progress
                        </option>
                        <option value="Completed" {{ (old('status') == "Completed") ? 'selected' : '' }}>
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
                                <h4 class="card-title mb-4">Organize</h4>

                                <div class="row gx-3">
                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="mb-4">
                                            <div class="d-flex flex-wrap mb-2">
                                                <h5 class="mb-0 text-body-highlight me-2">Type</h5>
                                            </div>
                                            <select class="form-select" id="type" name="type">
                                                <option value="">None</option>
                                                <option value="visit" {{ (old('type') == "visit") ? 'selected' : '' }}>
                                                    Visit
                                                </option>
                                                <option value="remote" {{ (old('type') == "remote") ? 'selected' : '' }}>
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
                                                <h5 class="mb-0 text-body-highlight me-2">Inspection Type</h5>
                                            </div>
                                            <select class="form-select" id="inspection_type" name="inspection_type">
                                                <option value="">None</option>
                                                <option value="Routine" {{ (old('inspection_type') == "Routine") ? 'selected' : '' }}>
                                                    Routine
                                                </option>
                                                <option value="Emergency" {{ (old('inspection_type') == "Emergency") ? 'selected' : '' }}>
                                                    Emergency
                                                </option>
                                                <option value="Post-Maintenance" {{ (old('inspection_type') == "Post-Maintenance") ? 'selected' : '' }}>
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
