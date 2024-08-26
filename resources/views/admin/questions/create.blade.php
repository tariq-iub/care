@extends('layouts.care')

@section('content')
    <div class="col-12 col-xxl-auto">
        <div class="card shadow-none border" data-component-card="data-component-card">
            <div class="card-header p-4 border-bottom bg-body">
                <div class="row g-3 justify-content-between align-items-center">
                    <div class="col-12 col-md">
                        <h4 class="text-body mb-0" id="vertical-wizard">
                            Question Creation Setup
                        </h4>
                    </div>
                </div>
            </div>

            <div class="card-body mb-0">
                <div class="row justify-content-between">
                    <div class="col-md-12">
                        <div class="tab-content">
                            <form id="create-question-form" action="{{ route('question.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="company-name" class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="address" class="form-label">Body <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="body" name="body" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="answers" class="fw-bold">Answers:</label>
                                    <div id="answers-container">
                                        <div class="answer-group d-flex align-items-center mb-2">
                                            <input type="text" name="answers[]" class="form-control me-2" placeholder="Answer" required>
                                            <button type="button" class="btn btn-danger remove-answer">Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" id="add-answer" class="btn btn-primary">Add Answer</button>
                                </div>

                                <div class="d-flex list-inline mb-0">
                                    <div class="flex-1 text-end">
                                        <button class="btn btn-primary px-6 px-sm-6" type="submit">
                                            Create
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let answersContainer = document.getElementById('answers-container');
            let addAnswerButton = document.getElementById('add-answer');

            addAnswerButton.addEventListener('click', function () {
                let newAnswerGroup = document.createElement('div');
                newAnswerGroup.className = 'answer-group d-flex align-items-center mb-2';

                newAnswerGroup.innerHTML = `
            <input type="text" name="answers[]" class="form-control me-2" placeholder="Answer" required>
            <button type="button" class="btn btn-danger remove-answer">Remove</button>
        `;

                answersContainer.appendChild(newAnswerGroup);

                // Add event listener to remove button
                newAnswerGroup.querySelector('.remove-answer').addEventListener('click', function () {
                    this.parentElement.remove();
                });
            });

            // Add event listener to existing remove button
            document.querySelectorAll('.remove-answer').forEach(function (button) {
                button.addEventListener('click', function () {
                    this.parentElement.remove();
                });
            });
        });


    </script>
@endpush
