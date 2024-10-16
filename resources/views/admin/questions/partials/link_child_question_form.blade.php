<div class="modal fade" id="link-child-question" tabindex="-1" aria-labelledby="scrollingLongModalLabel2" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollingLongModalLabel2">Modal title</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/api/questions/link-child-question" method="POST">
                    @csrf
                    <input type="hidden" name="parent_question_id" value="">

                    <div class="d-flex flex-wrap mb-2 mt-2">
                        <h5 class="mb-0 text-body-highlight me-2">Select Answer</h5>
                    </div>
                    <select class="form-select" name="parent_answer_id">
                        <option value="">None</option>

                    </select>

                    <div class="d-flex flex-wrap mb-2 mt-2">
                        <h5 class="mb-0 text-body-highlight me-2">Select Child Question</h5>
                    </div>

                    <select class="form-select" name="child_question_id">
                        <option value="">None</option>

                    </select>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" id="linkChildQuestion">Okay</button>
                <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
