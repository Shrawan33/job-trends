<video width="{{$width??320}}" height="{{$height??240}}" controls>
    <source src="{{$video->presigned_url}}" type="{{$video->mime_type}}">
    {!! trans('label.does_not_support_video')!!}
</video>
