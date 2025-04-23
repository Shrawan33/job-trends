{{-- <a class='{!! $class??'' !!}' href="{{ route($entity['url'].'.edit', $id) }}"  title="Edit {!! $entity['singular']??null !!}">
    {!! $text??null !!}
</a> --}}
<a class='{!! $class ?? '' !!}' href="{{ route($entity['url'].'.editStep', ['userId' => $id, 'step' => $model->step + 1]) }}"  title="Edit {!! $entity['singular'] ?? null !!}" data-toggle="tooltip" title="Edit">
    {!! $text ?? null !!}
</a>
