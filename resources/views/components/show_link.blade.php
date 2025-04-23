@if(isset($entity['singular']))
    <a class="{!! $class??'' !!}" href="{!! $url ?? route($entity['url'].'.show', $id) !!}" title="Show {!! $entity['singular']??null !!}" @if(isset($target)) target="{!! $target??null !!}" @endif>
        {!! $text !!}
    </a>
@else
    <a class="{!! $class??'' !!}" href="{!! $url ?? route($entity.'.show', $id) !!}" title="Show {!! $entity??null !!}">
        {!! $text !!}
    </a>
@endif

