@extends('layouts.care')

@section('content')
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <h2 class="text-bold text-body-emphasis">New MID</h2>
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
                                    <p class="nav nav-underline fs-9 p-1 mb-2" id="myTab" role="tablist">
                                        <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#tab-general" role="tab" aria-controls="tab-general" aria-selected="false">General</a>
                                        <a class="nav-link" id="components-tab" data-bs-toggle="tab" href="#tab-components" role="tab" aria-controls="tab-components" aria-selected="false">Components</a>
                                        <a class="nav-link" id="frequencies-tab" data-bs-toggle="tab" href="#tab-frequencies" role="tab" aria-controls="tab-frequencies" aria-selected="false">Forcing Frequencies</a>
                                    </p>
                                    <div class="tab-pane active" id="tab-general" role="tabpanel" aria-labelledby="general-tab">
                                        <form>
                                            <div class="col g-3">
                                                <div class="form-group d-flex mb-3 align-items-center">
                                                    <label for="mid-number" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">MID Number<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control me-2" id="mid-number" name="mid-number" value="{{$midSetup != null ? $midSetup->id : ""}}" readonly>
                                                </div>

                                                <div class="form-group d-flex mb-3 align-items-center">
                                                    <label for="name" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">Name<span class="text-danger">*</span></label>
                                                    <input class="form-control me-2" id="name" name="name" value="{{$midSetup != null ? $midSetup->title : ""}}" readonly>
                                                </div>

                                                <div class="form-group d-flex mb-3 align-items-center d-none">
                                                    <label for="name" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">Name<span class="text-danger">*</span></label>
                                                    <input class="form-control me-2" id="mid-general-id" name="mid-general-id" value="{{$midGeneral != null ? $midGeneral->id : ""}}">
                                                </div>

                                                <div class="form-group d-flex mb-3 align-items-center">
                                                    <label for="nominal-speed-2" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">Nominal Speed<span class="text-danger">*</span></label>
                                                    <div class="d-flex flex-grow-1 align-items-center">
                                                        <input class="form-control me-2" id="nominal-speed-2" name="nominal-speed" value="{{$midGeneral != null ? $midGeneral->nominal_speed : ""}}" readonly>
                                                        <div class="form-check ms-2">
                                                            <input class="form-check-input" id="flexRadioDefaultHz-2" type="radio" name="flexRadioDefaultSpeed-2" value="Hz" {{$midGeneral != null && $midGeneral->speed_unit == "Hz" ? "checked" : ""}} onclick="return false;">
                                                            <label class="form-check-label fs-8" for="flexRadioDefaultHz-2">Hz</label>
                                                        </div>
                                                        <div class="form-check ms-2">
                                                            <input class="form-check-input" id="flexRadioDefaultCPM-2" type="radio" name="flexRadioDefaultSpeed-2" value="CPM" {{$midGeneral != null && $midGeneral->speed_unit == "CPM" ? "checked" : ""}} onclick="return false;">
                                                            <label class="form-check-label fs-8" for="flexRadioDefaultCPM-2">CPM</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group d-flex mb-3 align-items-center">
                                                    <label for="secondary-speed-ratio" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">Secondary Speed Ratio<span class="text-danger">*</span></label>
                                                    <input class="form-control me-2" id="secondary-speed-ratio" name="secondary-speed-ratio" value="{{$midGeneral != null ? $midGeneral->secondary_speed_ratio : ""}}" readonly>
                                                </div>

                                                <div class="form-group d-flex mb-3 align-items-center">
                                                    <label for="mid-rating" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">MID Rating<span class="text-danger">*</span></label>
                                                    <input class="form-control me-2" id="mid-rating" name="mid-rating" value="{{$midGeneral != null ? $midGeneral->mid_rating : ""}}" required>
                                                </div>

                                                <div class="form-group d-flex mb-3 align-items-center">
                                                    <label for="mid-number" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">Machine Orientation<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control me-2" id="machine-orientation" name="machine-orientation" value="{{$midGeneral != null ? $midGeneral->machine_orientation : ""}}" readonly>
                                                </div>

                                                <div class="form-group d-flex mb-3">
                                                    <label for="mid-number" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">Design Layout</label>

                                                    <div class="border p-2">
                                                        <div>Current MID</div>
                                                        <div class="ms-3">
                                                            @foreach($components as $index => $componentGroup)
                                                                @foreach($componentGroup as $component)
                                                                    <div>⎯ {{ $component }}</div>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="tab-components" role="tabpanel" aria-labelledby="components-tab">
                                        <form>
                                            <div class="col g-3">
                                                @foreach($midComponents as $index => $midComponent)
                                                    <div class="border p-2 mb-4" id="components-tab-{{$index + 1}}">
                                                        <div class="form-group d-flex mb-3 align-items-center d-none">
                                                            <label for="component-code" class="form-label-sm me-2 w-30">Id<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control me-2" id="component-id" name="component-id" value="{{$midComponent->id}}" readonly>
                                                        </div>
                                                        <div class="form-group d-flex mb-3 align-items-center">
                                                            <label for="component-code" class="form-label-sm me-2 w-30">Component Code<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control me-2" id="component-code" name="component-code" value="{{$midComponent->component_code}}" readonly>
                                                        </div>
                                                        <div class="form-group d-flex mb-3 align-items-center">
                                                            <label for="description" class="form-label-sm me-2 w-30">Description<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control me-2" id="description" name="description" value="{{$midComponent->description}}" readonly>
                                                        </div>
                                                        <div class="form-group d-flex mb-3 align-items-center">
                                                            <label for="pickup-code" class="form-label-sm me-2 w-30">Pickup Code<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control me-2" id="pickup-code" name="pickup-code" value="{{$midComponent->pickup_code}}" readonly>
                                                        </div>
                                                        <div class="form-group d-flex mb-3 align-items-center">
                                                            <label for="bearing-monitored" class="form-label-sm me-2 w-30">Bearing Monitored<span class="text-danger">*</span></label>
                                                            <div class="row g-2">
                                                                @foreach($midComponent->bearings_monitored_array as $index => $bearing)
                                                                    <div class="col-md-6">
                                                                        <input type="number"
                                                                               class="form-control"
                                                                               id="bearing-monitored{{ $index + 1 }}"
                                                                               name="bearings_monitored"
                                                                               value="{{ $bearing }}"
                                                                               readonly>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="tab-frequencies" role="tabpanel" aria-labelledby="frequencies-tab">
                                        <form>
                                            <div class="col g-3">
                                                <div class="table-responsive scrollbar ms-n1 ps-1">
                                                    <table class="table table-sm fs-9 mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th class="sort align-middle" scope="col" style="width:15%; min-width:100px;">

                                                            </th>
                                                            <th class="sort align-middle d-none" scope="col" style="width:15%; min-width:100px;">
                                                                Id
                                                            </th>
                                                            <th class="sort align-middle" scope="col" style="width:15%; min-width:170px;">
                                                                Code
                                                            </th>
                                                            <th class="sort align-middle d-none" scope="col">
                                                                Multiple
                                                            </th>
                                                            <th class="sort align-middle" scope="col" style="width:20%; min-width:170px;">
                                                                Name
                                                            </th>
                                                            <th class="sort align-middle" scope="col" style="width:15%; min-width:170px;">
                                                                On Secondary
                                                            </th>
                                                            <th class="sort align-middle" scope="col" style="width:15%;  min-width:170px;">
                                                                Elements
                                                            </th>
                                                            <th class="sort align-middle" scope="col" style="width:15%;  min-width:170px;">
                                                                Final Ratio
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="list" id="setups-table-body">
                                                        @foreach($forcing_frequencies as $forcing_frequency)
                                                            <tr class="position-static">
                                                                <td class="align-middle white-space-nowrap border-md">
                                                                    <i class="fas fa-caret-right d-none" style="font-size: 30px;"></i>
                                                                </td>
                                                                <td class="id align-middle white-space-nowrap border-md d-none">
                                                                    <input type="text" name="id" id="id" class="form-control w-100 h-100 border-0 rounded-0" value="{{$forcing_frequency['id']}}" readonly>
                                                                </td>
                                                                <td class="code align-middle white-space-nowrap border-md">
                                                                    <input type="text" name="location-name" id="location-name" class="form-control w-100 h-100 border-0 rounded-0" value="{{$forcing_frequency['code']}}" readonly>
                                                                </td>
                                                                <td class="multiple align-middle white-space-nowrap border-md d-none">
                                                                    <input type="text" name="multiple" id="multiple" class="form-control w-100 h-100 border-0 rounded-0" value="{{$forcing_frequency['multiple']}}" readonly>
                                                                </td>
                                                                <td class="name align-middle white-space-nowrap border-md">
                                                                    <input type="text" name="position" id="position" class="form-control w-100 h-100 border-0 rounded-0" value="{{$forcing_frequency['name']}}" readonly>
                                                                </td>
                                                                <td class="on_secondary align-middle white-space-nowrap border-md">
                                                                    <input type="text" name="id-tag" id="id-tag" class="form-control w-100 h-100 border-0 rounded-0" value="{{$forcing_frequency['on_secondary']}}" readonly>
                                                                </td>
                                                                <td class="elements align-middle white-space-nowrap border-md">
                                                                    <input type="text" name="elements" id="elements" class="form-control w-100 h-100 border-0 rounded-0" value="{{$forcing_frequency['elements']}}" readonly>
                                                                </td>
                                                                <td class="final_ratio align-middle white-space-nowrap border-md">
                                                                    <input type="text" name="final-ratio" id="final-ratio" class="form-control w-100 h-100 border-0 rounded-0" value="{{$forcing_frequency['final_ratio']}}" readonly>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
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
    </div>
@endsection
