<a class='open-form {!! $class??'' !!}' href="javascript:void(0)" data-requestdata="status={!! $status_id !!}" data-mode="edit"
    data-title="{!! $status !!} Job # {{$id}}" data-model="{!! $entity['targetModel']??null !!}"
    data-url="{{ route($entity['url'].'.edit-job-approval', $id) }}" title="Edit {!! $entity['singular']??null !!}">
    {!! $text??null !!}
</a>
