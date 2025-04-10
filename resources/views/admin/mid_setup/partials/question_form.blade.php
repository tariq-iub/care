<div class="card shadow-none border mb-4" data-component-card="data-component-card" id="{{$question_id}}">
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
                    <p class="fs-8 fw-bold">
                        {{ $body }}
                    </p>
                    @if($group_count > 1)
                        <p class="nav nav-underline fs-9 p-1 mb-2" id="myTab" role="tablist">
                            @foreach($groups as $index => $group)
                                <a class="nav-link {{$index == 0 ? 'active' : ''}}" id="{{str_replace(' ', '-', $group)}}-{{$question_id}}-tab" data-bs-toggle="tab" href="#tab-{{str_replace(' ', '-', $group)}}-{{$question_id}}" role="tab" aria-controls="tab-{{str_replace(' ', '-', $group)}}-{{$question_id}}" aria-selected="false">{{ucfirst($group)}}</a>
                            @endforeach
                        </p>
                    @endif
                    @foreach($groups as $index => $group)
                        <div class="tab-pane {{$index == 0 ? 'active show' : ''}}" id="tab-{{str_replace(' ', '-', $group)}}-{{$question_id}}" role="tabpanel" aria-labelledby="{{str_replace(' ', '-', $group)}}-{{$question_id}}-tab">
                            <form>
                                <div class="row g-3">
                                    @php
                                        $displayedRadioGroups = [];
                                    @endphp
                                    @foreach($question_answers as $qa)
                                        @if ($qa->group == $group)
                                            @foreach($answers as $option)
                                                @if($qa->mid_answer_id == $option->id)
                                                    @if ($group == 'Finish' || $group == 'finish')
                                                        <input type="hidden" id="question{{$question_id}}" value="{{$question_id}}" required>
                                                        <div class="row g-3">
                                                            <p>
                                                                {{$option->body}}
                                                            </p>
                                                        </div>
                                                    @else
                                                        <input type="hidden" class="form-control" id="question{{$question_id}}" name="question{{ $question_id }}" value="{{$question_id}}" required>
                                                        @if($option->answer_type == 'number' || $option->answer_type == 'text')
                                                            <div class="form-group d-flex mb-3">
                                                                <label for="input{{ $option->id }}" class="form-label-sm me-2 w-100">{{ $option->body }}</label>
                                                                @if ($option->input_count == null || $option->input_count == 0)
                                                                    <input type="number" class="form-control me-2" id="input{{ $option->id }}" name="input{{ $option->id }}" value="0" required>
                                                                @else
                                                                    @for ($i = 0; $i < $option->input_count; $i++)
                                                                        <input type="number" class="form-control me-2" id="input{{ $option->id }}index{{$i}}" name="input{{ $option->id }}index{{$i}}" value="0" required>
                                                                    @endfor
                                                                @endif
                                                            </div>
                                                        @elseif($option->answer_type == 'checkbox')
                                                            <div class="form-check">
                                                                <input type="hidden" name="checkbox{{ $option->id }}" value="0">
                                                                <input class="form-check-input" id="checkbox{{ $option->id }}" type="{{$option->answer_type}}" name="checkbox{{ $option->id }}" value="1" checked>
                                                                <label class="form-check-label fs-8" for="checkbox{{ $option->id }}">{{ $option->body }}</label>
                                                            </div>
                                                        @else
                                                            @if ($option->radio_group)
                                                                @if ( !in_array($option->radio_group, $displayedRadioGroups))
                                                                    <h5>{{ $option->radio_group }}</h5>
                                                                    @php
                                                                        $displayedRadioGroups[] = $option->radio_group;
                                                                    @endphp
                                                                @endif
                                                                <div class="form-check ms-10">
                                                                    <input class="form-check-input" id="flexRadioDefault{{ $group }}{{ $question_id }}{{ $option->id }}" type="{{$option->answer_type}}" name="flexRadioDefault{{ $group }}{{ $option->radio_group }}{{ $question_id }}" value="{{ $option->id }}" checked>
                                                                    <label class="form-check-label fs-8" for="flexRadioDefault{{ $group }}{{ $question_id }}{{ $option->id }}">{{ $option->body }}</label>
                                                                </div>
                                                            @else
                                                                <div class="form-check">
                                                                    <input class="form-check-input" id="flexRadioDefault{{ $group }}{{ $question_id }}" type="{{$option->answer_type}}" name="flexRadioDefault{{ $group }}{{ $question_id }}" value="{{ $option->id }}" checked>
                                                                    <label class="form-check-label fs-8" for="flexRadioDefault{{ $group }}{{ $question_id }}">{{ $option->body }}</label>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    @if ($group == 'Finish' || $group == 'finish')
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-secondary" onclick="return false;">Cancel</button>
                                            <button class="btn btn-primary" onclick="saveMidSetup(event)">Save Setup</button>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-end">
                                            <button class="btn btn-primary" id="{{$group_count > 1 ? 'groups-next-button' : 'next-button'}}">Next</button>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
