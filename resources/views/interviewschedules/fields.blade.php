@section('third_party_stylesheets')
@include('vendor.image_upload.style')
@include('vendor.richtexteditor.style')
@endsection
<div class="">
    <div class="row table_box mx-0">
        <!-- Title Field -->
        <div class="col-md-6 col-lg-4 form-group mb-3">
            {!! html_entity_decode(Form::label('title', trans('label.title') . '<span style="color: red">*</span>', ['class' => 'required-label'])) !!}

            {{-- {!! Form::label('title', trans('label.title'), ['class' => 'required-label']) !!} --}}
            {!! Form::text('title', trans('label.add_interview_schedule') . ' - ' . ($employerJob->title ?? ''), [
                'class' => 'form-control ' . ($errors->has('title') ? 'is-invalid' : ''),
                'placeholder' => trans('label.title')
            ]) !!}
                        @error('title')
            <span class="error invalid-feedback">{{$message}}</span>
            @enderror
        </div>

		<div class="col-md-6 col-lg-4 form-group mb-3">
            {!! html_entity_decode(Form::label('interview_link', trans('label.interview_link') . '<span style="color: red">*</span>', ['class' => 'required-label'])) !!}

            {{-- {!! Form::label('interview_link', 'Interview Link', ['class' => 'required-label']) !!} --}}
            {!! Form::text('interview_link', null, ['class' => 'form-control '. ($errors->has('interview_link') ? 'is-invalid' : ''), 'placeholder' => 'Interview Link']) !!}
            @error('interview_link')
            <span class="error invalid-feedback">{{$message}}</span>
            @enderror
        </div>
		<div class="col-md-6 col-lg-4 form-group mb-3">
            {!! html_entity_decode(Form::label('datetime', trans('label.select_date_time') . '<span style="color: red">*</span>', ['class' => 'required-label'])) !!}

            {{-- {!! Form::label('datetime', trans('label.datetime'), ['class' => 'required-label']) !!} --}}
            {{-- <input id="datetime" name="datetime" type="datetime-local" class="form-control" <?php if(Request::url() != route($entity['url'].'.create', ['employer_job_id' => $employer_job_id, 'user_id' => $user_id])) {?>  value="{{old('datetime')?? date('Y-m-d\TH:i', strtotime($interviewtype->datetime)) }}" <?php }?>>
            @if ($errors->has('datetime'))
                <span class="error invalid-feedback">{{ $errors->first('datetime') }}</span>
            @endif
            <span class="error invalid-feedback">{{ $errors->first('datetime') }}</span>
            @endif --}}

            <div class="d-flex custom_date_time_wraper">
                {{-- <input id="date" name="date" type="text" class="form-control date-input" <?php if(Request::url() != route($entity['url'].'.create', ['employer_job_id' => $employer_job_id, 'user_id' => $user_id])) {?>  value="{{old('datetime')?? date('Y-m-d', strtotime($interviewtype->datetime)) }}" <?php }?>>
                <input id="time" name="time" type="text" class="form-control time-input w-25" <?php if(Request::url() != route($entity['url'].'.create', ['employer_job_id' => $employer_job_id, 'user_id' => $user_id])) {?>  value="{{old('datetime')?? date('H:i', strtotime($interviewtype->datetime)) }}" <?php }?>> --}}
                <input id="date" name="date" autocomplete="off" type="text" placeholder="Date" class="form-control date-input mr-10 <?php if($errors->has('date')) { echo 'is-invalid'; } ?>" <?php if(Request::url() != route($entity['url'].'.create', ['employer_job_id' => $employer_job_id, 'user_id' => $user_id])) {?>  value="{{old('date')?? date('Y-m-d', strtotime($interviewtype->datetime)) }}" <?php }?>>

                {{-- <input id="date" name="date" autocomplete="off" type="text" placeholder="Date" class="form-control date-input" <?php if(Request::url() != route($entity['url'].'.create', ['employer_job_id' => $employer_job_id, 'user_id' => $user_id])) {?>  value="{{old('date')?? date('Y-m-d', strtotime($interviewtype->datetime)) }}" <?php }?> $errors->has('interview_link') ? 'is-invalid' : '')> --}}

                <input id="time" name="time" type="text" placeholder="Time" class="form-control time-input w-25 <?php if($errors->has('time')) { echo 'is-invalid'; } ?>" <?php if(Request::url() != route($entity['url'].'.create', ['employer_job_id' => $employer_job_id, 'user_id' => $user_id])) {?>  value="{{old('time')?? date('H:i', strtotime($interviewtype->datetime)) }}" <?php }?>>

                <input id="datetime" name="datetime" type="hidden" class="form-control" <?php if(Request::url() != route($entity['url'].'.create', ['employer_job_id' => $employer_job_id, 'user_id' => $user_id])) {?>  value="{{old('datetime')?? date('H:i', strtotime($interviewtype->datetime)) }}" <?php }?>>

            </div>
        </div>


		<div class="col-md-6 col-lg-4 form-group mb-3">
			{!! Form::label('users', trans('label.select_users')) !!}
			<select name="users[]" data-placeholder="Users" multiple>
			 @foreach($users as $value)
					<option value="{{$value->id}}" <?php if(Request::url() != route($entity['url'].'.create', ['employer_job_id' => $employer_job_id, 'user_id' => $user_id])) { ?> <?=(in_array($value->id, $interview_users) ? 'selected="selected"' : '')?> <?php } else if(Request::url() == route($entity['url'].'.create', ['employer_job_id' => $employer_job_id, 'user_id' => $user_id])) { ?> <?= $value->id == $user ? 'selected="selected"' : ''?> <?php }?>>
						{{$value->first_name . ' ' .  $value->last_name}}
					</option>
				@endforeach
			</select>
        </div>
		<!-- Job Description Field -->
        <div class="form-group col-lg-4 mb-3 col-md-6">
            {!! html_entity_decode(Form::label('description', trans('label.description') . '<span style="color: red">*</span>', ['class' => 'required-label'])) !!}

            {{-- {!! Form::label('description', trans('label.description'), ['class' => 'required-label']) !!} --}}
            {!! Form::textarea('description', null, ['rows' => 4,'class' => 'form-control '.
            ($errors->has('description') ?
            'is-invalid' : ''), 'placeholder' =>trans('label.description')]) !!}
            @if ($errors->has('description'))
            <span class="error invalid-feedback">{{ $errors->first('description') }}</span>
            @endif
        </div>

        <hr />
    </div>
</div>
@include('imagecropper.croppermodal')
@section('third_party_scripts')
@include('vendor.image_upload.script')
@include('vendor.richtexteditor.script')
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Pikaday for date selection
      var datepicker = new Pikaday({
        field: document.getElementById('date'),
        format: 'YYYY-MM-DD',
        // Additional options as needed
      });

      // Flatpickr for time selection
      var timepicker = flatpickr('.time-input', {
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        time_24hr: true,
        time_12hr: false,
      });
    });
  </script>
<script>
    var dateField = document.getElementById('date');
    var timeField = document.getElementById('time');

    dateField.addEventListener('change', showAlert);
    timeField.addEventListener('change', showAlert);

    function showAlert() {
        var dateValue = dateField.value;
        var timeValue = timeField.value;

        if (dateValue && timeValue) {
            var datetimeValue = dateValue + ' ' + timeValue;
            // alert('Combined datetime: ' + datetimeValue);
        }
    }
</script>

