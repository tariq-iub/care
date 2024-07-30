<div class="modal fade" id="show-data-collection-setup" tabindex="-1" aria-labelledby="scrollingLongModalLabel2" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Modal title</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">
                    <form id="wizardVerticalForm1" novalidate="novalidate" data-wizard-form="1">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="plant-name" class="form-label">Plant Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="plant-name" name="plant_name" readonly value={{$plant->title}}>
                            </div>
                            <div class="col-md-12">
                                <label for="plant-status" class="form-label">Plant Status<span class="text-danger">*</span></label>
                                <select class="form-select" id="plant-status" name="plant_status" disabled>
                                    <option value="1" {{$plant->plant_status == '1' ? 'selected' : ''}}>Active</option>
                                    <option value="0" {{$plant->plant_status == '0' ? 'selected' : ''}}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab2" id="bootstrap-vertical-wizard-tab2">
                    <form id="wizardVerticalForm2" novalidate="novalidate" data-wizard-form="2" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="notes" class="form-label">Notes<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="notes" name="notes" rows="4" readonly>{{$note->note}}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="pictures" class="form-label">Pictures</label>
                                <input type="file" class="form-control" id="pictures" name="pictures[]" multiple>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab3" id="bootstrap-vertical-wizard-tab3">
                    <form id="wizardVerticalForm3" novalidate="novalidate" data-wizard-form="3" enctype="multipart/form-data">
                        <select class="form-select" id="service-rep" name="service_rep" required>
                            <option value="">Select Service Representative</option>
                            @foreach($serviceReps as $serviceRep)
                                <option value="{{ $serviceRep->id }}">{{ $serviceRep->service_rep_name }}</option>
                            @endforeach
                        </select>


                        <div class="row g-3 d-none" id="service-rep-info">
                            <div class="col-md-12">
                                <label for="service-rep-name" class="form-label">Service Rep Name</label>
                                <input type="text" class="form-control" id="service-rep-name" name="service_rep_name" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="service-rep-address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="service-rep-address" name="address" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="service-rep-city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="service-rep-city" name="city" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="service-rep-state" class="form-label">State/Province</label>
                                    <input type="text" class="form-control" id="service-rep-state" name="state" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="service-rep-zip" class="form-label">Zip/Post Code</label>
                                    <input type="text" class="form-control" id="service-rep-zip" name="zip" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="service-rep-country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="service-rep-country" name="country" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="service-rep-contact-name" class="form-label">Contact Name</label>
                                <input type="text" class="form-control" id="service-rep-contact-name" name="contact_name" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="service-rep-contact-title" class="form-label">Contact Title</label>
                                <input type="text" class="form-control" id="service-rep-contact-title" name="contact_title" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="service-rep-phone-number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="service-rep-phone-number" name="phone_number" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="service-rep-alt-phone-number" class="form-label">Alt Phone Number</label>
                                    <input type="text" class="form-control" id="service-rep-alt-phone-number" name="alt_phone_number" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="service-rep-fax-number" class="form-label">Fax Number</label>
                                    <input type="text" class="form-control" id="service-rep-fax-number" name="fax_number" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="service-rep-email-address" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="service-rep-email-address" name="email" readonly>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            <div class="modal-footer">
                <button class="btn btn-primary" type="button">Okay</button>
                <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#service-rep').on('change', function() {

            if ($(this).val() == '') {
                $('#service-rep-info').addClass('d-none');
                return;
            }

            const serviceRepId = $(this).val();
            $.get(`/api/plant-setup/fetch-service-representative/${serviceRepId}`, function(response) {

                $('#service-rep-info').removeClass('d-none');

                $('#service-rep-name').val(response.serviceRep.service_rep_name);
                $('#service-rep-address').val(response.serviceRep.address);
                $('#service-rep-city').val(response.serviceRep.city);
                $('#service-rep-state').val(response.serviceRep.state);
                $('#service-rep-zip').val(response.serviceRep.zip);
                $('#service-rep-country').val(response.serviceRep.country);
                $('#service-rep-contact-name').val(response.serviceRep.contact_name);
                $('#service-rep-contact-title').val(response.serviceRep.contact_title);
                $('#service-rep-phone-number').val(response.serviceRep.phone_number);
                $('#service-rep-alt-phone-number').val(response.serviceRep.alt_phone_number);
                $('#service-rep-fax-number').val(response.serviceRep.fax_number);
                $('#service-rep-email-address').val(response.serviceRep.email);
            });
        });
    });
</script>
