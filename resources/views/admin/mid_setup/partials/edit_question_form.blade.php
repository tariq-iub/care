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
                    <div class="tab-pane active" role="tabpanel">
                        <form>
                            <div class="row g-3">
                                <p class="fs-8 fw-bold">
                                    {{ $body }}
                                </p>

                                @if($group != 'general')
                                    <p class="nav nav-underline fs-9 p-1" id="myTab" role="tablist">
                                        <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#tab-general" role="tab" aria-controls="tab-general" aria-selected="true">General</a></a>
                                        <a class="nav-link" id="{{$group}}-{{$question_id}}-tab" data-bs-toggle="tab" href="#tab-{{$group}}-{{$question_id}}" role="tab" aria-controls="tab-{{$group}}-{{$question_id}}" aria-selected="false">{{ucfirst($group)}}</a></a>
                                    </p>
                                @endif

                                @foreach($answers as $option)
                                    <div class="form-check">
                                        @if ($option->id == $selected_option_id)
                                            <input class="form-check-input" id="flexRadioDefault{{ $option->id }}" type="radio" name="flexRadioDefault{{ $question_id }}" value="{{ $option->id }}" checked>
                                        @else
                                            <input class="form-check-input" id="flexRadioDefault{{ $option->id }}" type="radio" name="flexRadioDefault{{ $question_id }}" value="{{ $option->id }}">
                                        @endif
                                        <label class="form-check-label fs-8" for="flexRadioDefault{{ $option->id }}">{{ $option->body }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
