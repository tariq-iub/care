@extends('layouts.app')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Inspections</li>
        </ol>
    </nav>

    <h2 class="text-bold text-body-emphasis mb-5">Inspections List</h2>
    <div id="inspections" data-list='{"valueNames":["title","inspection_type"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search users" aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('inspections.create') }}">
                        <span class="fas fa-plus me-2"></span>
                        Add inspection
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mt-3">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="title" style="width:30%; min-width:200px;">Title</th>
                        <th class="sort align-middle" scope="col" data-sort="inspection_type" style="width:10%;">Type</th>
                        <th class="no-sort align-middle text-end">Action</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @foreach($inspections as $row)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle white-space-nowrap title">
                                <div class="d-flex align-items-center text-body text-hover-1000 ps-2">
                                    <div class="mb-0 ms-3 fw-semibold">
                                        {{ $row->title }}
                                    </div>
                                </div>
                            </td>

                            <td class="role align-middle white-space-nowrap text-body type">
                                <div class="mb-0 ms-3 fw-semibold">
                                    {{ $row->inspection_type }}
                                </div>
                            </td>

                            <td class="last_active align-middle text-end white-space-nowrap text-body-tertiary">
                                <div class="btn-reveal-trigger position-static">
                                    <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
                                            type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                        <span class="fas fa-ellipsis fs-10"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2" style="">
                                        <a class="dropdown-item" href="{{ route('inspections.edit', $row->id) }}">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="javascript:void(0)">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>

    </script>
@endpush
