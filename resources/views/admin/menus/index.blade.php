@extends('layouts.care')
@section('title', 'System Menus')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Menu List</h4>
                    </div>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-hover table-bordered mt-4" style="width:100%">
                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Title</th>
                                <th>Icon</th>
                                <th>Route</th>
                                <th>Parent Menu</th>
                                <th>Display Order</th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td>{{ $menu->id }}</td>
                                    <td>{{ $menu->title }}</td>
                                    <td>{{ $menu->icon }}</td>
                                    <td>{{ $menu->route }}</td>
                                    <td>{{ $menu->parent_id }}</td>
                                    <td>{{ $menu->display_order }}</td>
                                    <td>{{ $menu->level }}</td>
                                    <td>{{ $menu->status }}</td>
                                    <td></td>
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
    <script>
        $(document).ready(function() {
            $("#myTable").DataTable({
                responsive: true,
                ordering: false,
                paging: true,
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10 rows', '25 rows', '50 rows', 'Show all']
                ],
                buttons: [
                    'copy', 'print', 'pageLength'
                ]
            });
        });
    </script>
@endpush
