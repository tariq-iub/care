@extends('layouts.care')
@section('title', 'Edit Role')
@section('page-title', 'Edit Role')
@section('page-message', "Edit existing role.")

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">{{ $role->title }}</h4>
                    </div>
                </div>

                <div class="iq-card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="title">Role Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       value="{{ $role->title }}" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="menus">Attach Menus</label>
                                <select id="menus" name="menus" size="20" multiple>
                                    @foreach($menus as $menu)
                                        <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Update Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            var menuDl = $('[name=menus]').bootstrapDualListbox({
                preserveSelectionOnMove: 'moved',
                moveOnSelect: false,
                filterPlaceHolder: '',
                moveSelectedLabel: 'Move Selected',
                moveAllLabel: 'Move All',
                removeSelectedLabel: 'Remove Selected',
                removeAllLabel: 'Remove All'
            });
        });
    </script>
@endpush
