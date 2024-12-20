@extends('layouts.app')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Files</li>
        </ol>
    </nav>

    <div id="datafiles" data-list='{"valueNames":["title","inspection_type"]'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="mb-5">
                    <h2 class="text-bold text-body-emphasis">Data Files</h2>
                    <p class="text-body-tertiary lead">Manage the files pushed by devices.</p>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('data.create') }}">
                        <span class="fas fa-plus me-2"></span>
                        Upload Data
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar mt-3 mb-3">
                <table class="table data-table table-sm fs-9 mt-3 mb-0">
                    <thead>
                    <tr>
                        <th class="sort align-middle" style="width:15%; min-width:50px;">Sr#</th>
                        <th class="sort align-middle" style="width:15%; min-width:200px;">File Title</th>
                        <th class="sort align-middle" style="width:15%; min-width:200px;">Device</th>
                        <th class="sort align-middle" style="width:15%; min-width:200px;">Machine</th>
                        <th class="sort align-middle" style="width:15%; min-width:200px;">Vibration Location</th>
                        <th class="sort align-middle" style="width:15%; min-width:200px;">Uploaded At</th>
                        <th class="no-sort"></th>
                    </tr>
                    </thead>

                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade bd-replace-modal-lg" tabindex="-1" data-bs-backdrop="static"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title" id="staticBackdropLabel">Replace File</h5>
                    <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fas fa-times fs-9"></span>
                    </button>
                </div>
                <form id="replace-form" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="record-id" name="id" value="">
                        <div class="mb-3">
                            <label class="form-label" for="data-file">Data file</label>
                            <input type="file" class="form-control" name="file" id="data-file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Replace File</button>
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('data.datafiles') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'file_name', name: 'file_name'},
                    {data: 'device', name: 'device_serial'},
                    {data: 'machine', name: 'machine_name'},
                    {data: 'vibration_location', name: 'vibration_location_name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

        function deleteFile(ctrl, id) {
            if (confirm('Are you sure to delete this file?')) {
                fetch(`{{ url('data') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        $(ctrl).closest('tr').hide().remove();
                    });
            }
        }

        function OpenReplaceModal(id) {
            $("#record-id").val(id);
            $(".bd-replace-modal-lg").modal('show');
        }

        const form2 = document.querySelector('#replace-form');
        form2.addEventListener("submit", (event) => {
            event.preventDefault();

            const formData = new FormData(form2);
            fetch(`{{ url('api/data/replace') }}`, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                });
        });
    </script>
@endpush
