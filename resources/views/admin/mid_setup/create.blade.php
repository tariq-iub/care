@extends('layouts.care')

@section('content')
    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Create MID</h2>

        <p class="text-muted">This setup will allow you to define the components that belongs to machine/MID</p>
    </div>

    <div class="col-12 col-xxl-auto">
        <div class="row">
            <div class="col-12 col-xl-10 order-2 order-xl-1">
            <input type="text" name="mid-name" id="mid-name" class="form-control mb-2" placeholder="Enter MID Name">
                @foreach($questions as $form)
                    @include('admin.mid_setup.partials.question_form', [
                        'question_id' => $form['id'],
                        'title' => $form['title'],
                        'body' => $form['body'],
                        'answers' => $form['answers']
                    ])
                @endforeach

{{--                <div class="card shadow-none border mb-4" data-component-card="data-component-card">--}}
{{--                    <div class="card-header p-4 border-bottom bg-body">--}}
{{--                        <div class="row g-3 justify-content-between align-items-center">--}}
{{--                            <div class="col-12 col-md">--}}
{{--                                <h4 class="text-body mb-0" id="vertical-wizard">--}}
{{--                                    Drive Type of Component--}}
{{--                                </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard" id="component-drive">--}}
{{--                        <div class="row justify-content-between">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">--}}
{{--                                        <form id="wizardVerticalForm1" novalidate="novalidate" data-wizard-form="1">--}}
{{--                                            <div class="row g-3">--}}
{{--                                                <p class="fs-8 fw-bold">--}}
{{--                                                    What Type of component drives this machine?--}}
{{--                                                </p>--}}

{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault1" type="radio" name="flexRadioDefault" checked="">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault1">Motor Driven</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault2" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault2">Turbine Driven(including turbo-chargers)</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault3" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault3">Diesel engine driven</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault4" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault4">The Driver is not monitored</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-12 text-info fs-9">--}}
{{--                                                    Tip: if you will not monitor the driving component, select the last option.--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="card shadow-none border mb-4" data-component-card="data-component-card" id="machine-driven">--}}
{{--                    <div class="card-header p-4 border-bottom bg-body">--}}
{{--                        <div class="row g-3 justify-content-between align-items-center">--}}
{{--                            <div class="col-12 col-md">--}}
{{--                                <h4 class="text-body mb-0" id="vertical-wizard">--}}
{{--                                    Type of Motor Driven Machine--}}
{{--                                </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard">--}}
{{--                        <div class="row justify-content-between">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">--}}
{{--                                        <form id="wizardVerticalForm1" novalidate="novalidate" data-wizard-form="1">--}}
{{--                                            <div class="row g-3">--}}
{{--                                                <p class="fs-8 fw-bold">--}}
{{--                                                    Select between these different types of motor driven machines--}}
{{--                                                </p>--}}

{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault5" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault5">Motor is close-coupled to a pump, fan or compressor</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault6" type="radio" name="flexRadioDefault" checked="">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault6">Default - Motor is flex-coupled to, or otherwise driving, another monitored component</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault7" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault7">Motor driving an integrated oil purifier assembly</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault8" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault8">Motor is the only component being monitored</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-12 text-info fs-9">--}}
{{--                                                    Tip: Special rules apply to certain close-coupled machines and purifiers.--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="card shadow-none border mb-4" data-component-card="data-component-card" id="motor-setup">
                    <div class="card-header p-4 border-bottom bg-body">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-md">
                                <h4 class="text-body mb-0" id="vertical-wizard">
                                    Motor Setup
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard">

                        <div class="row justify-content-between">
                            <div class="col-md-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">
                                        <form id="wizardVerticalForm1" novalidate="novalidate" data-wizard-form="1">
                                            <div class="row g-3">
                                                <p class="fs-8 fw-bold">
                                                    Describe the motor. Please ensure that you check each page and answer as many questions as possible.
                                                </p>
                                                <p class="nav nav-underline fs-9 p-1" id="myTab" role="tablist">
                                                    <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#tab-general" role="tab" aria-controls="tab-home" aria-selected="true">General</a></a>
                                                    <a class="nav-link" id="bearings-tab" data-bs-toggle="tab" href="#tab-bearings" role="tab" aria-controls="tab-bearings" aria-selected="false">Bearings</a></a>
                                                </p>

                                                <div class="tab-pane fade show active collapse" id="tab-general" role="tabpanel" aria-labelledby="general-tab">
                                                    <h5>Bearing Monitored</h5>

                                                    <div class="row">
                                                        <div class="form-text mb-3 row">
                                                            <label class="col-md-6 fs-8 text-md-end align-content-center">Bearing Position numbers</label>
                                                            <div class="col-md-6 d-flex">
                                                                <input type="text" class="form-control form-control-sm me-2" value="1">
                                                                <input type="text" class="form-control form-control-sm" value="0">
                                                            </div>
                                                        </div>

                                                        <h5>Details</h5>
                                                        <form>
                                                            <div class="col-md-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" id="flexRadioDefault9" type="radio" name="flexRadioDefault" checked="">
                                                                    <label class="form-check-label fs-8" for="flexRadioDefault9">AC Motor</label>
                                                                </div>

                                                                <div class="form-check">
                                                                    <input class="form-check-input" id="flexRadioDefault10" type="radio" name="flexRadioDefault">
                                                                    <label class="form-check-label fs-8" for="flexRadioDefault10">DC Motor</label>
                                                                </div>

                                                                <div class="form-check">
                                                                    <input class="form-check-input" id="flexRadioDefault11" type="radio" name="flexRadioDefault">
                                                                    <label class="form-check-label fs-8" for="flexRadioDefault11">VFD Motor</label>
                                                                </div>

                                                                <button class="btn btn-outline-primary mt-3 fs-8" onclick="return false;">Motor Library</button>
                                                            </div>
                                                        </form>
                                                        <div class="col-md-8">
                                                            <div class="row mb-3 align-items-center">
                                                                <label for="cooling-fan" class="col-sm-4 col-form-label text-nowrap">Cooling fan on motors?</label>
                                                                <div class="col-sm-8 col-md-4 m-2 mt-0 mb-0">
                                                                    <input type="text" class="form-control form-control-sm" id="cooling-fan">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3 align-items-center">
                                                                <label for="motor-bars" class="col-sm-4 col-form-label text-nowrap">Number of motor bars:</label>
                                                                <div class="col-sm-8 col-md-4 m-2 mt-0 mb-0">
                                                                    <input type="text" class="form-control form-control-sm" id="motor-bars" value="0">
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3 align-items-center">
                                                                <label for="driver-id" class="col-sm-4 col-form-label text-nowrap">Driver ID:</label>
                                                                <div class="col-sm-8 col-md-4 m-2 mt-0 mb-0">
                                                                    <input type="text" class="form-control form-control-sm" id="driver-id">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane fade collapse" id="tab-bearings" role="tabpanel" aria-labelledby="bearings-tab">
                                                    <h5>Bearing Type</h5>

                                                    <div class="mb-2"></div>
                                                    <form>
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="flexRadioDefault12" type="radio" name="flexRadioDefault" checked="">
                                                            <label class="form-check-label fs-8" for="flexRadioDefault12">Rolling Element Bearings</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="flexRadioDefault13" type="radio" name="flexRadioDefault">
                                                            <label class="form-check-label fs-8" for="flexRadioDefault13">Sleeve Bearings</label>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

{{--                <div class="card shadow-none border mb-4" data-component-card="data-component-card" id="coupled-component">--}}
{{--                    <div class="card-header p-4 border-bottom bg-body">--}}
{{--                        <div class="row g-3 justify-content-between align-items-center">--}}
{{--                            <div class="col-12 col-md">--}}
{{--                                <h4 class="text-body mb-0" id="vertical-wizard">--}}
{{--                                    Coupled Component--}}
{{--                                </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard">--}}
{{--                        <div class="row justify-content-between">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">--}}
{{--                                        <form id="wizardVerticalForm1" novalidate="novalidate" data-wizard-form="1">--}}
{{--                                            <div class="row g-3">--}}
{{--                                                <p class="fs-8 fw-bold">--}}
{{--                                                    How is this component coupled to the next component?--}}
{{--                                                </p>--}}

{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault14" type="radio" name="flexRadioDefault" checked="">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault14">Flexible Coupling</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault15" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault15">No Coupling or Solid Coupling</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault16" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault16">Belt Driven</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault17" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault17">Chain Driven</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault18" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault18">Fluid Coupling</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault19" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault19">Magnetic Coupling</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-12 text-info fs-9">--}}
{{--                                                    Tip: If there are no more components monitored, select no coupling, then No Gearbox, then No Driven.--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="card shadow-none border mb-4" data-component-card="data-component-card" id="gearbox-setup">--}}
{{--                    <div class="card-header p-4 border-bottom bg-body">--}}
{{--                        <div class="row g-3 justify-content-between align-items-center">--}}
{{--                            <div class="col-12 col-md">--}}
{{--                                <h4 class="text-body mb-0" id="vertical-wizard">--}}
{{--                                    Gearbox Setup--}}
{{--                                </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard">--}}
{{--                        <div class="row justify-content-between">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">--}}
{{--                                        <form id="wizardVerticalForm1" novalidate="novalidate" data-wizard-form="1">--}}
{{--                                            <div class="row g-3">--}}
{{--                                                <p class="fs-8 fw-bold">--}}
{{--                                                    If you have a gearbox, choose between these options.--}}
{{--                                                </p>--}}

{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault20" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault20">Single stage gearbox</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault21" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault21">Two stage gearbox</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault22" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault22">Multi stage gearbox<</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault23" type="radio" name="flexRadioDefault" checked="">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault23">There is no gearbox</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-12 text-info fs-9">--}}
{{--                                                    Tip: Multi stage gearboxes are categorized as any gearbox with more than two stages.--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="card shadow-none border mb-4" data-component-card="data-component-card" id="driven-component">--}}
{{--                    <div class="card-header p-4 border-bottom bg-body">--}}
{{--                        <div class="row g-3 justify-content-between align-items-center">--}}
{{--                            <div class="col-12 col-md">--}}
{{--                                <h4 class="text-body mb-0" id="vertical-wizard">--}}
{{--                                    Driven Component--}}
{{--                                </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard">--}}
{{--                        <div class="row justify-content-between">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">--}}
{{--                                        <form id="wizardVerticalForm1" novalidate="novalidate" data-wizard-form="1">--}}
{{--                                            <div class="row g-3">--}}
{{--                                                <p class="fs-8 fw-bold">--}}
{{--                                                    What is being driven by your component?--}}
{{--                                                </p>--}}

{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault24" type="radio" name="flexRadioDefault" checked="">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault24">Pump: centrifugal, piston and others</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault25" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault25">Single or multi-stage fan</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault26" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault26">Compressor: centrifugal, reciprocating, screw and others</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault27" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault27">Electric generator</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault28" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault28">Machine tool spindle/chuck or shaft</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault29" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault29">We are not monitoring a driven component</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-12 text-info fs-9">--}}
{{--                                                    Tip: Select the type of component being driven.--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="card shadow-none border mb-4" data-component-card="data-component-card" id="pump-component">--}}
{{--                    <div class="card-header p-4 border-bottom bg-body">--}}
{{--                        <div class="row g-3 justify-content-between align-items-center">--}}
{{--                            <div class="col-12 col-md">--}}
{{--                                <h4 class="text-body mb-0" id="vertical-wizard">--}}
{{--                                    Pump Type--}}
{{--                                </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard">--}}
{{--                        <div class="row justify-content-between">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">--}}
{{--                                        <form id="wizardVerticalForm1" novalidate="novalidate" data-wizard-form="1">--}}
{{--                                            <div class="row g-3">--}}
{{--                                                <p class="fs-8 fw-bold">--}}
{{--                                                    Select the type of pump--}}
{{--                                                </p>--}}

{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault30" type="radio" name="flexRadioDefault" checked="">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault30">Centrifugal pump</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault31" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault31">Axial flow propeller pump</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault32" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault32">Rotary thread pump</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault33" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault33">Rotary Screw pump</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault34" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault34">Rotary gear pump</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault35" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault35">Rotary sliding vane pump</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="form-check">--}}
{{--                                                    <input class="form-check-input" id="flexRadioDefault36" type="radio" name="flexRadioDefault">--}}
{{--                                                    <label class="form-check-label fs-8" for="flexRadioDefault36">Piston pump</label>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-12 text-info fs-9">--}}
{{--                                                    Tip: If you are not sure which option best describe your pump, select one and look at the question asked.You can always come back and choose another option.--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="card shadow-none border mb-4" data-component-card="data-component-card" id="pump-setup">--}}
{{--                    <div class="card-header p-4 border-bottom bg-body">--}}
{{--                        <div class="row g-3 justify-content-between align-items-center">--}}
{{--                            <div class="col-12 col-md">--}}
{{--                                <h4 class="text-body mb-0" id="vertical-wizard">--}}
{{--                                    Pump Setup--}}
{{--                                </h4>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard">--}}

{{--                        <div class="row justify-content-between">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <div class="tab-content">--}}
{{--                                    <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">--}}
{{--                                        <form id="wizardVerticalForm1" novalidate="novalidate" data-wizard-form="1">--}}
{{--                                            <div class="row g-3">--}}
{{--                                                <p class="fs-8 fw-bold">--}}
{{--                                                    Describe the pump. Please ensure that you check each page and answer as many questions as possible.--}}
{{--                                                </p>--}}
{{--                                                <p class="nav nav-underline fs-9 p-1" id="myTab" role="tablist">--}}
{{--                                                    <a class="nav-link active" id="main-bearings-tab" data-bs-toggle="tab" href="#tab-main-bearings" role="tab" aria-controls="tab-main-bearings" aria-selected="true">General</a>--}}
{{--                                                    <a class="nav-link" id="thrust-bearings-tab" data-bs-toggle="tab" href="#tab-thrust-bearings" role="tab" aria-controls="tab-thrust-bearings" aria-selected="false">Bearings</a>--}}
{{--                                                </p>--}}

{{--                                                <div class="tab-pane fade show active collapse" id="tab-main-bearings" role="tabpanel" aria-labelledby="general-tab">--}}
{{--                                                    <h5>Bearing Monitored</h5>--}}

{{--                                                    <div class="form-text mb-3 row">--}}
{{--                                                        <label class="col-md-6 fs-8 text-md-end align-content-center">Bearing Position numbers</label>--}}
{{--                                                        <div class="col-md-6 d-flex">--}}
{{--                                                            <input type="text" class="form-control form-control-sm me-2" value="1">--}}
{{--                                                            <input type="text" class="form-control form-control-sm" value="0">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <h5>Pump Details</h5>--}}

{{--                                                    <div class="">--}}
{{--                                                        <input type="checkbox" id="overhung-rotor" >--}}
{{--                                                        <label for="overhung-rotor">Overhung rotor</label>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="form-check">--}}
{{--                                                        <div class="row mb-3 align-items-center">--}}
{{--                                                            <div class="col-md-4">--}}
{{--                                                                <label>Number of Vanes</label>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-2">--}}
{{--                                                                <input type="text" class="form-control form-control-sm" value="0">--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-4">--}}
{{--                                                                <label>(1st stage)</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="row mb-3 align-items-center">--}}
{{--                                                            <div class="col-md-4">--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-2">--}}
{{--                                                                <input type="text" class="form-control form-control-sm" value="0">--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-md-4">--}}
{{--                                                                <label>(2nd stage)</label>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                </div>--}}
{{--                                                <div class="tab-pane fade collapse" id="tab-thrust-bearings" role="tabpanel" aria-labelledby="bearings-tab">--}}
{{--                                                    <h5>Bearing Type</h5>--}}

{{--                                                    <div class="mb-4"></div>--}}

{{--                                                    <form>--}}
{{--                                                        <div class="form-check">--}}
{{--                                                            <input class="form-check-input" id="flexRadioDefault37" type="radio" name="flexRadioDefault" checked="">--}}
{{--                                                            <label class="form-check-label fs-8" for="flexRadioDefault37">Rolling Element Bearings</label>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-check">--}}
{{--                                                            <input class="form-check-input" id="flexRadioDefault38" type="radio" name="flexRadioDefault">--}}
{{--                                                            <label class="form-check-label fs-8" for="flexRadioDefault38">Sleeve Bearings</label>--}}
{{--                                                        </div>--}}
{{--                                                    </form>--}}
{{--                                                    <h5>Thrust Bearing Type</h5>--}}

{{--                                                    <div class="mb-4"></div>--}}
{{--                                                    <form>--}}
{{--                                                        <div class="form-check">--}}
{{--                                                            <input class="form-check-input" id="flexRadioDefault39" type="radio" name="flexRadioDefault" checked="">--}}
{{--                                                            <label class="form-check-label fs-8" for="flexRadioDefault39">Rolling Element</label>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-check">--}}
{{--                                                            <input class="form-check-input" id="flexRadioDefault40" type="radio" name="flexRadioDefault">--}}
{{--                                                            <label class="form-check-label fs-8" for="flexRadioDefault40">Sleeve Thrust</label>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="form-check">--}}
{{--                                                            <input class="form-check-input" id="flexRadioDefault41" type="radio" name="flexRadioDefault">--}}
{{--                                                            <label class="form-check-label fs-8" for="flexRadioDefault41">No Thrust Bearings</label>--}}
{{--                                                        </div>--}}
{{--                                                    </form>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="card shadow-none border" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom bg-body">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-md">
                                <h4 class="text-body mb-0" id="vertical-wizard">
                                    Setup Completed
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard">
                        <div class="row justify-content-between">
                            <div class="col-md-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">
                                        <div class="row g-3">
                                            <h4>Congratulations!</h4>
                                            <p>
                                                That's all there is to it.Press Finish to save this MID.
                                            </p>

                                            <p class="col-md-12 text-info fs-9 mt-8">
                                                Tip: Press the Finish button to return to the MID from where it can be saved.
                                            </p>

                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-secondary" onclick="return false;">Cancel</button>
                                                <button class="btn btn-primary" onclick="saveMidSetup()">Save Setup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-2 order-1 order-xl-2 mb-4 mb-xl-0">
                <div class="sticky-top mt-xl-4" style="top:80px;">
                    <h5 class="lh-1">On this page</h5>
                    <hr>
                    <ul class="nav nav-vertical flex-column doc-nav" data-doc-nav="data-doc-nav">
                        @foreach($questions as $question)
                            <li class="nav-item"><a class="nav-link" href="#{{ Str::slug($question['title']) }}">{{ $question['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection()

@push('scripts')

    <script>
        function saveMidSetup() {
            const midName = document.getElementById('mid-name').value;
            const forms = document.querySelectorAll('form');

            let allData = [];

            forms.forEach(form => {
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                allData.push(data);
            });

            allData.push({midName: midName});

            $.post('/api/mid-setup/save',
                Object.assign({}, ...allData)
                , function (response) {
                console.log(response);
            });
        }

    </script>
@endpush
