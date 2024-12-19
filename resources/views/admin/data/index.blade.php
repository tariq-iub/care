@extends('layouts.app')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item active">Data Files</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Data Files</h2>
        <p class="text-body-tertiary lead">Manage the files pushed by devices.</p>
    </div>

    <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
        <div class="table-responsive scrollbar mt-3 mb-3">
            <table class="table data-table table-sm fs-9 mt-3 mb-0">
                <thead>
                <tr>
                    <th class="sort align-middle" style="width:15%; min-width:50px;">Sr#</th>
                    <th class="sort align-middle" style="width:15%; min-width:200px;">File Title</th>
                    <th class="sort align-middle" style="width:15%; min-width:200px;">Device</th>
                    <th class="sort align-middle" style="width:15%; min-width:200px;">Area</th>
                    <th class="sort align-middle" style="width:15%; min-width:200px;">Factory</th>
                    <th class="sort align-middle" style="width:15%; min-width:200px;">Uploaded At</th>
                    <th class="no-sort"></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade bd-edit-modal-lg" tabindex="-1" data-bs-backdrop="static"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New File</h5>
                    <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fas fa-times fs-9"></span>
                    </button>
                </div>
                <form id="edit-form" method="POST" action="" class="row g-3 needs-validation"
                      enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="modal-body px-5">
                        <div class="mb-3">
                            <label class="form-label" for="factory_id">Factory</label>
                            <select class="form-select" id="factory_id" name="factory_id" data-choices="data-choices"
                                    data-options='{"removeItemButton":true,"placeholder":true}' required>
                                <option value="">Select Factory</option>
                                @foreach($plants as $plant)
                                    <option value="{{ $plant->id }}">{{ $plant->title }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Select a factory name...</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="site_id">Site</label>
                            <select class="form-select" id="site_id" name="site_id" required>
                                <option value="">Select Site</option>
                            </select>
                            <div class="invalid-feedback">Select a site name...</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="component_id">Component (optional)</label>
                            <select class="form-select" id="component_id" name="component_id"
                                    data-choices="data-choices"
                                    data-options='{"removeItemButton":true,"placeholder":true}'>
                                <option value="">Not Applicable</option>
                            </select>
                            <div class="invalid-feedback">Select a component name...</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="device_serial">Device</label>
                            <select class="form-select" id="device_serial" name="device_serial"
                                    data-choices="data-choices"
                                    data-options='{"removeItemButton":true,"placeholder":true}' required>
                                <option value="">Select Device</option>
                                @foreach($devices as $device)
                                    <option value="{{ $device->serial_number }}">{{ $device->serial_number }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Select a device name...</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="data-file">Data file</label>
                            <input type="file" class="form-control" name="file" id="data-file" required>
                            <div class="invalid-feedback">Data file needs to be selected.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Upload Data</button>
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
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
                ajax: "{{ route('data.data') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'file_name', name: 'file_name'},
                    {data: 'device', name: 'device.serial_number'},
                    {data: 'area', name: 'area.title'},
                    {data: 'plant', name: 'area.plant.title'},
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

        $("#factory_id").on("change", function () {
            var id = $(this).val();
            $("#site_id").empty();
            fetch(`{{ url('api/factories?id=') }}${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response is not OK');
                    }
                    return response.json();
                })
                .then(data => {
                    $("#site_id").append(`<option value=''>Select Site</option>`);
                    console.log(data.sites);
                    data.sites.forEach((item, index) => {
                        $("#site_id").append(`<option value='${item.id}'>${item.title}</option>`);
                    });
                })
                .catch(error => {
                    alert('There was a problem with the fetch operation:' + error);
                });
        });

        $("#site_id").on("change", function () {
            var id = $(this).val();
            $("#component_id").empty();
            fetch(`{{ url('api/sites?id=') }}${id}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response is not OK');
                    }
                    return response.json();
                })
                .then(data => {
                    $("#component_id").append(`<option value=''>Not Applicable</option>`);
                    data.components.forEach((item, index) => {
                        $("#component_id").append(`<option value='${item.id}'>${item.title}</option>`);
                    });
                })
                .catch(error => {
                    alert('There was a problem with the fetch operation:' + error);
                });
        });

        const form = document.querySelector('#posted');
        form.addEventListener("submit", (event) => {
            event.preventDefault();

            const formData = new FormData(form);
            fetch("{{ url('api/data/upload') }}", {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                });
        });

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

        function OpenEditModal(id) {
            fetch(`{{ url('data') }}/${id}`, {
                method: 'GET'
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response is not OK');
                    }
                    return response.json();
                })
                .then(data => {
                    // Populate the form with the fetched data
                    $('#factory_id').val(data.factory_id);
                    $('#site_id').val(data.site_id);
                    $('#component_id').val(data.component_id);
                    $('#device_serial').val(data.device_serial);

                    // Since the file input cannot be pre-filled for security reasons, you might want to notify the user if a file is already present.
                    $('#edit-form').attr('action', `{{ url('data') }}/${id}`);

                    // Open the modal
                    $(".bd-edit-modal-lg").modal('show');
                })
                .catch(error => {
                    alert('There was a problem with the fetch operation: ' + error);
                });
        }

        $(document).ready(function () {
            // Handle the form submission for the edit form
            const editForm = document.querySelector('#edit-form');
            editForm.addEventListener("submit", (event) => {
                event.preventDefault();
                const formData = new FormData(editForm);
                const id = formData.get('id'); // Get the ID from the form
                fetch(`{{ url('data') }}/${id}`, {
                    method: 'PUT',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        location.reload();
                    });
            });
        });
    </script>
@endpush
