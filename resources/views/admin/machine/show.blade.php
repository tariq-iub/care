@extends('layouts.care')

@section('content')
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <h2 class="text-bold text-body-emphasis">Create Machine</h2>
            <p class="text-muted">This setup will allow you to define the components that belongs to machine</p>
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
                                                <input type="text" class="form-control me-2" id="machine-name" name="machine-name" value="{{$machine->machine_name}}" readonly>
                                            </div>

                                            <div class="form-group col mb-3">
                                                <label for="mid-number" class="form-label-sm me-2 w-100">MID Number<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control me-2" id="mid-number" name="mid-number" value="{{$machine->mid_setup_id}}" readonly>
                                            </div>

                                            <div class="form-group col mb-3">
                                                <label for="plant-name" class="form-label-sm me-2 w-100">Plant Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control me-2" name="plant-id" id="plant-id" value="{{$machine->plant->title}}" readonly>
                                            </div>

                                            <div class="form-group col mb-3">
                                                <label for="area-name" class="form-label-sm me-2 w-100">Area Name<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control me-2" name="area-id" id="area-id" value="{{$machine->area->name}}" readonly>
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
                                            <input type="checkbox" class="form-check-input vibration-location-checkbox" id="checkbox" name="checkbox" value="1" {{$isVibrationLocationChecked ? 'checked' : ''}} onclick="return false;">
                                            <label for="checkbox" class="form-label-sm me-2 w-100">Include vibration location on this machine</label>
                                        </div>
                                        <div class="table-responsive scrollbar ms-n1 ps-1">
                                            <table class="table table-sm fs-9 mb-0 vibration-location">
                                                <thead>
                                                <tr>
                                                    <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">

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
                                                            <td class="city align-middle white-space-nowrap border-md">
                                                                <input type="text" name="location-name" id="location-name" class="form-control w-100 h-100 border-0 rounded-0" value="{{$location['location_name']}}" readonly>
                                                            </td>
                                                            <td class="city align-middle white-space-nowrap border-md">
                                                                <input type="text" name="position" id="position" class="form-control w-100 h-100 border-0 rounded-0" value="{{$location['position']}}" readonly>
                                                            </td>
                                                            <td class="email align-middle white-space-nowrap border-md">
                                                                <input type="text" name="id-tag" id="id-tag" class="form-control w-100 h-100 border-0 rounded-0" value="{{$location['id_tag']}}" readonly>
                                                            </td>
                                                            <td class="last_active align-middle white-space-nowrap border-md">
                                                                <input type="text" name="orientation" id="orientation" class="form-control w-100 h-100 border-0 rounded-0" value="{{$location['orientation']}}" readonly>
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
                                            <input type="checkbox" class="form-check-input process-points-checkbox" id="checkbox" name="checkbox" value="1" {{$isProcessPointsChecked ? 'checked' : ''}} onclick="return false;">
                                            <label for="checkbox" class="form-label-sm me-2 w-100">Include process points on this machine</label>
                                        </div>
                                        <div class="table-responsive scrollbar ms-n1 ps-1">
                                            <table class="table table-sm fs-9 mb-0 process-points">
                                                <thead>
                                                <tr>
                                                    <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">

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
                                                    @if($processPoint['is_points_enabled'])
                                                    <tr class="position-static">
                                                        <td class="question align-middle white-space-nowrap border-md">
                                                            <i class="fas fa-caret-right d-none" style="font-size: 30px;"></i>
                                                        </td>
                                                        <td class="city align-middle white-space-nowrap border-md">
                                                            <input type="text" name="point-name" id="point-name" class="form-control w-100 h-100 border-0 rounded-0" value="{{$processPoint['point_name']}}" readonly>
                                                        </td>
                                                        <td class="city align-middle white-space-nowrap border-md">
                                                            <input type="text" name="id-tag" id="id-tag" class="form-control w-100 h-100 border-0 rounded-0" value="{{$processPoint['id_tag']}}" readonly>
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
            </div>
        </div>
    </div>
@endsection()
