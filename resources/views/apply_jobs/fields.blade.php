<div class="row">
    <div class="col-12 que-form">
        @foreach ($questionnaire as $key => $question)
            <div class="form-group">
                <label for="" class="text-black">{{$question->title??null}}</label>
                {!! Form::hidden('questionnaire['.$key.'][questionnaire_id]', $question->id) !!}
                {!! Form::textarea('questionnaire['.$key.'][answer]', null, ['cols' => "30", 'rows' => "3", 'class' => 'form-control', 'placeholder' => trans('label.write_answer_placeholder')]) !!}

                <span class="error invalid-feedback"></span>

            </div>
        @endforeach
    </div>
    <div class="form-group col-sm-12 m-0">
        {!! Form::hidden('user_id', auth()->user()->id??null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>
</div>

@push('page_scripts')
    <script src="{{asset('js/validation/applyJob.js')}}"></script>
@endpush
