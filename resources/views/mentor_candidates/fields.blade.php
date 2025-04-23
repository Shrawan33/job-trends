<div class="row">
    <div class="col-sm-6 mb-3">
        {!! trans('label.criteria')!!}
    </div>
    <div class="col-sm-6 mb-3">
        {!! trans('label.levels')!!}
    </div>
    <!-- User ID Field -->
    {!! Form::hidden('user_id', $user_id,['id'=>'userId']) !!}

    <!-- Criteria Field -->
    @foreach($criterias as  $key => $criteria)
    <div class="form-group col-sm-6 criteria">
        {!! Form::label('criteria', $criteria??null) !!}
        {!! Form::hidden("score[$key][id]", $scoreIds[$key]??null,['class'=>'score_id']) !!}
    </div>

    <div class="form-group col-sm-6">
        {!! Form::select("score[$key][level]", $levels??null,$levelIds[$key]??null, ['class' => 'form-control no-select levelSelect', 'placeholder' => 'Choose One']) !!}
        <span class="help-block"></span>

    </div>
    @endforeach
    <div class="form-group col-sm-6" id="average_total">
        @include('mentor_candidates.average_score')
    </div>
</div>

@push('page_scripts')
  <script>
      $(document).ready(function () {
        $('.levelSelect').on('change', function(e){
            e.preventDefault();

            var url = "{{ route('mentor_candidate.ajaxAverageScore') }}";
            var data = $('#frm_mentor_candidate').serialize();
            $.ajax({
                url: url,
                method: "POST",
                data: data,
                dataType: "json",
                success: function(response) {
                    var data = response['data'];
                    $('#average_total').html(data);

                }
            });
            });

    });

  </script>
@endpush
