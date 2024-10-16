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
            <div class="col-12" id="question-form">
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
                        <div class="answer-group d-flex align-items-center mb-2" data-index="0">
                            <input type="text" name="answers[general][0][body]" class="form-control me-2" placeholder="Answer" required>
                            <input type="number" name="answers[general][0][input_count]" class="form-control me-2" placeholder="Number of inputs to show" required value="1">
                            <select name="answers[general][0][type]" class="form-select me-2 w-auto" required onchange="handleSelectChange(this)">
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
        </div>
    </form>
@endsection()

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
                let groupNameOldVal = null;
                groupInput.addEventListener('beforeinput', (event) => {
                    groupNameOldVal = event.target.value;
                });
                groupInput.addEventListener('input', function () {
                    if (this.value.trim() !== '') {
                        addAnswerContainer(groupNameOldVal , this.value);
                    }
                });

                newGroup.querySelector('.remove-group').addEventListener('click', function () {
                    this.parentElement.remove();
                });
            });

            let groupName = document.getElementById('group-name');
            let groupNameOldVal = null;
            groupName.addEventListener('beforeinput', (event) => {
                groupNameOldVal = event.target.value;
            });
            groupName.addEventListener('input', function () {
                if (this.value.trim() !== '') {
                    addAnswerContainer(groupNameOldVal, this.value);
                }
            });

            document.querySelectorAll('.remove-group').forEach(function (button) {
                button.addEventListener('click', function () {
                    this.parentElement.remove();
                    document.getElementById('general-group').remove();
                });
            });

            function addAnswerContainer(oldGroupName, newGroupName) {
                if (document.getElementById(`${oldGroupName}-group`)) {
                    document.getElementById(`${oldGroupName}-group`).remove();
                }

                let answersContainer = document.createElement('div');
                answersContainer.className = 'form-group mb-5';
                answersContainer.setAttribute('id', `${newGroupName}-group`);

                answersContainer.innerHTML = `
                    <h5>${newGroupName} Answers:</h5>
                    <div id="${newGroupName}-container">
                        <div class="answer-group d-flex align-items-center mb-2" data-index="0">
                            <input type="text" name="answers[${newGroupName}][0][body]" class="form-control me-2" placeholder="Answer" required>
                            <input type="number" name="answers[${newGroupName}][0][input_count]" class="form-control me-2" placeholder="Number of inputs to show" required value="1">
                            <select name="answers[${newGroupName}][0][type]" class="form-select me-2 w-auto" required onchange="handleSelectChange(this)">
                                <option value="text">Text</option>
                                <option value="number">Number</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="radio">Radio</option>
                            </select>
                            <button type="button" class="btn btn-danger remove-answer">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary add-answer" data-group="${newGroupName}">Add Answer</button>
                `;
                document.getElementById('question-form').appendChild(answersContainer);

                answersContainer.querySelector('.add-answer').addEventListener('click', function () {
                    let group = this.getAttribute('data-group');
                    let answersContainer = document.getElementById(`${group}-container`);
                    let answerGroups = answersContainer.querySelectorAll('.answer-group');
                    let index = answerGroups.length ? answerGroups[answerGroups.length - 1].getAttribute('data-index') : 0;
                    index = parseInt(index) + 1;
                    let newAnswerGroup = document.createElement('div');
                    newAnswerGroup.className = 'answer-group d-flex align-items-center mb-2';
                    newAnswerGroup.setAttribute('data-index', index);
                    newAnswerGroup.innerHTML = `
                        <input type="text" name="answers[${group}][${index}][body]" class="form-control me-2" placeholder="Answer" required>
                        <input type="number" name="answers[${group}][${index}][input_count]" class="form-control me-2" placeholder="Number of inputs to show" required value="1">
                        <select name="answers[${group}][${index}][type]" class="form-select me-2 w-auto" required onchange="handleSelectChange(this)">
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio</option>
                        </select>
                        <button type="button" class="btn btn-danger remove-answer">Remove</button>
                    `;
                    answersContainer.appendChild(newAnswerGroup);

                    newAnswerGroup.querySelector('.remove-answer').addEventListener('click', function () {
                        this.parentElement.remove();
                    });
                });
            }

            document.querySelector('.add-answer').addEventListener('click', function () {
                let group = this.getAttribute('data-group');
                let answersContainer = document.getElementById(`${group}-container`);
                let answerGroups = answersContainer.querySelectorAll('.answer-group');
                let index = answerGroups.length ? answerGroups[answerGroups.length - 1].getAttribute('data-index') : 0;
                index = parseInt(index) + 1;
                let newAnswerGroup = document.createElement('div');
                newAnswerGroup.className = 'answer-group d-flex align-items-center mb-2';
                newAnswerGroup.setAttribute('data-index', index);
                newAnswerGroup.innerHTML = `
                    <input type="text" name="answers[${group}][${index}][body]" class="form-control me-2" placeholder="Answer" required>
                    <input type="number" name="answers[${group}][${index}][input_count]" class="form-control me-2" placeholder="Number of inputs to show" required value="1">
                    <select name="answers[${group}][${index}][type]" class="form-select me-2 w-auto" required onchange="handleSelectChange(this)">
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="radio">Radio</option>
                    </select>
                    <button type="button" class="btn btn-danger remove-answer">Remove</button>
                `;
                answersContainer.appendChild(newAnswerGroup);

                newAnswerGroup.querySelector('.remove-answer').addEventListener('click', function () {
                    this.parentElement.remove();
                });
            });

            document.querySelector('.remove-answer').addEventListener('click', function () {
                this.parentElement.remove();
            });
        });

        function handleSelectChange(selectElement) {
            const container = selectElement.closest('.answer-group');
            const group = selectElement.closest('.form-group').getAttribute('id').split('-')[0];
            let groupContainer = document.getElementById(`${group}-container`);
            let answerGroup = selectElement.closest('.answer-group');
            let index = answerGroup.getAttribute('data-index');
            console.log(index);

            const oldInput = container.querySelector(`input[name*="[radio_value]"]`) || container.querySelector(`input[name*="[input_count]"]`);
            if (oldInput) {
                oldInput.remove();
            }

            if (selectElement.value === 'radio') {
                const newRadioInput = document.createElement('input');
                newRadioInput.type = 'text';
                newRadioInput.name = `answers[${group}][${index}][radio_value]`;
                newRadioInput.className = 'form-control me-2';
                newRadioInput.placeholder = 'Enter radio Group';
                newRadioInput.required = false;

                container.insertBefore(newRadioInput, selectElement);

            } else if (selectElement.value === 'text' || selectElement.value === 'number') {
                const newNumberInput = document.createElement('input');
                newNumberInput.type = 'number';
                newNumberInput.name = `answers[${group}][${index}][input_count]`;
                newNumberInput.className = 'form-control me-2';
                newNumberInput.placeholder = 'Number of inputs to show';
                newNumberInput.min = 1;
                newNumberInput.value = 1;
                newNumberInput.required = true;

                container.insertBefore(newNumberInput, selectElement);
            }
        }
    </script>
@endpush
