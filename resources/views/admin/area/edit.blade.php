<div class="modal fade" id="edit-area" tabindex="-1" aria-labelledby="scrollingLongModalLabel2" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Edit Area</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">
                    <form id="wizardVerticalForm2" novalidate="novalidate" data-wizard-form="1">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="edit-area-id" name="area-id">
                                <label for="area-name" class="form-label">Area Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit-area-name" name="area_name" required>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="edit-plant-id" name="plant-id">
                                <label for="plant-name" class="form-label">Plant Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="edit-plant-name" name="plant-name" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Line Frequency <span class="text-danger">*</span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="flexRadioDefault1-edit" type="radio" name="flexRadioDefault" value="50 Hz" checked="">
                                    <label class="form-check-label" for="flexRadioDefault1-edit">50 Hz</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="flexRadioDefault2-edit" type="radio" name="flexRadioDefault" value="60 Hz">
                                    <label class="form-check-label" for="flexRadioDefault2-edit">60 Hz</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="update-area-button">Update</button>
                    <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
