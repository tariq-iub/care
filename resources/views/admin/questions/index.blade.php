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
                        <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">
                            BODY
                        </th>
                        <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">

                        </th>
                        <th class="sort align-middle" scope="col" style="width:15%; min-width:200px;">

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
                        <td class="city align-middle white-space-nowrap">
                            <span class="text-body">{{ $row->city }}</span>
                        </td>
                        <td class="email align-middle white-space-nowrap">
                            <span class="text-body">{{ $row->phone_number }}</span>
                            <br>
                            <a class="fw-semibold" href="mailto:{{ $row->email }}">{{ $row->email }}</a>
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

            // Add event listener to remove button
            newAnswerGroup.querySelector('.remove-answer').addEventListener('click', function() {
                this.parentElement.remove();
            });
        });

        // Add event listener to existing remove button
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

            $('#edit-question-form').attr('action', `/question/${id}`);

            $('#edit-title').val(question.title);
            $('#edit-body').val(question.body);

            $('#edit-answers-container').empty();

            answers.forEach(answer => {
                let answerGroup = `
                    <div class="edit-answer-group d-flex align-items-center mb-2">
                        <input type="hidden" name="answer_ids[]" value="${answer.id}">
                        <input type="text" name="answers[]" class="form-control me-2" value="${answer.body}" required>
                        <button type="button" class="btn btn-danger remove-answer">Remove</button>
                    </div>
                `;

                $('#edit-answers-container').append(answerGroup);
            });
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

            $('#show-title').val(question.title);
            $('#show-body').val(question.body);

            $('#show-answers-container').empty();

            answers.forEach(answer => {
                let answerGroup = `
                    <div class="show-answer-group d-flex align-items-center mb-2">
                        <input type="hidden" name="answer_ids[]" value="${answer.id}">
                        <input type="text" name="answers[]" class="form-control me-2" value="${answer.body}" readonly>
                    </div>
                `;

                $('#show-answers-container').append(answerGroup);
            });
            document.querySelectorAll('.remove-answer').forEach(function(button) {
                button.addEventListener('click', function() {
                    this.parentElement.remove();
                });
            });
            var modal = new bootstrap.Modal(document.getElementById('show-questions'), {});
            modal.show();
        });
    }

    $('#save-button').click(function() {
        $('#edit-question-form').submit();
    });
</script>

@endpush