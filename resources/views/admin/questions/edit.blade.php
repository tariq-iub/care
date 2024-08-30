<div class="modal fade" id="edit-questions" tabindex="-1" aria-labelledby="scrollingLongModalLabel2" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Modal title</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-question-form" method="post" action="">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="edit-title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit-body" class="form-label">Body <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="body" name="body" required>
                        </div>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="sort_order" class="form-label">Sort Order <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" required value="0">
                    </div>

                    <div class="col-md-12 mb-2">
                        <label for="sort_order" class="form-label">Group</label>
                        <input type="text" class="form-control" id="group" name="group" required value="general">
                    </div>

                    <div class="form-group mb-2" id="general-group">
                        <label class="fw-bold" id="general-group-label">Answers:</label>
                        <div id="edit-general-answers-container">

                        </div>
                    </div>

                    <div class="form-group mb-2" id="custom-group" style="display: none">
                        <label class="fw-bold"><span id="custom-group-label">Custom Group</span> Answers:</label>
                        <div id="edit-custom-answers-container">

                        </div>
                    </div>

                </form>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="save-button">Save</button>
                    <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
