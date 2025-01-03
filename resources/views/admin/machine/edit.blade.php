@extends('layouts.care')

@section('content')
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <h2 class="text-bold text-body-emphasis">Create Machine</h2>
            <p class="text-muted">This setup will allow you to define the components that belongs to machine</p>
        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center">
                <button class="btn btn-primary" id="save-mid-setup" onclick="updateMachine()">Update Machine</button>
            </div>
        </div>
    </div>

    <div class="col-12 col-xxl-auto">
        <div class="row">
            <div class="col-12 col-xl-12 order-2 order-xl-1">
                <div class="card shadow-none border mb-4" data-component-card="data-component-card">
                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard">
                        <div class="row justify-content-between">
                            <div class="col-md-12">
                                <div class="tab-content">
                                    <p class="fs-8 fw-bold">
                                        Give the machine a name and assign a MID and Area.
                                    </p>

                                    <form>
                                        <div class="col g-3">
                                            <div class="form-group col mb-3">
                                                <label for="machine-name" class="form-label-sm me-2 w-100">Machine Name<span class="text-danger">*</span></label>
                                                <input type="hidden" name="machine-id" id="machine-id" value="{{$machine->id}}">
                                                <input type="text" class="form-control me-2" id="machine-name" name="machine-name" value="{{$machine->machine_name}}" required>
                                            </div>

                                            <div class="form-group col mb-3">
                                                <label for="mid-number" class="form-label-sm me-2 w-100">MID Number<span class="text-danger">*</span></label>
                                                <select class="form-select me-2" id="mid-number" name="mid-number" required>
                                                    @foreach($mids as $mid)
                                                        <option value="{{ $mid->id }}" @if($mid->id == $machine->mid_setup_id) selected @endif>{{ $mid->id }} | {{ $mid->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col mb-3">
                                                <label for="plant-name" class="form-label-sm me-2 w-100">Plant Name<span class="text-danger">*</span></label>
                                                <select class="form-select me-2" id="plant-name" name="plant-name" required>
                                                    @foreach($plants as $plant)
                                                        <option value="{{ $plant->id }}" @if($plant->id == $machine->plant_id) selected @endif>{{ $plant->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col mb-3">
                                                <label for="area-name" class="form-label-sm me-2 w-100">Area Name<span class="text-danger">*</span></label>
                                                <select class="form-select me-2" id="area-name" name="area-name" required>
                                                    @foreach($areas as $area)
                                                        <option value="{{ $area->id }}" @if($area->id == $machine->area_id) selected @endif>{{ $area->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-none border mb-4" data-component-card="data-component-card">
                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard">
                        <div class="row justify-content-between">
                            <div class="col-md-12">
                                <div class="tab-content">
                                    <p class="fs-8 fw-bold">
                                        Give the machine a name and assign a MID and Area.
                                    </p>

                                    <form>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input vibration-location-checkbox" id="checkbox" name="checkbox" value="1" checked>
                                            <label for="checkbox" class="form-label-sm me-2 w-100">Include vibration location on this machine</label>
                                        </div>
                                        <div class="table-responsive scrollbar ms-n1 ps-1">
                                            <table class="table table-sm fs-9 mb-0 vibration-location">
                                                <thead>
                                                <tr>
                                                    <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">

                                                    </th>
                                                    <th class="sort align-middle d-none" scope="col" style="width:15%; min-width:200px;">
                                                        Id
                                                    </th>
                                                    <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                                                        Location Name
                                                    </th>
                                                    <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                                                        Position
                                                    </th>
                                                    <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                                                        ID Tag
                                                    </th>
                                                    <th class="sort align-middle" scope="col" style="width:21%;  min-width:200px;">
                                                        Orientation
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="list" id="vibration-locations-body">
                                                @foreach($locations as $location)
                                                    @if($location['is_locations_enabled'])
                                                    <tr class="position-static">
                                                        <td class="question align-middle white-space-nowrap border-md">
                                                            <i class="fas fa-caret-right d-none" style="font-size: 30px;"></i>
                                                        </td>
                                                        <td class="city align-middle white-space-nowrap border-md d-none">
                                                            <input type="text" name="location-id" id="location-id" class="form-control w-100 h-100 border-0 rounded-0" value="{{$location['id']}}">
                                                        </td>
                                                        <td class="city align-middle white-space-nowrap border-md">
                                                            <input type="text" name="location-name" id="location-name" class="form-control w-100 h-100 border-0 rounded-0" value="{{$location['location_name']}}">
                                                        </td>
                                                        <td class="city align-middle white-space-nowrap border-md">
                                                            <input type="text" name="position" id="position" class="form-control w-100 h-100 border-0 rounded-0" value="{{$location['position']}}">
                                                        </td>
                                                        <td class="email align-middle white-space-nowrap border-md">
                                                            <input type="text" name="id-tag" id="id-tag" class="form-control w-100 h-100 border-0 rounded-0" value="{{$location['id_tag']}}">
                                                        </td>
                                                        <td class="last_active align-middle white-space-nowrap border-md">
                                                            <select class="form-select me-2 border-0" id="orientation" name="orientation" required>
                                                                @foreach($location['orientations'] as $orientation)
                                                                    <option value="{{ $orientation }}" @if($location['orientation'] == $orientation) selected @endif>{{ $orientation }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-none border mb-4" data-component-card="data-component-card">
                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard">
                        <div class="row justify-content-between">
                            <div class="col-md-12">
                                <div class="tab-content">
                                    <p class="fs-8 fw-bold">
                                        Check the box to collect process (temperature, pressure, etc) data. Describe the essential information related to the process points.
                                    </p>

                                    <form>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input process-points-checkbox" id="checkbox" name="checkbox" value="1" checked>
                                            <label for="checkbox" class="form-label-sm me-2 w-100">Include process points on this machine</label>
                                        </div>
                                        <div class="table-responsive scrollbar ms-n1 ps-1">
                                            <table class="table table-sm fs-9 mb-0 process-points">
                                                <thead>
                                                <tr>
                                                    <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">

                                                    </th>
                                                    <th class="sort align-middle d-none" scope="col" style="width:15%; min-width:200px;">
                                                        Id
                                                    </th>
                                                    <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                                                        Point Name
                                                    </th>
                                                    <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                                                        ID Tag
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="list" id="process-points-body">

                                                @foreach($processPoints as $processPoint)
                                                    <tr class="position-static">
                                                        <td class="question align-middle white-space-nowrap border-md">
                                                            <i class="fas fa-caret-right d-none" style="font-size: 30px;"></i>
                                                        </td>
                                                        <td class="city align-middle white-space-nowrap border-md d-none">
                                                            <input type="text" name="point-id" id="point-id" class="form-control w-100 h-100 border-0 rounded-0" value="{{$processPoint['id']}}">
                                                        </td>
                                                        <td class="city align-middle white-space-nowrap border-md">
                                                            <input type="text" name="point-name" id="point-name" class="form-control w-100 h-100 border-0 rounded-0" value="{{$processPoint['point_name']}}">
                                                        </td>
                                                        <td class="city align-middle white-space-nowrap border-md">
                                                            <input type="text" name="id-tag" id="id-tag" class="form-control w-100 h-100 border-0 rounded-0" value="{{$processPoint['id_tag']}}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@push('scripts')
    <script>
        $(document).ready(function () {
            $('table.vibration-location tbody tr, table.process-points tbody tr').click(function () {
                const $table = $(this).closest('table');

                $table.find('.fa-caret-right').addClass('d-none');
                $table.find('tr').removeClass('selected-row');

                $(this).find('.fa-caret-right').removeClass('d-none');
                $(this).addClass('selected-row');
            });

            $('.vibration-location-checkbox').change(function () {
                const isEnabled = $(this).is(':checked');
                $('.vibration-location input, .vibration-location select').prop('disabled', !isEnabled);
            });

            $('.process-points-checkbox').change(function () {
                const isEnabled = $(this).is(':checked');
                $('.process-points input, .process-points select').prop('disabled', !isEnabled);
            });
        });

        function updateMachine(){

            let forms = document.querySelectorAll('form');
            forms.forEach((form) => {
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }
            });
            const machineName = $('#machine-name').val();
            const midNumber = $('#mid-number').val();
            const plantName = $('#plant-name').val();
            const areaName = $('#area-name').val();
            const isVibrationLocationChecked = $('.vibration-location-checkbox').is(':checked');
            const isProcessPointsChecked = $('.process-points-checkbox').is(':checked');

            const locations = [];
            $('#vibration-locations-body tr').each(function () {
                const id = $(this).find('input[name="location-id"]').val();
                const locationName = $(this).find('input[name="location-name"]').val();
                const position = $(this).find('input[name="position"]').val();
                const idTag = $(this).find('input[name="id-tag"]').val();
                const orientation = $(this).find('select[name="orientation"]').val();

                locations.push({
                    id,
                    locationName,
                    position,
                    idTag,
                    orientation
                });
            });


            const points = [];
            $('#process-points-body tr').each(function () {
                const id = $(this).find('input[name="point-id"]').val();
                const pointName = $(this).find('input[name="point-name"]').val();
                const idTag = $(this).find('input[name="id-tag"]').val();

                points.push({
                    id,
                    pointName,
                    idTag
                });
            });

            data = {
                _token: '{{ csrf_token() }}',
                mid_setup_id: midNumber,
                info: {
                    machineName,
                    plantName,
                    areaName,
                },
                locationVibrations: {
                    isVibrationLocationChecked,
                    locations
                },
                processPoints: {
                    isProcessPointsChecked,
                    points
                }
            };

            $.post('/api/machine/update/' + $('#machine-id').val(),
                data
                , function (response) {
                    if (response.success) {
                        window.location.href = '/machines';
                    }
                }
            );
        }
    </script>
@endpush
