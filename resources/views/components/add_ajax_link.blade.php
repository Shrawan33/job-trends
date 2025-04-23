@php
    if($entity['singular'] == "Cm"){
        $entity['singular'] = "CMS";
    }
@endphp
<a class="open-form {!! $class??'' !!}" data-mode="create" data-title="{!! $entity['singular']??null !!}"
    data-model="{!! $entity['targetModel']??null !!}" data-url="{{ route($entity['url'].'.create') }}"
    href="javascript:void(0)">{!!$text??null!!}</a>
