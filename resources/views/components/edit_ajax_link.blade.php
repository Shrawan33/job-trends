<a class='open-form {!! $class??'' !!}' href="javascript:void(0)" data-mode="edit"
    data-title="{!! $entity['singular']??null !!} # {{$id}}" data-model="{!! $entity['targetModel']??null !!}"
    data-url="{{ route($entity['url'].'.edit', $id) }}" title="Edit {!! $entity['singular']??null !!}">
    {!! $text??null !!}
</a>
