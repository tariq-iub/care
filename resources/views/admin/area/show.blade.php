<div class="modal fade" id="show-area" tabindex="-1" aria-labelledby="scrollingLongModalLabel2" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">View Area</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">
                    <form id="wizardVerticalForm3" novalidate="novalidate" data-wizard-form="1" class="pe-none">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="area-name" class="form-label">Area Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="show-area-name" name="area_name" readonly>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="show-plant-id" name="plant-id">
                                <label for="plant-name" class="form-label">Plant Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="show-plant-name" name="plant-name" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Line Frequency <span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="flexRadioDefault1-show" type="radio" name="flexRadioDefault" value="50 Hz" checked="">
                                    <label class="form-check-label" for="flexRadioDefault1">50 Hz</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="flexRadioDefault2-show" type="radio" name="flexRadioDefault" value="60 Hz">
                                    <label class="form-check-label" for="flexRadioDefault2">60 Hz</label>
                                </div>
                                <div class="overlay position-absolute top-0 left-0 w-100 h-100 pe-none bg-transparent"></div>
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
</div>
