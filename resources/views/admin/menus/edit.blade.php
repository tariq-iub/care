@extends('layouts.care')
@section('title', 'Edit Menu')
@section('page-title', 'Edit Menu')
@section('page-message', "Edit existing menu")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Edit Menu</h4>
                    </div>
                </div>

                <div class="iq-card-body">
                    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="title">Menu Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ $menu->title }}" placeholder="Menu Title" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="icon">Menu Icon</label>
                                <input type="text" class="form-control" id="icon" name="icon"
                                       value="{{ $menu->icon }}" placeholder="Menu Icon">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="route">Menu Route</label>
                                <input type="text" class="form-control" id="route" name="route"
                                       value="{{ $menu->route }}" placeholder="Menu Route">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="parent_id">Parent Menu</label>
                                <select class="form-control" id="parent_id" name="parent_id">
                                    <option value="">Select Parent</option>
                                    @foreach($parentMenus as $parentMenu)
                                        <option value="{{ $parentMenu->id }}" {{ ($parentMenu?->id == $menu->parent?->id) ? "selected" : "" }}>
                                            {{ $parentMenu->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="display_order">Display Order</label>
                                <input type="number" class="form-control" id="display_order" name="display_order"
                                       min="0" max="100" value="{{ $menu->display_order }}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="level">Menu Level</label>
                                <select class="form-control" id="level" name="level">
                                    <option value="admin" {{ ($menu->id == 'admin') ? "selected" : "" }}>Admin Level Menu</option>
                                    <option value="client" {{ ($menu->id == 'client') ? "selected" : "" }}>Client Level Menu</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="status">Menu Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1" {{ ($menu->id == '1') ? "selected" : "" }}>Active</option>
                                    <option value="0" {{ ($menu->id == '0') ? "selected" : "" }}>Block</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Menu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
