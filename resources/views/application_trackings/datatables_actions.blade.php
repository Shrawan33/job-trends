<div class="list-inline-item" id="favourite_action_{{$model->user->id}}">
    @include('components.candidate_buttons.favourit', ['model' => $model->user,'class_fav_btn' => ' btn-md'])
</div>
<div class="list-inline-item">
    @include('components.send_message', ['model' => $model->user, 'class_fav_btn' => ' btn-md'])
</div>
<div class="list-inline-item">
    <a class="social_btn" href="{{ route('interviewschedules.create', ['employer_job_id' => $model->employer_job_id, 'user_id' => $model->user_id]) }}" title="Interview Setup" data-toggle="tooltip" >
        <svg xmlns="http://www.w3.org/2000/svg" class="mr-0" width="17" height="18" viewBox="0 0 17 18" fill="none">
          <path d="M1.6665 10.7778C1.6665 10.3063 1.8538 9.8541 2.1872 9.5207C2.5206 9.1873 2.97279 9 3.44428 9C3.91578 9 4.36796 9.1873 4.70136 9.5207C5.03476 9.8541 5.22206 10.3063 5.22206 10.7778V12.5556C5.22206 13.0271 5.03476 13.4792 4.70136 13.8126C4.36796 14.146 3.91578 14.3333 3.44428 14.3333C2.97279 14.3333 2.5206 14.146 2.1872 13.8126C1.8538 13.4792 1.6665 13.0271 1.6665 12.5556V10.7778ZM1.6665 10.7778V8.11111C1.6665 6.22513 2.41571 4.41639 3.7493 3.0828C5.08289 1.7492 6.89163 1 8.77762 1C10.6636 1 12.4723 1.7492 13.8059 3.0828C15.1395 4.41639 15.8887 6.22513 15.8887 8.11111V10.7778M15.8887 10.7778C15.8887 10.3063 15.7014 9.8541 15.368 9.5207C15.0346 9.1873 14.5824 9 14.1109 9C13.6395 9 13.1873 9.1873 12.8539 9.5207C12.5205 9.8541 12.3332 10.3063 12.3332 10.7778V12.5556C12.3332 13.0271 12.5205 13.4792 12.8539 13.8126C13.1873 14.146 13.6395 14.3333 14.1109 14.3333M15.8887 10.7778V12.5556C15.8887 13.0271 15.7014 13.4792 15.368 13.8126C15.0346 14.146 14.5824 14.3333 14.1109 14.3333M14.1109 14.3333C14.1109 15.0409 13.5492 15.7191 12.5492 16.2187C11.5483 16.7191 10.191 17 8.77763 17" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
</div>
<div class="list-inline-item"  data-toggle="tooltip" data-placement="top" title="{!! __('label.view_answer')!!}">
    @include('components.question_btn', ['model' => $model,'class_fav_btn' => ' btn-md'])
</div>
