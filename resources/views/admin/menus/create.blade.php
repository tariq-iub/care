@extends('layouts.care')
@section('title', 'Create Menu')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Create Menu</h4>
                    </div>
                </div>

                <div class="iq-card-body">
                    <form action="{{ route('menus.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="title">Menu Title</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Menu Title" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="icon">Menu Icon</label>
                                <input type="text" class="form-control" id="icon" name="icon" placeholder="Menu Icon">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="route">Menu Route</label>
                                <input type="text" class="form-control" id="route" name="route" placeholder="Menu Route">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="parent_id">Parent Menu</label>
                                <select class="form-control" id="parent_id" name="parent_id">
                                    <option>Select Parent</option>
                                    @foreach($parentMenus as $menu)
                                        <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="display_order">Display Order</label>
                                <input type="number" class="form-control" id="display_order" name="display_order"
                                       min="0" max="100" value="0">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="level">Menu Level</label>
                                <select class="form-control" id="level" name="level">
                                    <option value="admin">Admin Level Menu</option>
                                    <option value="client">Client Level Menu</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="status">Menu Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Block</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Add New Menu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
