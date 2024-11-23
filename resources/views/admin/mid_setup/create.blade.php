@extends('layouts.care')

@section('content')
    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Create MID</h2>
        <p class="text-muted">This setup will allow you to define the components that belongs to machine/MID</p>
    </div>

    <div class="col-12 col-xxl-auto">
        <div class="row">
            <div class="col-12 col-xl-10 order-2 order-xl-1">
                <input type="text" name="mid-name" id="mid-name" class="form-control mb-2" placeholder="Enter MID Name" required>
                @foreach($questions as $form)
                    @include('admin.mid_setup.partials.question_form', [
                        'question_answers' => $form['question_answers'],
                        'groups' => $form['groups'],
                        'group_count' => $form['group_count'],
                        'question_id' => $form['id'],
                        'title' => $form['title'],
                        'body' => $form['body'],
                        'answers' => $form['answers']
                    ])
                @endforeach
            </div>
            <div class="col-12 col-xl-2 order-1 order-xl-2 mb-4 mb-xl-0">
                <div class="sticky-top mt-xl-4" style="top:80px;">
                    <h5 class="lh-1">On this page</h5>
                    <hr>
                    <ul class="nav nav-vertical flex-column doc-nav" data-doc-nav="data-doc-nav">
                        @foreach($questions as $question)
                            <li class="nav-item"><a class="nav-link" href="#{{ Str::slug($question['title']) }}">{{ $question['title'] }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection()

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let childParentRelation = [];
            let removeChildQuestions = (parentId) => {
                let childQuestions = childParentRelation.filter(relation => relation.parent_question_id === parentId);

                childQuestions.forEach(child => {
                    let childQuestionId = child.child_question_id;

                    let childQuestionTitle = $(`#${childQuestionId}`).find('h4').text().trim();
                    let childQuestionHref = childQuestionTitle.replace(/\s+/g, '-').toLowerCase();
                    $(`.doc-nav a[href="#${childQuestionHref}"]`).closest('li').remove();
                    $(`#${childQuestionId}`).remove();
                    removeChildQuestions(childQuestionId);
                });
                childParentRelation = childParentRelation.filter(relation => relation.parent_question_id !== parentId);
            };
            document.addEventListener('click', function (e) {
                if (e.target && e.target.id === 'next-button' || e.target.id === 'groups-next-button') {
                    e.preventDefault();
                    let form = $(e.target).closest('form');

                    let question_id = form.find('input[type="hidden"][id^="question"]').val();

                    let selectedRadio = form.find('input[type="radio"]:checked');

                    $.post('/api/mid-setup/fetch-child-question', {
                        _token: '{{ csrf_token() }}',
                        question_id: question_id,
                        answer_id: e.target.id === 'next-button' ? selectedRadio.val() : null,
                    }, function (response) {
                        let oldQuestion = childParentRelation.find(relation => relation.parent_question_id === question_id);
                        if (oldQuestion) {
                            let oldQuestionId = oldQuestion.child_question_id;

                            removeChildQuestions(oldQuestionId);

                            let oldQuestionTitle = $(`#${oldQuestionId}`).find('h4').text().trim();
                            let oldQuestionHref = oldQuestionTitle.replace(/\s+/g, '-').toLowerCase();
                            $(`.doc-nav a[href="#${oldQuestionHref}"]`).closest('li').remove();
                            $(`#${oldQuestionId}`).remove();
                            childParentRelation = childParentRelation.filter(relation => relation.child_question_id !== oldQuestionId);
                        }

                        let newQuestionId = $(response).find('input[type="hidden"][id^="question"]').val();

                        childParentRelation.push({parent_question_id: question_id, child_question_id: newQuestionId,});

                        $(`#${question_id}`).after(response);

                        let newQuestionTitle = $(response).find('h4').text().trim();
                        let newQuestionHref = newQuestionTitle.replace(/\s+/g, '-').toLowerCase();

                        let currentQuestionTitle = $(`#${question_id}`).find('h4').text().trim();
                        let currentHref = currentQuestionTitle.replace(/\s+/g, '-').toLowerCase();

                        $(`.doc-nav a[href="#${currentHref}"]`).closest('li').after(`
                            <li class="nav-item">
                                <a class="nav-link" href="#${newQuestionHref}">${newQuestionTitle}</a>
                            </li>
                        `);
                    });
                }
            });
        });
        function saveMidSetup(event) {
            event.preventDefault();
            const midName = document.getElementById('mid-name');
            const forms = document.querySelectorAll('form');

            if (!midName.checkValidity()){
                midName.reportValidity();
                return;
            }

            let allData = [];
            allData.push({midName: midName.value});

            forms.forEach(form => {
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                allData.push(data);
            });

            $.post('/api/mid-setup/save',
                Object.assign({}, ...allData)
                , function (response) {
                    if (response.success) {
                        window.location.href = '/new-mid/create';
                    }
            });
        }
    </script>
@endpush
