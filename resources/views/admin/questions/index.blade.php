@extends('layouts.care')

@section('content')
<nav class="mb-3" aria-label="breadcrumb">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
        <li class="breadcrumb-item active">Questions</li>
    </ol>
</nav>

<div class="mb-5">
    <h2 class="text-bold text-body-emphasis">Manage Questions</h2>
</div>

<div id="companies" data-list='{"valueNames":["question"],"page":10,"pagination":true}'>
    <div class="row align-items-center justify-content-between g-3 mb-4">
        <div class="col col-auto">
            <div class="search-box">
                <form class="position-relative">
                    <input class="form-control search-input search" type="search" placeholder="Search Question"
                        aria-label="Search" />
                    <span class="fas fa-search search-box-icon"></span>
                </form>
            </div>
        </div>

        <div class="col-auto">
            <div class="d-flex align-items-center">
                <a class="btn btn-primary" href="{{ route('question.create') }}">
                    <span class="fas fa-plus me-2"></span>Create Question
                </a>
            </div>
        </div>
    </div>

    <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
        <div class="table-responsive scrollbar ms-n1 ps-1">
            <table class="table table-sm fs-9 mb-0">
                <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="question" style="width:15%; min-width:200px;">
                            QUESTIONS
                        </th>
                        <th class="sort align-middle" scope="col" style="width:12%; min-width:100px;">
                            BODY
                        </th>
                        <th class="sort align-middle text-end" scope="col" style="width:21%;  min-width:100px;">
                            ACTIONS
                        </th>
                    </tr>
                </thead>
                <tbody class="list" id="setups-table-body">
                    @foreach($questions as $row)
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="question align-middle white-space-nowrap">
                            <h6 class="mb-0 ms-3 fw-semibold">{{ $row->title }}</h6>
                        </td>
                        <td class="city align-middle white-space-nowrap">
                            <span class="text-body">{{ $row->body }}</span>
                        </td>
                        <td class="last_active align-middle text-end white-space-nowrap text-body-tertiary">
                            <div class="btn-reveal-trigger position-static">
                                <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
                                    type="button" data-bs-toggle="dropdown" data-boundary="window"
                                    aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                    <svg class="svg-inline--fa fa-ellipsis fs-10" aria-hidden="true"
                                        focusable="false" data-prefix="fas" data-icon="ellipsis" role="img"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                        <path fill="currentColor"
                                            d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"></path>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end py-2" style="">
                                    <a class="dropdown-item" href="javascript:void(0)" data-id="{{ $row->id }}" onclick="openEditModal(event, {{ $row->id }})">Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-id="{{ $row->id }}" onclick="openShowModal(event, {{ $row->id }})">Show</a>
                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('question.destroy', $row->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
            <div class="col-auto d-flex">
                <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
                <a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1"
                        data-fa-transform="down-1"></span></a><a
                    class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span
                        class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            </div>
            <div class="col-auto d-flex">
                <button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span>
                </button>
                <ul class="mb-0 pagination"></ul>
                <button class="page-link pe-0" data-list-pagination="next"><span
                        class="fas fa-chevron-right"></span></button>
            </div>
        </div>
    </div>
</div>

@include('admin.questions.edit')
@include('admin.questions.show')

@endsection


@push("scripts")
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let answersContainer = document.getElementById('edit-answers-container');
        let addAnswerButton = document.getElementById('add-answer');

        addAnswerButton.addEventListener('click', function() {
            let newAnswerGroup = document.createElement('div');
            newAnswerGroup.className = 'answer-group d-flex align-items-center mb-2';

            newAnswerGroup.innerHTML = `
            <input type="text" name="answers[]" class="form-control me-2" placeholder="Answer" required>
            <button type="button" class="btn btn-danger remove-answer">Remove</button>
        `;

            answersContainer.appendChild(newAnswerGroup);

            newAnswerGroup.querySelector('.remove-answer').addEventListener('click', function() {
                this.parentElement.remove();
            });
        });

        document.querySelectorAll('.remove-answer').forEach(function(button) {
            button.addEventListener('click', function() {
                this.parentElement.remove();
            });
        });
    });

    function openEditModal(event, id) {
        event.preventDefault();
        $.get(`/api/questions/fetch-question/${id}`, function(response) {
            let question = response.question;
            let answers = question.answers;
            let question_answers = response.question_answers;
            let generalGroupLabel = document.getElementById('general-group-label');

            question_answers.forEach(function(question_answer) {
                question.group = question_answer.group == 'general' ? 'general' : question_answer.group;
            });

            let form = document.getElementById('edit-question-form');

            $('#edit-question-form').attr('action', `/question/${id}`);

            form.querySelector('input[name="title"]').value = question.title;
            form.querySelector('input[name="body"]').value = question.body;
            form.querySelector('input[name="sort_order"]').value = question.sort_order;
            form.querySelector('input[name="group"]').value = question.group;

            let customGroup = document.getElementById('custom-group');
            customGroup.style.display = 'none';

            $('#edit-general-answers-container').empty();
            $('#edit-custom-answers-container').empty();

            if (question.group != 'general') {
                for (let i = 0; i < question_answers.length; i++) {
                    for (let j = 0; j < answers.length; j++) {
                        if (question_answers[i].mid_answer_id === answers[j].id) {
                            if (question_answers[i].group == 'general') {
                                generalGroupLabel.innerHTML = 'General Answers:';
                                let answerGroup = `
                                <div class="show-answer-group d-flex align-items-center mb-2">
                                    <input type="hidden" name="answer_ids[general][]" value="${answers[j].id}">
                                    <input type="text" name="answers[general][]" class="form-control me-2" value="${answers[j].body}">
                                    <select name="answer_type[${question_answers[i].group}][]" class="form-control me-2" required>
                                        <option value="text" ${answers[j].answer_type == 'text' ? 'selected' : ''}>Text</option>
                                        <option value="number" ${answers[j].answer_type == 'number' ? 'selected' : ''}>Number</option>
                                        <option value="checkbox" ${answers[j].answer_type == 'checkbox' ? 'selected' : ''}>Checkbox</option>
                                        <option value="radio" ${answers[j].answer_type == 'radio' ? 'selected' : ''}>Radio</option>
                                    </select>
                                    <button type="button" class="btn btn-danger remove-answer">Remove</button>
                                </div>
                                `;
                                $('#edit-general-answers-container').append(answerGroup);
                            } else {
                                let customGroupLabel = document.getElementById('custom-group-label');
                                customGroupLabel.innerText = question_answers[i].group.charAt(0).toUpperCase() + question_answers[i].group.slice(1);
                                let customGroup = document.getElementById('custom-group');
                                customGroup.style.display = 'block';
                                let answerGroup = `
                                    <div class="custom-answer-group d-flex align-items-center mb-2">
                                        <input type="hidden" name="answer_ids[${question_answers[i].group}][]" value="${answers[j].id}">
                                        <input type="text" name="answers[${question_answers[i].group}][]" class="form-control me-2" value="${answers[j].body}">
                                        <select name="answer_type[${question_answers[i].group}][]" class="form-control me-2" required>
                                            <option value="text" ${answers[j].answer_type == 'text' ? 'selected' : ''}>Text</option>
                                            <option value="number" ${answers[j].answer_type == 'number' ? 'selected' : ''}>Number</option>
                                            <option value="checkbox" ${answers[j].answer_type == 'checkbox' ? 'selected' : ''}>Checkbox</option>
                                            <option value="radio" ${answers[j].answer_type == 'radio' ? 'selected' : ''}>Radio</option>
                                        </select>
                                        <button type="button" class="btn btn-danger remove-answer">Remove</button>
                                    </div>
                                `;

                                $('#edit-custom-answers-container').append(answerGroup);
                            }
                        }
                    }
                }
            } else {
                generalGroupLabel.innerHTML = 'Answers:';
                answers.forEach(answer => {
                    let answerGroup = `
                    <div class="show-answer-group d-flex align-items-center mb-2">
                        <input type="hidden" name="answer_ids[]" value="${answer.id}">
                        <input type="text" name="answers[]" class="form-control me-2" value="${answer.body}">
                        <select name="answer_type[]" class="form-control me-2" required>
                            <option value="text" ${answer.answer_type == 'text' ? 'selected' : ''}>Text</option>
                            <option value="number" ${answer.answer_type == 'number' ? 'selected' : ''}>Number</option>
                            <option value="checkbox" ${answer.answer_type == 'checkbox' ? 'selected' : ''}>Checkbox</option>
                            <option value="radio" ${answer.answer_type == 'radio' ? 'selected' : ''}>Radio</option>
                        </select>
                        <button type="button" class="btn btn-danger remove-answer">Remove</button>
                    </div>
                `;

                    $('#edit-general-answers-container').append(answerGroup);
                });
            }
            document.querySelectorAll('.remove-answer').forEach(function(button) {
                button.addEventListener('click', function() {
                    this.parentElement.remove();
                });
            });
            var modal = new bootstrap.Modal(document.getElementById('edit-questions'), {});
            modal.show();
        });
    }

    function openShowModal(event, id) {
        event.preventDefault();
        $.get(`/api/questions/fetch-question/${id}`, function(response) {
            let question = response.question;
            let answers = question.answers;
            let question_answers = response.question_answers;
            let generalGroupLabel = document.getElementById('general-group-label');

            question_answers.forEach(function(question_answer) {
                question.group = question_answer.group == 'general' ? 'general' : question_answer.group;
            });

            $('#show-title').val(question.title);
            $('#show-body').val(question.body);
            $('#show-sort_order').val(question.sort_order);
            $('#show-group').val(question.group);
            let customGroup = document.getElementById('custom-group');
            customGroup.style.display = 'none';
            $('#general-answers-container').empty();
            $('#custom-answers-container').empty();
            if (question.group != 'general') {
                for (let i = 0; i < question_answers.length; i++) {
                    for (let j = 0; j < answers.length; j++) {
                        if (question_answers[i].mid_answer_id === answers[j].id) {
                            if (question_answers[i].group == 'general') {
                                generalGroupLabel.innerHTML = 'General Answers:';
                                let answerGroup = `
                                <div class="show-answer-group d-flex align-items-center mb-2">
                                    <input type="hidden" name="answer_ids[]" value="${answers[j].id}">
                                    <input type="text" name="answers[]" class="form-control me-2" value="${answers[j].body}" readonly>
                                    <input type="text" name="answers_type[]" class="form-control me-2" value="${answers[j].answer_type}" readonly>
                                </div>
                                `;
                                $('#general-answers-container').append(answerGroup);
                            } else {
                                let customGroupLabel = document.getElementById('custom-group-label');
                                customGroupLabel.innerText = question_answers[i].group.charAt(0).toUpperCase() + question_answers[i].group.slice(1);
                                let customGroup = document.getElementById('custom-group');
                                customGroup.style.display = 'block';
                                let answerGroup = `
                                    <div class="custom-answer-group d-flex align-items-center mb-2">
                                        <input type="hidden" name="answer_ids[]" value="${answers[j].id}">
                                        <input type="text" name="custom_answers[]" class="form-control me-2" value="${answers[j].body}" readonly>
                                        <input type="text" name="answers_type[]" class="form-control me-2" value="${answers[j].answer_type}" readonly>
                                    </div>
                                `;

                                $('#custom-answers-container').append(answerGroup);
                            }
                        }
                    }
                }
            } else {
                generalGroupLabel.innerHTML = 'Answers:';
                answers.forEach(answer => {
                    let answerGroup = `
                    <div class="show-answer-group d-flex align-items-center mb-2">
                        <input type="hidden" name="answer_ids[]" value="${answer.id}">
                        <input type="text" name="answers[]" class="form-control me-2" value="${answer.body}" readonly>
                        <input type="text" name="answers_type[]" class="form-control me-2" value="${answer.answer_type}" readonly>
                    </div>
                `;

                    $('#general-answers-container').append(answerGroup);
                });
            }

            var modal = new bootstrap.Modal(document.getElementById('show-questions'), {});
            modal.show();
        });
    }

    $('#save-button').click(function() {
        $('#edit-question-form').submit();
    });
</script>

@endpush
