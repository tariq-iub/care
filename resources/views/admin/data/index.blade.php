@extends('layouts.care')
@section('title', 'Data Files')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Uploaded Files List</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-hover table-bordered mt-4" style="width:100%">
                            <thead>
                            <tr>
                                <th class="text-center">ID#</th>
                                <th>Title</th>
                                <th>Icon</th>
                                <th>Route</th>
                                <th>Parent Menu</th>
                                <th class="text-center">Display Order</th>
                                <th>Level</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td class="text-center">{{ $menu->id }}</td>
                                    <td>{{ $menu->title }}</td>
                                    <td>
                                        <i class="{{ $menu->icon }}"></i> {{ $menu->icon }}
                                    </td>
                                    <td>{{ $menu->route }}</td>
                                    <td>{{ $menu->parent->title ?? '' }}</td>
                                    <td class="text-center">{{ $menu->display_order }}</td>
                                    <td>{{ $menu->level }}</td>
                                    <td class="text-center">
                                        @if($menu->status)
                                            <span class="badge iq-bg-success">Active</span>
                                        @else
                                            <span class="badge iq-bg-danger">Blocked</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center list-user-action">
                                            <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                            <a class="iq-bg-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush