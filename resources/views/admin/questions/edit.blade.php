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
                            <input type="text" class="form-control" id="edit-title" name="edit-title" required>
                        </div>
                        <div class="col-md-12">
                            <label for="edit-body" class="form-label">Body <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit-body" name="edit-body" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="answers">Answers:</label>
                        <div id="edit-answers-container">
                            <div class="edit-answer-group d-flex align-items-center mb-2">
                                <input type="text" name="answers[]" class="form-control me-2" placeholder="Answer" required>
                                <button type="button" class="btn btn-danger remove-answer">Remove</button>
                            </div>
                        </div>
                        <button type="button" id="add-answer" class="btn btn-primary">Add Answer</button>
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