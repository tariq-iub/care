@extends('layouts.care')

@section('content')
    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Create MID</h2>
        <p class="text-muted">This setup will allow you to define the components that belongs to machine/MID</p>
    </div>

    <div class="col-12 col-xxl-auto">
        <div class="row">
            <div class="col-12 col-xl-10 order-2 order-xl-1">
                <input type="text" name="mid-name" id="mid-name" class="form-control mb-2" placeholder="Enter MID Name" value="{{$midSetup->title}}">
                @foreach($questions as $form)
                    @include('admin.mid_setup.partials.edit_question_form', [
                        'group' => $form['group'],
                        'groups' => $form['groups'],
                        'group_count' => $form['group_count'],
                        'question_answers' => $form['question_answers'],
                        'question_id' => $form['id'],
                        'title' => $form['title'],
                        'body' => $form['body'],
                        'answers' => $form['answers'],
                        'selected_option_id' => $form['selected_answer']
                    ])
                @endforeach

                <div class="card shadow-none border" data-component-card="data-component-card">
                    <div class="card-header p-4 border-bottom bg-body">
                        <div class="row g-3 justify-content-between align-items-center">
                            <div class="col-12 col-md">
                                <h4 class="text-body mb-0" id="vertical-wizard">
                                    Setup Completed
                                </h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard">
                        <div class="row justify-content-between">
                            <div class="col-md-12">
                                <div class="tab-content">
                                    <div class="tab-pane active" role="tabpanel" aria-labelledby="bootstrap-vertical-wizard-tab1" id="bootstrap-vertical-wizard-tab1">
                                        <div class="row g-3">
                                            <h4>Congratulations!</h4>
                                            <p>
                                                That's all there is to it.Press Finish to save this MID.
                                            </p>

                                            <p class="col-md-12 text-info fs-9 mt-8">
                                                Tip: Press the Finish button to return to the MID from where it can be saved.
                                            </p>

                                            <div class="d-flex justify-content-between">
                                                <button class="btn btn-secondary" onclick="return false;">Cancel</button>
                                                <button class="btn btn-primary" onclick="saveMidSetup()">Save Setup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
        function saveMidSetup() {
            const midName = document.getElementById('mid-name').value;
            const forms = document.querySelectorAll('form');

            let allData = [];

            forms.forEach(form => {
                const formData = new FormData(form);
                const data = Object.fromEntries(formData.entries());
                allData.push(data);
            });

            console.log(allData);
            allData.push({mid_id: {{ $midSetup->id }}})
            allData.push({midName: midName});


            $.post(`/api/mid-setup/update/{{ $midSetup->id }}`,
                Object.assign({}, ...allData)
                , function (response) {
                    console.log(response);
                });
        }

    </script>
@endpush
