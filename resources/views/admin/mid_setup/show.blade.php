@extends('layouts.care')

@section('content')
    <div class="mb-5">
        <h2 class="text-bold text-body-emphasis">Show MID</h2>
        <p class="text-muted">This setup will show you the MID you've created</p>
    </div>

    <div class="col-12 col-xxl-auto">
        <div class="row">
            <div class="col-12 col-xl-10 order-2 order-xl-1">
                <input type="text" name="mid-name" id="mid-name" class="form-control mb-2" placeholder="Enter MID Name" value="{{$midSetup->title}}" readonly>
                @foreach($questions as $form)
                    @include('admin.mid_setup.partials.show_question_form', [
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
@endpush
