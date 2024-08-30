<div class="modal fade" id="show-questions" tabindex="-1" aria-labelledby="scrollingLongModalLabel2" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Modal title</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="show-title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="show-title" name="show-title" readonly>
                    </div>
                    <div class="col-md-12">
                        <label for="show-body" class="form-label">Body <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="show-body" name="show-body" readonly>
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <label for="sort_order" class="form-label">Sort Order <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="show-sort_order" name="show-sort_order" required value="0">
                </div>

                <div class="col-md-12 mb-2">
                    <label for="sort_order" class="form-label">Group</label>
                    <input type="text" class="form-control" id="show-group" name="show-group" required value="general">
                </div>

                <div class="form-group mb-2" id="general-group">
                    <label class="fw-bold" id="general-group-label">Answers:</label>
                    <div id="general-answers-container">
                        <div class="answer-group d-flex align-items-center mb-2">

                        </div>
                    </div>
                </div>

                <div class="form-group mb-2" id="custom-group" style="display: none">
                    <label class="fw-bold"><span id="custom-group-label">Custom Group</span> Answers:</label>
                    <div id="custom-answers-container">

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Okay</button>
                    <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
