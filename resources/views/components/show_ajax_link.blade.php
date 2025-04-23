
@if(isset($entity['singular']))
@php
if($entity['singular'] == "Cm"){
    $entity['singular'] = "CMS";
}
@endphp
<a class="open-form {!! $class??'' !!}" href="javascript:void(0)" data-mode="show" data-title="{!! $entity['singular']??null !!} # {!! $id !!}"
    data-model="{!! $entity['targetModel']??null !!}" data-url="{!! route($entity['url'].'.show', $id) !!}" title="Show {!! $entity['singular']??null !!}">
    {!! $text !!}
</a>
@else
<a class="open-form {!! $class??'' !!}" href="javascript:void(0)" data-mode="show" data-title="{!! $entity??null !!} # {!! $id !!}"
data-model="{!! $targetModel??null !!}" data-url="{!! route($entity.'.show', $id) !!}" title="Show {!! $entity??null !!}">
{!! $text !!}
</a>
@endif
