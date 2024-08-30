<div class="card shadow-none border mb-4" data-component-card="data-component-card">
    <div class="card-header p-4 border-bottom bg-body">
        <div class="row g-3 justify-content-between align-items-center">
            <div class="col-12 col-md">
                <h4 class="text-body mb-0" id="{{$question_id}}">
                    {{ $title }}
                </h4>
            </div>
        </div>
    </div>

    <div class="card-body theme-wizard mb-0" data-theme-wizard="data-theme-wizard" id='{{str_replace(" ", "-", strtolower($title))}}'>
        <div class="row justify-content-between">
            <div class="col-md-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-general" role="tabpanel" aria-labelledby="general-tab">
                        <form>
                            <div class="row g-3">
                                <p class="fs-8 fw-bold">
                                    {{ $body }}
                                </p>

                                @if($group != 'general' && $group != "")

                                @endif
                                @if($group == 'general' || $group == "")
                                @foreach($question_answers as $qa)
                                    @if ($qa->group == 'general')
                                        @foreach($answers as $option)
                                            @if($qa->mid_answer_id == $option->id)
                                                <div class="form-check">
                                                    <input class="form-check-input" id="flexRadioDefault{{ $option->id }}" type="{{$option->answer_type}}" name="flexRadioDefault{{ $question_id }}" value="{{ $option->id }}" checked>
                                                    <label class="form-check-label fs-8" for="flexRadioDefault{{ $option->id }}">{{ $option->body }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                @endif
                            </div>
                        </form>
                    </div>

                    @if($group != 'general' && $group != "")
                        <p class="nav nav-underline fs-9 p-1 mb-2" id="myTab" role="tablist">
                            <a class="nav-link active" id="general-{{$question_id}}-tab" data-bs-toggle="tab" href="#tab-general-{{$question_id}}" role="tab" aria-controls="tab-general-{{$question_id}}" aria-selected="true">General</a>
                            <a class="nav-link" id="{{$group}}-{{$question_id}}-tab" data-bs-toggle="tab" href="#tab-{{$group}}-{{$question_id}}" role="tab" aria-controls="tab-{{$group}}-{{$question_id}}" aria-selected="false">{{ucfirst($group)}}</a>
                        </p>
                        <div class="tab-pane" id="tab-{{$group}}-{{$question_id}}" role="tabpanel" aria-labelledby="{{$group}}-{{$question_id}}-tab">
                            <form>
                                <div class="row g-3">
                                    @foreach($question_answers as $qa)
                                        @if ($qa->group == $group)
                                            @foreach($answers as $option)
                                                @if($qa->mid_answer_id == $option->id)
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="flexRadioDefault{{ $option->id }}" type="{{$option->answer_type}}" name="flexRadioDefault{{ $question_id }}" value="{{ $option->id }}" checked>
                                                        <label class="form-check-label fs-8" for="flexRadioDefault{{ $option->id }}">{{ $option->body }}</label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane active show" id="tab-general-{{$question_id}}" role="tabpanel" aria-labelledby="general-{{$question_id}}-tab">
                            <form>
                                <div class="row g-3">
                                    @foreach($question_answers as $qa)
                                        @if ($qa->group == "general")
                                            @foreach($answers as $option)
                                                @if($qa->mid_answer_id == $option->id)
                                                    @if($option->answer_type == 'number' || $option->answer_type == 'text')
                                                        <div class="form-group d-flex mb-3">
                                                            <label for="flexRadioDefault{{ $option->id }}" class="form-label-sm me-2">{{ $option->body }}</label>
                                                            <input type="number" class="form-control" id="flexRadioDefault{{ $option->id }}" name="flexRadioDefault{{ $question_id }}" value="0" required>
                                                        </div>
                                                    @else
                                                    <div class="form-check">
                                                        <input class="form-check-input" id="flexRadioDefault{{ $option->id }}" type="{{$option->answer_type}}" name="flexRadioDefault{{ $question_id }}" value="{{ $option->id }}" checked>
                                                        <label class="form-check-label fs-8" for="flexRadioDefault{{ $option->id }}">{{ $option->body }}</label>
                                                    </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
