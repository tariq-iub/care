@extends('layouts.care')

@section('content')
    <form id="create-question-form" action="{{ route('question.store') }}" method="POST">
        @csrf
        <div class="row g-3 flex-between-end mb-5">
            <div class="col-auto">
                <h2 class="mb-2">Create Question</h2>
                <h5 class="text-body-tertiary fw-semibold">
                    Add a new question item for MID.
                </h5>
            </div>
            <div class="col-auto">
                <a href="{{ route('question.index') }}" class="btn btn-phoenix-secondary me-2 mb-2 mb-sm-0">Discard</a>
                <button class="btn btn-primary mb-2 mb-sm-0" type="submit">Add Question</button>
            </div>
        </div>
        <div class="row g-5">
            <div class="col-12 col-xl-8" id="question-form">

                <div class="mb-5">
                    <h5>Title <span class="text-danger">*</span></h5>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-5">
                    <h5>Body <span class="text-danger">*</span></h5>
                    <input type="text" class="form-control" id="body" name="body" required>
                </div>

                <div class="mb-5">
                    <h5>Sort Order <span class="text-danger">*</span></h5>
                    <input type="number" class="form-control" id="sort_order" name="sort_order" required value="0">
                </div>

                <div class="form-group mb-5" id="groups-name">
                    <h5>Groups:</h5>
                    <div id="groups-container">
                        <div class="group-name d-flex align-items-center mb-2">
                            <input type="text" name="groups[]" id="group-name" class="form-control me-2" placeholder="Group" value="general" required>
                            <button type="button" class="btn btn-danger remove-group">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary add-group">Add Group</button>
                </div>

                <div class="form-group mb-5" id="general-group">
                    <h5>General Answers:</h5>
                    <div id="general-container">
                        <div class="answer-group d-flex align-items-center mb-2">
                            <input type="text" name="answers[general][]" class="form-control me-2" placeholder="Answer" required>
                            <select name="answer_type[general][]" class="form-select me-2" required>
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="radio">Radio</option>
                            </select>
                            <button type="button" class="btn btn-danger remove-answer">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary add-answer" data-group="general">Add Answer</button>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class="row g-2">
                    <div class="col-12 col-xl-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Parent Question</h4>
                                <div class="row gx-3">
                                    <div class="col-12 col-sm-6 col-xl-12">
                                        <div class="d-flex flex-wrap mb-2">
                                            <h5 class="mb-0 text-body-highlight me-2">Select Parent Question & Answer</h5>
                                        </div>
                                        <select class="form-select" name="parent_question_id" id="organizerSingle" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}'>
                                            <option value="">None</option>
                                            @foreach($midQuestions as $question)
                                                <option value="{{ $question->id }}">{{ $question->title }}</option>
                                            @endforeach
                                        </select>

                                        <div class="d-flex flex-wrap mb-2">
                                        </div>

                                        <select class="form-select" name="parent_answer_id">
                                            <option value="">None</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection()

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('select[name="parent_question_id"]').addEventListener('change', function () {
                let selectedQuestionId = this.value;
                let parentAnswerSelect = document.querySelector('select[name="parent_answer_id"]');
                let parentAnswers = @json($midAnswers);
                let parentQuestions = @json($parentQuestions);

                parentAnswerSelect.innerHTML = '<option value="">None</option>';

                for (let i = 0; i < parentQuestions.length; i++) {
                    if (parentQuestions[i].mid_question_id == selectedQuestionId) {
                        let answer = parentAnswers.find(answer => answer.id === parentQuestions[i].mid_answer_id);
                        parentAnswerSelect.innerHTML += `<option value="${answer.id}">${answer.body}</option>`;
                    }
                }
            });

            document.querySelector('.add-group').addEventListener('click', function () {
                let groupsContainer = document.getElementById('groups-container');
                let newGroup = document.createElement('div');
                newGroup.className = 'group-name d-flex align-items-center mb-2';
                newGroup.innerHTML = `
                    <input type="text" name="groups[]" class="form-control me-2" placeholder="Group" required>
                    <button type="button" class="btn btn-danger remove-group">Remove</button>
                `;
                groupsContainer.appendChild(newGroup);

                let groupInput = newGroup.querySelector('input[name="groups[]"]');
                groupInput.addEventListener('input', function () {
                    if (this.value.trim() !== '') {
                        addAnswerContainer(this.value);
                    }
                });

                newGroup.querySelector('.remove-group').addEventListener('click', function () {
                    this.parentElement.remove();
                });
            });

            let groupName = document.getElementById('group-name');
            groupName.addEventListener('input', function () {
                if (this.value.trim() !== '') {
                    addAnswerContainer(this.value);
                }
            });

            document.querySelectorAll('.remove-group').forEach(function (button) {
                button.addEventListener('click', function () {
                    this.parentElement.remove();
                    document.getElementById('general-group').remove();
                });
            });

            function addAnswerContainer(groupName) {
                if (document.getElementById(`${groupName.slice(0, -1)}-group`) !== null) {
                    document.getElementById(`${groupName.slice(0, -1)}-group`).remove();
                }
                let answersContainer = document.createElement('div');
                answersContainer.className = 'form-group mb-5';
                answersContainer.setAttribute('id', `${groupName}-group`);

                answersContainer.innerHTML = `
                    <h5>${groupName} Answers:</h5>
                    <div id="${groupName}-container">
                        <div class="answer-group d-flex align-items-center mb-2">
                            <input type="text" name="answers[${groupName}][]" class="form-control me-2" placeholder="Answer" required>
                            <select name="answer_type[${groupName}][]" class="form-select me-2" required>
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="radio">Radio</option>
                            </select>
                            <button type="button" class="btn btn-danger remove-answer">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary add-answer" data-group="${groupName}">Add Answer</button>
                `;
                document.getElementById('question-form').appendChild(answersContainer);

                answersContainer.querySelector('.add-answer').addEventListener('click', function () {
                    let group = this.getAttribute('data-group');
                    let answersContainer = document.getElementById(`${group}-container`);
                    let newAnswerGroup = document.createElement('div');
                    newAnswerGroup.className = 'answer-group d-flex align-items-center mb-2';
                    newAnswerGroup.innerHTML = `
                        <input type="text" name="answers[${group}][]" class="form-control me-2" placeholder="Answer" required>
                        <select name="answer_type[${group}][]" class="form-select me-2" required>
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio</option>
                        </select>
                        <button type="button" class="btn btn-danger remove-answer">Remove</button>
                    `;
                    answersContainer.appendChild(newAnswerGroup);

                    // Attach remove button functionality for new answers
                    newAnswerGroup.querySelector('.remove-answer').addEventListener('click', function () {
                        this.parentElement.remove();
                    });
                });
            }

            document.querySelector('.add-answer').addEventListener('click', function () {
                let group = this.getAttribute('data-group');
                let answersContainer = document.getElementById(`${group}-container`);
                let newAnswerGroup = document.createElement('div');
                newAnswerGroup.className = 'answer-group d-flex align-items-center mb-2';
                newAnswerGroup.innerHTML = `
                    <input type="text" name="answers[${group}][]" class="form-control me-2" placeholder="Answer" required>
                    <select name="answer_type[${group}][]" class="form-select me-2" required>
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="radio">Radio</option>
                    </select>
                    <button type="button" class="btn btn-danger remove-answer">Remove</button>
                `;
                answersContainer.appendChild(newAnswerGroup);

                // Attach remove button functionality for new answers
                newAnswerGroup.querySelector('.remove-answer').addEventListener('click', function () {
                    this.parentElement.remove();
                });
            });

            document.querySelector('.remove-answer').addEventListener('click', function () {
                this.parentElement.remove();
            });
        });
    </script>
@endpush
