<!-- Event Image Field -->
<div class="form-group col-sm-12">
    @include('vendor.image_upload.display', [
        'wrapper_class' => 'img-fluid user-90',
        'document_type' => config('constants.document_type.image', 0),
        'imageModel' => $event,
    ])
</div>
<!-- Event Title Field -->
<div class="col-sm-12">
    {!! Form::label('event_title', 'Event Title:') !!}
    <p>{{ $event->event_title }}</p>
</div>

<!-- Event Description Field -->
<div class="col-sm-12">
    {!! Form::label('event_description', 'Event Description:') !!}
    <p>{!! $event->event_description !!}</p>
</div>

<!-- Event Date Field -->
<div class="col-sm-12">
    {!! Form::label('event_date', 'Event Date:') !!}
    <p> {{ $event->event_date->format('d M Y • h:i A') }}</p>
</div>

