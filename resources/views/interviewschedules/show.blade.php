<div class="">
    <div class="row">
        <!-- Title Field -->
        <div class="col-md-12 form-group mb-3">
            <strong>{{trans('label.title')}}:</strong>
            {{$interview_schedule->title}}
        </div>
        <div class="col-md-12 form-group mb-3">
            <strong>{{trans('label.interview_link')}}:</strong>
            <a href="{{$interview_schedule->interview_link}}" target="_blank">{{$interview_schedule->interview_link}}</a>
        </div>
        <div class="col-md-12 form-group mb-3">
            <strong>{{trans('label.date&time')}}:</strong>
            {{date("M d, Y g:i A", strtotime($interview_schedule->datetime))}}
        </div>
        <div class="col-md-12 form-group mb-3">
            <strong>{{trans('label.applicants')}}:</strong>
            {{$users}}
        </div>
        <div class="col-md-12 form-group mb-3">
            <strong>{{trans('label.description')}}:</strong>
            {!! $interview_schedule->description !!}
        </div>
    </div>
</div>
