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
                                <div class="row g-3 mb-2">
                                    <div class="col-md-12">
                                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="body" class="form-label">Body <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="body" name="body" required>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="sort_order" class="form-label">Sort Order <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="sort_order" name="sort_order" required value="0">
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="group" class="form-label">Group</label>
                                    <input type="text" class="form-control" id="group" name="group" value="general" required>
                                </div>

                                <div class="form-group mb-2" id="general-group">
                                    <label class="fw-bold">Answers:</label>
                                    <div id="general-answers-container">
                                        <div class="answer-group d-flex align-items-center mb-2">
                                            <input type="text" name="answers[]" class="form-control me-2" placeholder="Answer" required>
                                            <select name="answer_type[]" class="form-select me-2" required>
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

                                <div class="form-group mb-2" id="custom-group" style="display: none">
                                    <label class="fw-bold"><span id="custom-group-label">Custom Group</span> Answers:</label>
                                    <div id="custom-answers-container">
                                        <div class="answer-group d-flex align-items-center mb-2">
                                            <input type="text" name="answers[custom][]" class="form-control me-2" placeholder="Answer" required>
                                            <select name="answer_type[custom][]" class="form-select me-2" required>
                                                <option value="text">Text</option>
                                                <option value="number">Number</option>
                                                <option value="checkbox">Checkbox</option>
                                                <option value="radio">Radio</option>
                                            </select>
                                            <button type="button" class="btn btn-danger remove-answer">Remove</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary add-answer" data-group="custom">Add Answer</button>
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
            let groupInput = document.getElementById('group');

            let generalGroupLabel = document.getElementById('general-group-label');
            let generalGroupSection = document.getElementById('general-group');
            let generalGroupInputs = generalGroupSection.querySelectorAll('input');
            let generalSelect = generalGroupSection.querySelector('select');

            let customGroupLabel = document.getElementById('custom-group-label');
            let customGroupSection = document.getElementById('custom-group');
            let customGroupInputs = customGroupSection.querySelectorAll('input');
            let customSelect = customGroupSection.querySelector('select');

            // Update custom group label and show/hide custom group section based on group input
            groupInput.addEventListener('input', function () {
                let groupValue = groupInput.value.trim();
                if (groupValue.toLowerCase() === 'general') {
                    customGroupSection.style.display = 'none';
                    customGroupInputs.forEach(input => input.disabled = true);
                    customSelect.disabled = true;
                } else {
                    generalGroupSection.getElementsByTagName('label')[0].textContent = 'General Answers:';
                    generalGroupInputs.forEach(input => input.name = 'answers[general][]');
                    generalSelect.name = 'answer_type[general][]';
                    customGroupSection.style.display = 'block';
                    customGroupLabel.textContent = groupValue;
                    customGroupInputs.forEach(input => input.disabled = false);
                    customSelect.disabled = false;
                }
            });

            // Initial check on page load
            groupInput.dispatchEvent(new Event('input'));

            // Function to add answer input
            function addAnswerInput(groupName, container) {
                let newAnswerGroup = document.createElement('div');
                newAnswerGroup.className = 'answer-group d-flex align-items-center mb-2';
                newAnswerGroup.innerHTML = `
                    <input type="text" name="answers[${groupName}][]" class="form-control me-2" placeholder="Answer" required>
                    <select name="answer_type[${groupName}][]" class="form-select me-2" required>
                        <option value="text">Text</option>
                        <option value="number">Number</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="radio">Radio</option>
                    </select>
                    <button type="button" class="btn btn-danger remove-answer">Remove</button>
                `;
                container.appendChild(newAnswerGroup);

                // Add event listener to remove button
                newAnswerGroup.querySelector('.remove-answer').addEventListener('click', function () {
                    this.parentElement.remove();
                });
            }

            // Event listener for adding answers
            document.querySelectorAll('.add-answer').forEach(function (button) {
                button.addEventListener('click', function () {
                    if (groupInput.value.trim().toLowerCase() === 'general') {
                        let generalAnswersContainer = document.getElementById('general-answers-container');
                        generalAnswersContainer.innerHTML += `
                            <div class="answer-group d-flex align-items-center mb-2">
                                <input type="text" name="answers[]" class="form-control me-2" placeholder="Answer" required>
                                <select name="answer_type[]" class="form-select me-2" required>
                                    <option value="text">Text</option>
                                    <option value="number">Number</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="radio">Radio</option>
                                </select>
                                <button type="button" class="btn btn-danger remove-answer">Remove</button>
                            </div>
                        `;
                        return;
                    }
                    let group = this.getAttribute('data-group');
                    let container = document.getElementById(group + '-answers-container');
                    addAnswerInput(group, container);
                });
            });

            // Event listener to remove existing answer
            document.querySelectorAll('.remove-answer').forEach(function (button) {
                button.addEventListener('click', function () {
                    this.parentElement.remove();
                });
            });
        });
    </script>
@endpush
