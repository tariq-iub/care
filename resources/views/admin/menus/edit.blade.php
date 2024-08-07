@extends('layouts.care')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('menus.index') }}">Menus</a></li>
            <li class="breadcrumb-item active">Create Menu</li>
        </ol>
    </nav>

    <form method="POST" action="{{ route('menus.update', $menu) }}">
        @csrf
        @method('PUT')

        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Edit Menu</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Edit menu for users.
                </h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('menus.index') }}" class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Discard</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Update menu</button>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-12 col-xl-8">
                <input type="hidden" name="menu-id" value="{{ $menu->id }}">

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $menu->title) }}" required>
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $menu->icon) }}">
                    @error('icon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="form-label">Parent Menu</label>
                    <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                        <option value="">None</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->id }}" {{ old('parent_id', $menu->parent_id) == $menu->id ? 'selected' : '' }}>
                                {{ $menu->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="display_order" class="form-label">Display Order</label>
                    <input type="number" class="form-control @error('display_order') is-invalid @enderror" id="display_order" name="display_order" value="{{ old('display_order', $menu->display_order) }}">
                    @error('display_order')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="level" class="form-label">Level</label>
                    <select class="form-select @error('level') is-invalid @enderror" id="level" name="level">
                        <option value="admin" {{ old('level', $menu->level) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="client" {{ old('level', $menu->level) == 'client' ? 'selected' : '' }}>Client</option>
                    </select>
                    @error('level')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="d-flex flex-wrap mb-2">
                        <h5 class="mb-0 text-body-highlight me-2">Status</h5>
                    </div>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                        <option value="1" {{ old('status', $menu->status) ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $menu->status) ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
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
                                                <h5 class="mb-0 text-body-highlight me-2">Route</h5>
                                            </div>
                                            <input type="text" class="form-control @error('route') is-invalid @enderror" id="route" name="route" value="{{ old('route', $menu->route) }}">
                                            @if($errors->has('route'))
                                                <div class="text-danger small">
                                                    {{ $errors->first('route') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="mb-4">
                                            <div class="d-flex flex-wrap mb-2">
                                                <h5 class="mb-0 text-body-highlight me-2">URL</h5>
                                            </div>
                                            <input type="text" class="form-control @error('route') is-invalid @enderror" id="url" name="url" value="{{ old('url', $menu->url) }}">
                                            @if($errors->has('url'))
                                                <div class="text-danger small">
                                                    {{ $errors->first('url') }}
                                                </div>
                                            @endif
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

{{--@extends('layouts.care')--}}

{{--@section('content')--}}
{{--    <nav class="mb-3" aria-label="breadcrumb">--}}
{{--        <ol class="breadcrumb mb-0">--}}
{{--            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>--}}
{{--            <li class="breadcrumb-item"><a href="{{ route('menus.index') }}">Menus</a></li>--}}
{{--            <li class="breadcrumb-item active">Edit Menu</li>--}}
{{--        </ol>--}}
{{--    </nav>--}}

{{--    <div class="mb-5">--}}
{{--        <h2 class="text-bold text-body-emphasis">Edit Menu</h2>--}}
{{--        <p class="text-body-tertiary lead">--}}
{{--            Update the menu details.--}}
{{--        </p>--}}
{{--    </div>--}}

{{--    <form action="{{ route('menus.update', $menu->id) }}" method="POST">--}}
{{--        @csrf--}}
{{--        @method('PUT')--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="mb-3">--}}
{{--                    <label for="title" class="form-label">Title</label>--}}
{{--                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $menu->title) }}" required>--}}
{{--                    @error('title')--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $message }}--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--                <div class="mb-3">--}}
{{--                    <label for="icon" class="form-label">Icon</label>--}}
{{--                    <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" value="{{ old('icon', $menu->icon) }}">--}}
{{--                    @error('icon')--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $message }}--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--                <div class="mb-3">--}}
{{--                    <label for="parent_id" class="form-label">Parent Menu</label>--}}
{{--                    <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">--}}
{{--                        <option value="">None</option>--}}
{{--                        @foreach($parentMenus as $parent)--}}
{{--                            <option value="{{ $parent->id }}" {{ $parent->id == $menu->parent_id ? 'selected' : '' }}>--}}
{{--                                {{ $parent->title }}--}}
{{--                            </option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                    @error('parent_id')--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $message }}--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                </div>--}}

{{--                <div class="mb-3">--}}
{{--                    <label for="status" class="form-label">Status</label>--}}
{{--                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">--}}
{{--                        <option value="1" {{ $menu->status ? 'selected' : '' }}>Active</option>--}}
{{--                        <option value="0" {{ !$menu->status ? 'selected' : '' }}>Inactive</option>--}}
{{--                    </select>--}}
{{--                    @error('status')--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $message }}--}}
{{--                    </div>--}}
{{--                    @enderror--}}
{{--                </div>--}}


{{--                <div class="mb-3">--}}
{{--                    <button type="submit" class="btn btn-primary">Update Menu</button>--}}
{{--                    <a href="{{ route('menus.index') }}" class="btn btn-secondary">Cancel</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--@endsection--}}
