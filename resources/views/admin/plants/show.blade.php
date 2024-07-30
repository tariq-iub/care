@extends('layouts.care')

@section('content')
    <div class="col-12 col-xxl-8">
        <div class="card shadow-none border" data-component-card="data-component-card">
            <div class="card-header p-4 border-bottom bg-body">
                <div class="row g-3 justify-content-between align-items-center">
                    <div class="col-12 col-md">
                        <h4 class="text-body mb-0" id="vertical-wizard">
                            Plant Creation Setup
                        </h4>
                    </div>
                </div>
            </div>

            <div class="card theme-wizard mb-5" data-theme-wizard="data-theme-wizard">
                <div class="card-body pt-4 pb-0">
                    <div class="row justify-content-between">
                        <div class="col-md-3 order-md-1">
                            <div class="scrollbar mb-4">
                                <ul class="nav justify-content-between flex-nowrap nav-wizard nav-wizard-vertical-md" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active py-0 py-md-3" href="#bootstrap-vertical-wizard-tab1" data-bs-toggle="tab" data-wizard-step="1" aria-selected="true" role="tab">
                                            <div class="text-center d-inline-block d-md-flex align-items-center gap-3">
                                                <span class="nav-item-circle-parent">
                                                    <span class="nav-item-circle">
                                                        <svg class="svg-inline--fa fa-file nav-item-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z"></path>
                                                        </svg>
                                                        <!-- <span class="fa-solid fa-file nav-item-icon"></span> Font Awesome fontawesome.com -->
                                                        <svg class="svg-inline--fa fa-check check-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path>
                                                        </svg>
                                                        <!-- <span class="fa-solid fa-check check-icon"></span> Font Awesome fontawesome.com -->
                                                    </span>
                                                </span>
                                                <span class="nav-item-title fs-9 fs-xl-8">
                                                    Company Information
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-0 py-md-3" href="#bootstrap-vertical-wizard-tab2" data-bs-toggle="tab" data-wizard-step="2" aria-selected="false" tabindex="-1" role="tab">
                                            <div class="text-center d-inline-block d-md-flex align-items-center gap-3">
                                                <span class="nav-item-circle-parent">
                                                    <span class="nav-item-circle">
                                                        <svg class="svg-inline--fa fa-location-dot nav-item-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-dot" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"></path>
                                                        </svg>
                                                        <!-- <span class="fa-solid fa-location-dot nav-item-icon"></span> Font Awesome fontawesome.com -->
                                                        <svg class="svg-inline--fa fa-check check-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path>
                                                        </svg>
                                                        <!-- <span class="fa-solid fa-check check-icon"></span> Font Awesome fontawesome.com -->
                                                    </span>
                                                </span>
                                                <span class="nav-item-title fs-9 fs-xl-8">
                                                    Plant Information
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-0 py-md-3" href="#bootstrap-vertical-wizard-tab3" data-bs-toggle="tab" data-wizard-step="3" aria-selected="false" tabindex="-1" role="tab">
                                            <div class="text-center d-inline-block d-md-flex align-items-center gap-3">
                                                <span class="nav-item-circle-parent">
                                                    <span class="nav-item-circle">
                                                        <svg class="svg-inline--fa fa-location-dot nav-item-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="location-dot" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"></path>
                                                        </svg>
                                                        <!-- <span class="fa-solid fa-location-dot nav-item-icon"></span> Font Awesome fontawesome.com -->
                                                        <svg class="svg-inline--fa fa-check check-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path>
                                                        </svg>
                                                        <!-- <span class="fa-solid fa-check check-icon"></span> Font Awesome fontawesome.com -->
                                                    </span>
                                                </span>
                                                <span class="nav-item-title fs-9 fs-xl-8">
                                                    Notes & Pictures
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-0 py-md-3" href="#bootstrap-vertical-wizard-tab4" data-bs-toggle="tab" data-wizard-step="4" aria-selected="false" tabindex="-1" role="tab">
                                            <div class="text-center d-inline-block d-md-flex align-items-center gap-3">
                                                <span class="nav-item-circle-parent">
                                                    <span class="nav-item-circle">
                                                        <svg class="svg-inline--fa fa-mug-saucer nav-item-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="mug-saucer" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M96 64c0-17.7 14.3-32 32-32H448h64c70.7 0 128 57.3 128 128s-57.3 128-128 128H480c0 53-43 96-96 96H192c-53 0-96-43-96-96V64zM480 224h32c35.3 0 64-28.7 64-64s-28.7-64-64-64H480V224zM32 416H544c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32z"></path></svg>
                                                        <!-- <span class="fa-solid fa-mug-saucer nav-item-icon"></span> Font Awesome fontawesome.com -->
                                                        <svg class="svg-inline--fa fa-check check-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path>
                                                        </svg>
                                                        <!-- <span class="fa-solid fa-check check-icon"></span> Font Awesome fontawesome.com -->
                                                    </span>
                                                </span>
                                                <span class="nav-item-title fs-9 fs-xl-8">
                                                    Service Representative
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link py-0 py-md-3" href="#bootstrap-vertical-wizard-tab5" data-bs-toggle="tab" data-wizard-step="5" aria-selected="false" tabindex="-1" role="tab">
                                            <div class="text-center d-inline-block d-md-flex align-items-center gap-3">
                                                <span class="nav-item-circle-parent">
                                                    <span class="nav-item-circle">
                                                        <svg class="svg-inline--fa fa-images nav-item-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="images" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M160 32c-35.3 0-64 28.7-64 64V320c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H160zM396 138.7l96 144c4.9 7.4 5.4 16.8 1.2 24.6S480.9 320 472 320H328 280 200c-9.2 0-17.6-5.3-21.6-13.6s-2.9-18.2 2.9-25.4l64-80c4.6-5.7 11.4-9 18.7-9s14.2 3.3 18.7 9l17.3 21.6 56-84C360.5 132 368 128 376 128s15.5 4 20 10.7zM192 128a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zM48 120c0-13.3-10.7-24-24-24S0 106.7 0 120V344c0 75.1 60.9 136 136 136H456c13.3 0 24-10.7 24-24s-10.7-24-24-24H136c-48.6 0-88-39.4-88-88V120z"></path>
                                                        </svg>
                                                        <!-- <span class="fa-solid fa-images nav-item-icon"></span> Font Awesome fontawesome.com -->
                                                        <svg class="svg-inline--fa fa-check check-icon" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="check" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                                            <path fill="currentColor" d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"></path>
                                                        </svg>
                                                        <!-- <span class="fa-solid fa-check check-icon"></span> Font Awesome fontawesome.com -->
                                                    </span>
                                                </span>
                                                <span class="nav-item-title fs-9 fs-xl-8">
                                                    Done
                                                </span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">
                                    <form id="wizardVerticalForm1" novalidate="novalidate" data-wizard-form="1">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="company-name" class="form-label">Company Name</label>
                                                <input type="text" class="form-control" id="company-name" name="company_name" readonly value={{$company->company_name}}>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address" name="address" readonly value={{$company->address}}>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control" id="city" name="city" readonly value={{$company->city}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="state" class="form-label">State/Province</label>
                                                <input type="text" class="form-control" id="state" name="state" readonly value={{$company->state}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="zip" class="form-label">Zip/Post Code</label>
                                                <input type="text" class="form-control" id="zip" name="zip" readonly value={{$company->zip}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="country" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="country" name="country" readonly value={{$company->country}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="contact-name" class="form-label">Contact Name</label>
                                                <input type="text" class="form-control" id="contact-name" name="contact_name" readonly value={{$company->contact_name}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="contact-title" class="form-label">Contact Title</label>
                                                <input type="text" class="form-control" id="contact-title" name="contact_title" readonly value={{$company->contact_title}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="phone-number" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" id="phone-number" name="phone_number" readonly value={{$company->phone_number}}>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="alt-phone-number" class="form-label">Alt Phone Number</label>
                                                <input type="text" class="form-control" id="alt-phone-number" name="alt_phone_number" readonly value={{$company->alt_phone_number}}>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="fax-number" class="form-label">Fax Number</label>
                                                <input type="text" class="form-control" id="fax-number" name="fax_number" readonly value={{$company->fax}}>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="email-address" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="email-address" name="email" readonly value={{$company->email}}>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab2" id="bootstrap-vertical-wizard-tab2">
                                    <form id="wizardVerticalForm2" novalidate="novalidate" data-wizard-form="2" enctype="multipart/form-data">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="plant-name" class="form-label">Plant Name</label>
                                                <input type="text" class="form-control" id="plant-name" name="plant_name" readonly value={{$plant->title}}>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="plant-status" class="form-label">Plant Status</label>
                                                <select class="form-select" id="plant-status" name="plant_status" required disabled>
                                                    <option value="1" {{ $plant->status == 1 ? 'selected' : '' }}>Active</option>
                                                    <option value="0" {{ $plant->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab3" id="bootstrap-vertical-wizard-tab3">
                                    <form id="wizardVerticalForm3" novalidate="novalidate" data-wizard-form="3" enctype="multipart/form-data">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="notes" class="form-label">Notes</label>
                                                <textarea class="form-control" id="notes" name="notes" rows="4" readonly>{{$note->note}}</textarea>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="pictures" class="form-label">Pictures</label>
                                                <input type="file" class="form-control" id="pictures" name="pictures[]" readonly multiple>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab4" id="bootstrap-vertical-wizard-tab4">
                                    <form id="wizardVerticalForm4" novalidate="novalidate" data-wizard-form="4">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="service-rep-name" class="form-label">Service Rep Name</label>
                                                <input type="text" class="form-control" id="service-rep-name" name="service_rep_name" readonly value={{$serviceRepresentative->service_rep_name}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="service-rep-address" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="service-rep-address" name="address" readonly value={{$serviceRepresentative->address}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="service-rep-city" class="form-label">City</label>
                                                <input type="text" class="form-control" id="service-rep-city" name="city" readonly value={{$serviceRepresentative->city}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="service-rep-state" class="form-label">State/Province</label>
                                                <input type="text" class="form-control" id="service-rep-state" name="state" readonly value={{$serviceRepresentative->state}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="service-rep-zip" class="form-label">Zip/Post Code</label>
                                                <input type="text" class="form-control" id="service-rep-zip" name="zip" readonly value={{$serviceRepresentative->zip}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="service-rep-country" class="form-label">Country</label>
                                                <input type="text" class="form-control" id="service-rep-country" name="country" readonly value={{$serviceRepresentative->country}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="service-rep-contact-name" class="form-label">Contact Name</label>
                                                <input type="text" class="form-control" id="service-rep-contact-name" name="contact_name" readonly value={{$serviceRepresentative->contact_name}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="service-rep-contact-title" class="form-label">Contact Title</label>
                                                <input type="text" class="form-control" id="service-rep-contact-title" name="contact_title" readonly value={{$serviceRepresentative->contact_title}} >
                                            </div>
                                            <div class="col-md-12">
                                                <label for="service-rep-phone-number" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" id="service-rep-phone-number" name="phone_number" readonly value={{$serviceRepresentative->phone_number}}>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="service-rep-alt-phone-number" class="form-label">Alt Phone Number</label>
                                                <input type="text" class="form-control" id="service-rep-alt-phone-number" name="alt_phone_number" readonly value={{$serviceRepresentative->alt_phone_number}}>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="service-rep-fax-number" class="form-label">Fax Number</label>
                                                <input type="text" class="form-control" id="service-rep-fax-number" name="fax_number" readonly value={{$serviceRepresentative->fax}}>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="service-rep-email-address" class="form-label">Email Address</label>
                                                <input type="email" class="form-control" id="service-rep-email-address" name="email" readonly value={{$serviceRepresentative->email}} >
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab5" id="bootstrap-vertical-wizard-tab5">
                                    <div class="row flex-center pb-8 pt-4 gx-3 gy-4">
                                        <div class="col-12 col-sm-auto">
                                            <div class="text-center text-sm-start">
                                                <img class="d-dark-none" src="../../assets/img/spot-illustrations/38.webp" alt="" width="220">
                                                <img class="d-light-none" src="../../assets/img/spot-illustrations/dark_38.webp" alt="" width="220">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-auto">
                                            <div class="text-center text-sm-start">
                                                <h5 class="mb-3">You are all set!</h5>
                                                <p class="text-body-emphasis fs-9">
                                                    Now you can access your account<br>anytime anywhere
                                                </p>
                                                <a class="btn btn-primary px-6" href="../../modules/forms/wizard.html">
                                                    Start Over
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer border-top-0" data-wizard-footer="data-wizard-footer">
                    <div class="d-flex pager wizard list-inline mb-0">
                        <button class="d-none btn btn-link ps-0" type="button" data-wizard-prev-btn="data-wizard-prev-btn">
                            <svg class="svg-inline--fa fa-chevron-left me-1" data-fa-transform="shrink-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="" style="transform-origin: 0.3125em 0.5em;">
                                <g transform="translate(160 256)">
                                    <g transform="translate(0, 0)  scale(0.8125, 0.8125)  rotate(0 0 0)">
                                        <path fill="currentColor" d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" transform="translate(-160 -256)"></path>
                                    </g>
                                </g>
                            </svg>
                            <!-- <span class="fas fa-chevron-left me-1" data-fa-transform="shrink-3"></span> Font Awesome fontawesome.com -->
                            Previous
                        </button>
                        <div class="flex-1 text-end">
                            <button class="btn btn-primary px-6 px-sm-6" type="submit" data-wizard-next-btn="data-wizard-next-btn">
                                Next
                                <svg class="svg-inline--fa fa-chevron-right ms-1" data-fa-transform="shrink-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="" style="transform-origin: 0.3125em 0.5em;">
                                    <g transform="translate(160 256)">
                                        <g transform="translate(0, 0)  scale(0.8125, 0.8125)  rotate(0 0 0)">
                                            <path fill="currentColor" d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" transform="translate(-160 -256)"></path>
                                        </g>
                                    </g>
                                </svg>
                                <!-- <span class="fas fa-chevron-right ms-1" data-fa-transform="shrink-3"> </span> Font Awesome fontawesome.com -->
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@push('scripts')
    <script></script>
@endpush
