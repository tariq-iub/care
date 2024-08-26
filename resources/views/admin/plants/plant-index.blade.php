@extends('layouts.care')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
            <li class="breadcrumb-item">Companies</li>
            <li class="breadcrumb-item active">Plants</li>
        </ol>
    </nav>

    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Manage Plants</h2>
    </div>

    <div class="mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-none border" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom bg-body">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-md">
                                <h4 class="text-body mb-0">
                                    Plants
                                </h4>
                            </div>
                            <div class="col-12 col-md">
                                <a class="float-md-end" href="{{ route('plant.create', ['id'=>$company]) }}">
                                    <span class="fas fa-plus me-2"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group">
                            @foreach($plants as $row)
                                <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                   data-id="{{ $row->id }}">
                                        {{ ucwords($row->title) }}
                                    <div class="btn-reveal-trigger position-static">
                                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10 dropdown-button"
                                                type="button" data-bs-toggle="dropdown" data-boundary="window"
                                                aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                            <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true"
                                                 focusable="false" data-prefix="fas" data-icon="ellipsis" role="img"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                                <path fill="currentColor"
                                                      d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"></path>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end py-2" style="">
                                            <a class="dropdown-item" href="{{ route('plant.edit', $row->id) }}">Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0)" data-id="{{ $row->id }}" onclick="openShowPlantModal(event, {{ $row->id }})">Show</a>
                                            <button class="dropdown-item" onclick="openLinkServiceRepModal({{$row->id}})">Link Service Representative</button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8" id="handlers-data">
                <div class="card shadow-none border" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom bg-body">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-md">
                                <h4 class="text-body mb-0">
                                    Plant Name
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Link Service Representative Modal -->
    <div class="modal fade" id="linkServiceRepModal" tabindex="-1" aria-labelledby="linkServiceRepModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="linkServiceRepModalLabel">Link Service Representative</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="linkServiceRepForm">
                        @csrf
                        <input type="hidden" name="plant_id" id="plant_id">
                        <div class="mb-2">
                            <label for="service_rep_id" class="form-label">Select Service Representative</label>

                            <select class="form-select" name="service_rep" id="service-rep-link" required>
                                <option value="">Select Service Representative</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Link Service Representative</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('admin.plants.plant-show')
    @include('admin.area.create')
    @include('admin.area.edit')
    @include('admin.area.show')
@endsection

@push("scripts")
    <script>
        document.querySelectorAll('.dropdown-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });

        document.querySelectorAll('.dropdown-item').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });

        $(".list-group-item").on("click", function() {
            let id = $(this).data('id');
            $(".list-group-item-success").removeClass('list-group-item-success');
            $(this).addClass('list-group-item-success');

            $.get(`{{ url('/api/plant/fetch-plants') }}/${id}`, function(response) {
                $("#handlers-data").html(response);
            });
        });

        function openCreateAreaModal(event, plantId) {
            event.preventDefault();
            let plant_name = $('.list-group-item-success').text().trim();

            $('#create-plant-id').val(plantId);
            $('#create-plant-name').val(plant_name);

            var modal = new bootstrap.Modal(document.getElementById('create-area'), {});
            modal.show();
        }

        function openEditAreaModal(event, areaId) {
            event.preventDefault();
            $.get(`/api/area/fetch-area/${areaId}`, function(response) {
                $('#edit-area-name').val(response.area.name);
                $('#edit-area-id').val(response.area.id);
                $('#edit-plant-id').val(response.area.plant_id);
                $('#edit-plant-name').val(response.area.plant.title);

                if (response.area.line_frequency === '50 Hz') {
                    $('#flexRadioDefault1-edit').prop('checked', true);
                } else {
                    $('#flexRadioDefault2-edit').prop('checked', true);
                }

                var modal = new bootstrap.Modal(document.getElementById('edit-area'), {});
                modal.show();
            });
        }

        function openShowAreaModal(event, areaId) {
            event.preventDefault();
            $.get(`/api/area/fetch-area/${areaId}`, function(response) {
                $('#show-area-name').val(response.area.name);
                $('#show-area-id').val(response.area.id);
                $('#show-plant-id').val(response.area.plant_id);
                $('#show-plant-name').val(response.area.plant.title);

                if (response.area.line_frequency === '50 Hz') {
                    $('#flexRadioDefault1-show').prop('checked', true);
                } else {
                    $('#flexRadioDefault2-show').prop('checked', true);
                }

                var modal = new bootstrap.Modal(document.getElementById('show-area'), {});
                modal.show();
            });
        }

        function openLinkServiceRepModal(plantId) {
            $.get(`/api/plant/fetch-plant-service-rep/${plantId}`, function(response) {
                let serviceReps = response.serviceReps;
                let serviceRepsAll = response.serviceRepsAll;

                serviceReps.forEach(function(serviceRep) {
                    serviceRepsAll = serviceRepsAll.filter(function(item) {
                        return item.id !== serviceRep.id;
                    });
                });

                $('#service-rep-link').empty();
                serviceRepsAll.forEach(function(serviceRep) {
                    $('#service-rep-link').append(`<option value="${serviceRep.id}">${serviceRep.service_rep_name}</option>`);
                });
            });

            $("#plant_id").val(plantId);
            $("#linkServiceRepModal").modal("show");
        }

        $("#linkServiceRepForm").on("submit", function(event) {
            event.preventDefault();
            $plantId = $("#plant_id").val();
            $serviceRepIds = [];
            $serviceRepIds.push($("#service-rep-link").val());
            $.post("{{ url('/api/service-rep/link-service-rep') }}",
                {service_rep_ids: $serviceRepIds, plant_id: $plantId}
                , function(response) {
                    console.log(response);
                    if (response.success) {
                        $("#linkServiceRepForm")[0].reset();
                        $("#linkServiceRepModal").modal("hide");
                    } else {
                        // Handle errors
                    }
                });
        });

        function openShowPlantModal(event, plantId) {
            event.preventDefault();
            $.get(`/api/plant/fetch-plant/${plantId}`, function(response) {
                $("#plant-name").val(response.plant.title);
                $("#plant-status").val(response.plant.status === 1 ? 'Active' : 'Inactive');
                // $('#notes').val(response.note.note);

                if (response.note !== null) {
                    $('#notes').val(response.note.note);
                }
                $('#service-rep').empty();

                response.serviceReps.forEach(function(serviceRep) {
                    $('#service-rep').append(`<option value="${serviceRep.id}">${serviceRep.service_rep_name}</option>`);
                });

                var modal = new bootstrap.Modal(document.getElementById('show-data-collection-setup'), {});
                modal.show();
            });
        }

        $('#button-save-area').on('click', function() {
            let plantId = $('#create-plant-id').val();
            let areaName = $('#create-area-name').val();
            let plantName = $('#create-plant-name').val();
            let lineFrequency = $('input[name="flexRadioDefault"]:checked').val();

            console.log(plantId, areaName, plantName, lineFrequency);

            $.post("{{ url('/api/area/store') }}", {
                plant_id: plantId,
                area_name: areaName,
                plant_name: plantName,
                line_frequency: lineFrequency
            }, function(response) {
                if (response.success) {
                    $('.list-group-item-success').click();
                    $('#create-area').modal('hide');
                }
            });
        });

        $('#update-area-button').on('click', function() {
            let areaId = $('#edit-area-id').val();
            let areaName = $('#edit-area-name').val();
            let lineFrequency = null;
            if ($('#flexRadioDefault1-edit').is(':checked')) {
                lineFrequency = '50 Hz';
            } else {
                lineFrequency = '60 Hz';
            }

            $.post("{{ url('/api/area/update') }}", {
                area_id: areaId,
                area_name: areaName,
                line_frequency: lineFrequency
            }, function(response) {
                if (response.success) {
                    $('.list-group-item-success').click();
                    $('#edit-area').modal('hide');
                }
            });
        });
    </script>
@endpush
