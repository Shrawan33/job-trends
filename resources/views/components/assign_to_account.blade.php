<a class="open-form {!! $class??'' !!}" href="javascript:void(0)" data-mode="edit" data-title="Assign Account Manager # {!! $id !!}"
    data-model="{!! $entity['targetModel']??null !!}" data-url="{!! route($entity['url'].'.assign-to-employer-form', $id) !!}" title="Show {!! $entity['singular']??null !!}">
    {!! $text !!}
</a>
