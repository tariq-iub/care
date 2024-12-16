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
                    <h5 class="mb-0 text-body-highlight me-2">Inspection Type</h5>

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
    </form>
@endsection
