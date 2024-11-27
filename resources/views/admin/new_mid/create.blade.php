@extends('layouts.care')

@section('content')
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <h2 class="text-bold text-body-emphasis">New MID</h2>

        </div>
        <div class="col-auto">
            <div class="d-flex align-items-center">
                <button class="btn btn-primary" id="save-mid-setup" onclick="saveMidSetup()">Save MID Setup</button>
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
                                                    <input type="text" class="form-control me-2" id="mid-number" name="mid-number" value="{{$midSetup != null ? $midSetup->id : ""}}" {{$midSetup != null ? "readonly" : "" }} required>
                                                </div>

                                                <div class="form-group d-flex mb-3 align-items-center">
                                                    <label for="name" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">Name<span class="text-danger">*</span></label>
                                                    <input class="form-control me-2" id="name" name="name" value="{{$midSetup != null ? $midSetup->title : ""}}" required>
                                                </div>

                                                <div class="form-group d-flex mb-3 align-items-center">
                                                    <label for="nominal-speed-2" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">Nominal Speed<span class="text-danger">*</span></label>
                                                    <div class="d-flex flex-grow-1 align-items-center">
                                                        <input class="form-control me-2" id="nominal-speed-2" name="nominal-speed" value="0">
                                                        <div class="form-check ms-2">
                                                            <input class="form-check-input" id="flexRadioDefaultHz-2" type="radio" name="flexRadioDefaultSpeed-2" value="Hz" checked>
                                                            <label class="form-check-label fs-8" for="flexRadioDefaultHz-2">Hz</label>
                                                        </div>
                                                        <div class="form-check ms-2">
                                                            <input class="form-check-input" id="flexRadioDefaultCPM-2" type="radio" name="flexRadioDefaultSpeed-2" value="CPM">
                                                            <label class="form-check-label fs-8" for="flexRadioDefaultCPM-2">CPM</label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group d-flex mb-3 align-items-center">
                                                    <label for="secondary-speed-ratio" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">Secondary Speed Ratio<span class="text-danger">*</span></label>
                                                    <input class="form-control me-2" id="secondary-speed-ratio" name="secondary-speed-ratio" value="1" required>
                                                </div>

                                                <div class="form-group d-flex mb-3 align-items-center">
                                                    <label for="mid-rating" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">MID Rating<span class="text-danger">*</span></label>
                                                    <input class="form-control me-2" id="mid-rating" name="mid-rating" value="100" required>
                                                </div>

                                                <div class="form-group d-flex mb-3 align-items-center">
                                                    <label for="mid-number" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">Machine Orientation<span class="text-danger">*</span></label>
                                                    <select class="form-select me-2" id="machine-orientation" name="machine-orientation" required>
                                                        <option value="Horizontal">Horizontal</option>
                                                        <option value="Vertical">Vertical</option>
                                                    </select>
                                                </div>

                                                <div class="form-group d-flex mb-3">
                                                    <label for="mid-number" class="form-label-sm me-2 flex-shrink-0" style="width: 200px;">Design Layout</label>

                                                    <div class="border p-2">
                                                        <div>Current MID</div>
                                                        <div class="ms-3">
                                                            <div>⎯ MOTOR</div>
                                                            <div>⎯ FLEXIBLE COUPLING</div>
                                                            <div>⎯ CENTRIFUGAL PUMP</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="tab-components" role="tabpanel" aria-labelledby="components-tab">
                                        <form>
                                            <div class="col g-3">
                                                <div class="group d-flex gap-2 mb-4">
                                                    <button class="btn btn-primary">Add</button>
                                                    <button class="btn btn-primary">Previous</button>
                                                    <button class="btn btn-primary">Next</button>
                                                    <button class="btn btn-primary">Update</button>
                                                    <button class="btn btn-primary">Delete</button>
                                                </div>
                                                <div class="border p-2 mb-4" id="components-tab1">
                                                    <div class="form-group d-flex mb-3 align-items-center">
                                                        <label for="component-code" class="form-label-sm me-2 w-30">Component Code<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control me-2" id="component-code" name="component-code" value="" required>
                                                    </div>
                                                    <div class="form-group d-flex mb-3 align-items-center">
                                                        <label for="description" class="form-label-sm me-2 w-30">Description<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control me-2" id="description" name="description" value="" required>
                                                    </div>
                                                    <div class="form-group d-flex mb-3 align-items-center">
                                                        <label for="pickup-code" class="form-label-sm me-2 w-30">Pickup Code<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control me-2" id="pickup-code" name="pickup-code" value="" required>
                                                    </div>
                                                    <div class="form-group d-flex mb-3 align-items-center">
                                                        <label for="bearing-monitored" class="form-label-sm me-2 w-30">Bearing Monitored<span class="text-danger">*</span></label>
                                                        <div class="col">
                                                            <div class="d-flex mb-2">
                                                                <input type="number" class="form-control me-2" id="bearing-monitored1" name="bearing-monitored" value="" required>
                                                                <input type="number" class="form-control me-2" id="bearing-monitored2" name="bearing-monitored" value="" required>
                                                            </div>
                                                            <div class="d-flex">
                                                                <input type="number" class="form-control me-2" id="bearing-monitored3" name="bearing-monitored" value="" required>
                                                                <input type="number" class="form-control me-2" id="bearing-monitored4" name="bearing-monitored" value="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border p-2 mb-4" id="components-tab2">
                                                    <div class="form-group d-flex mb-3 align-items-center">
                                                        <label for="component-code" class="form-label-sm me-2 w-30">Component Code<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control me-2" id="component-code" name="component-code" value="" required>
                                                    </div>
                                                    <div class="form-group d-flex mb-3 align-items-center">
                                                        <label for="description" class="form-label-sm me-2 w-30">Description<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control me-2" id="description" name="description" value="" required>
                                                    </div>
                                                    <div class="form-group d-flex mb-3 align-items-center">
                                                        <label for="pickup-code" class="form-label-sm me-2 w-30">Pickup Code<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control me-2" id="pickup-code" name="pickup-code" value="" required>
                                                    </div>
                                                    <div class="form-group d-flex mb-3 align-items-center">
                                                        <label for="bearing-monitored" class="form-label-sm me-2 w-30">Bearing Monitored<span class="text-danger">*</span></label>
                                                        <div class="col">
                                                            <div class="d-flex mb-2">
                                                                <input type="number" class="form-control me-2" id="bearing-monitored1" name="bearing-monitored" value="" required>
                                                                <input type="number" class="form-control me-2" id="bearing-monitored2" name="bearing-monitored" value="" required>
                                                            </div>
                                                            <div class="d-flex">
                                                                <input type="number" class="form-control me-2" id="bearing-monitored3" name="bearing-monitored" value="" required>
                                                                <input type="number" class="form-control me-2" id="bearing-monitored4" name="bearing-monitored" value="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="border p-2 mb-4" id="components-tab3">
                                                    <div class="form-group d-flex mb-3 align-items-center">
                                                        <label for="component-code" class="form-label-sm me-2 w-30">Component Code<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control me-2" id="component-code" name="component-code" value="" required>
                                                    </div>
                                                    <div class="form-group d-flex mb-3 align-items-center">
                                                        <label for="description" class="form-label-sm me-2 w-30">Description<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control me-2" id="description" name="description" value="" required>
                                                    </div>
                                                    <div class="form-group d-flex mb-3 align-items-center">
                                                        <label for="pickup-code" class="form-label-sm me-2 w-30">Pickup Code<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control me-2" id="pickup-code" name="pickup-code" value="" required>
                                                    </div>
                                                    <div class="form-group d-flex mb-3 align-items-center">
                                                        <label for="bearing-monitored" class="form-label-sm me-2 w-30">Bearing Monitored<span class="text-danger">*</span></label>
                                                        <div class="col">
                                                            <div class="d-flex mb-2">
                                                                <input type="number" class="form-control me-2" id="bearing-monitored1" name="bearing-monitored" value="" required>
                                                                <input type="number" class="form-control me-2" id="bearing-monitored2" name="bearing-monitored" value="" required>
                                                            </div>
                                                            <div class="d-flex">
                                                                <input type="number" class="form-control me-2" id="bearing-monitored3" name="bearing-monitored" value="" required>
                                                                <input type="number" class="form-control me-2" id="bearing-monitored4" name="bearing-monitored" value="" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane" id="tab-frequencies" role="tabpanel" aria-labelledby="frequencies-tab">
                                        <form>
                                            <div class="col g-3">
{{--                                                <button class="btn btn-primary edit-frequency-btn">Edit Item</button>--}}
                                                <div class="table-responsive scrollbar ms-n1 ps-1">
                                                    <table class="table table-sm fs-9 mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th class="sort align-middle" scope="col" style="width:15%; min-width:100px;">

                                                            </th>
                                                            <th class="sort align-middle" scope="col" style="width:15%; min-width:170px;">
                                                                Code
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
                                                                <td class="city align-middle white-space-nowrap border-md">
                                                                    <input type="text" name="location-name" id="location-name" class="form-control w-100 h-100 border-0 rounded-0" value="{{$forcing_frequency['code']}}">
                                                                </td>
                                                                <td class="city align-middle white-space-nowrap border-md">
                                                                    <input type="text" name="position" id="position" class="form-control w-100 h-100 border-0 rounded-0" value="{{$forcing_frequency['name']}}">
                                                                </td>
                                                                <td class="email align-middle white-space-nowrap border-md">
                                                                    <input type="text" name="id-tag" id="id-tag" class="form-control w-100 h-100 border-0 rounded-0" value="{{$forcing_frequency['on_secondary']}}">
                                                                </td>
                                                                <td class="last_active align-middle white-space-nowrap border-md">
                                                                    <input type="text" name="elements" id="elements" class="form-control w-100 h-100 border-0 rounded-0" value="{{$forcing_frequency['elements']}}">
                                                                </td>
                                                                <td class="last_active align-middle white-space-nowrap border-md">
                                                                    <input type="text" name="final-ratio" id="final-ratio" class="form-control w-100 h-100 border-0 rounded-0" value="{{$forcing_frequency['final_ratio']}}">
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

@push('scripts')
    <script>
        $(document).ready(function() {
            // Add click event to each row
            $('tr').click(function() {
                // Hide all icons first
                $('tr').find('.fa-caret-right').addClass('d-none');

                // Show the icon in the clicked row
                $(this).find('.fa-caret-right').removeClass('d-none');

                // Optionally: Add a class to highlight the selected row
                $('tr').removeClass('selected-row');
                $(this).addClass('selected-row');
            });
        });

        function saveMidSetup() {
            let forms = document.querySelectorAll('form');
            forms.forEach((form) => {
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }
            });

            let midNumber = $('#mid-number').val();
            let name = $('#name').val();
            let nominalSpeed = $('#nominal-speed-2').val();
            let nominalSpeedType = $('input[name=flexRadioDefaultSpeed-2]:checked').val();
            let secondarySpeedRatio = $('#secondary-speed-ratio').val();
            let midRating = $('#mid-rating').val();
            let machineOrientation = $('#machine-orientation').val();

            console.log(midNumber, name, nominalSpeed, nominalSpeedType, secondarySpeedRatio, midRating, machineOrientation);
            const components = [];

            document.querySelectorAll("[id^='components-tab']").forEach((tab, index) => {
                if (tab.tagName !== "DIV") {
                    return;
                }
                const component = {};

                component.componentCode = tab.querySelector("#component-code").value.trim();
                component.description = tab.querySelector("#description").value.trim();
                component.pickupCode = tab.querySelector("#pickup-code").value.trim();

                component.bearingMonitored = [];
                tab.querySelectorAll("[id^='bearing-monitored']").forEach((input) => {
                    component.bearingMonitored.push(Number(input.value.trim()));
                });

                components.push(component);
            });

            let forcingFrequencies = [];

            document.querySelectorAll("#setups-table-body tr").forEach((row) => {
                const forcingFrequency = {};
                forcingFrequency.code = row.querySelector("#location-name").value.trim();
                forcingFrequency.name = row.querySelector("#position").value.trim();
                forcingFrequency.on_secondary = row.querySelector("#id-tag").value.trim();
                forcingFrequency.elements = row.querySelector("#elements").value.trim();
                forcingFrequency.final_ratio = row.querySelector("#final-ratio").value.trim();

                forcingFrequencies.push(forcingFrequency);
            });

            $.post('/api/new-mid/save',
                {
                    _token: '{{ csrf_token() }}',
                    general: {
                        midNumber,
                        name,
                        nominalSpeed,
                        nominalSpeedType,
                        secondarySpeedRatio,
                        midRating,
                        machineOrientation
                    },
                    components: components,
                    forcingFrequencies: forcingFrequencies
                }
                , function (response) {
                    if (response.success) {
                        window.location.href = '/mid-setups/';
                    }
                });
        }
    </script>
@endpush
