@extends('layouts.care')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Menus</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Menus</h2>
        <p class="text-body-tertiary lead">Manage the menu items.</p>
    </div>

    <div id="menus" data-list='{"valueNames":["title","route","parent_id","display_order","level","status"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search menus" aria-label="Search"/>
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('menus.create') }}">
                        <span class="fas fa-plus me-2"></span>
                        Add Menu
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="title" style="width:15%; min-width:150px;">Title</th>
                        <th class="sort align-middle" scope="col" data-sort="route" style="width:15%; min-width:150px;">Route</th>
                        <th class="sort align-middle" scope="col" data-sort="parent_id" style="width:15%; min-width:150px;">Parent Menu</th>
                        <th class="sort align-middle" scope="col" data-sort="display_order" style="width:10%;">Display Order</th>
                        <th class="sort align-middle" scope="col" data-sort="level" style="width:10%;">Level</th>
                        <th class="sort align-middle" scope="col" data-sort="status" style="width:3%;">Status</th>
                        <th class="sort align-middle text-end" scope="col" style="width:10%;">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="list" id="menus-table-body">
                    @foreach($menus as $menu)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle ps-3">
                                <h6 class="fw-semibold">{{ $menu->title }}</h6>
                            </td>
                            <td class="align-middle">
                                <a class="fw-semibold" href="{{ $menu->route }}">{{ $menu->route }}</a>
                            </td>
                            <td class="align-middle">
                                {{ $menu->parent_id && $menu->parent ? $menu->parent->title : 'None' }}
                            </td>
                            <td class="align-middle text-body">
                                {{ $menu->display_order }}
                            </td>
                            <td class="align-middle text-body">
                                {{ $menu->level }}
                            </td>
                            <td class="align-middle text-body">
                                @if($menu->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="align-middle text-end white-space-nowrap text-body-tertiary">
                                <div class="btn-reveal-trigger position-static">
                                    <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path fill="currentColor" d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"></path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2">
                                        <a class="dropdown-item" href="{{ route('menus.edit', $menu->id) }}">Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                <div class="col-auto d-flex">
                    <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
                    <a class="fw-semibold" href="#!" data-list-view="*">View all <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                    <a class="fw-semibold d-none" href="#!" data-list-view="less">View Less <span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
                <div class="col-auto d-flex">
                    <button class="page-link" data-list-pagination="prev">
                        <span class="fas fa-chevron-left"></span>
                    </button>
                    <ul class="mb-0 pagination"></ul>
                    <button class="page-link pe-0" data-list-pagination="next">
                        <span class="fas fa-chevron-right"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
