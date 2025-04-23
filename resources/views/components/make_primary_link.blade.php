{{-- <a class='{!! $class??'' !!}' href="{{ route($entity['url'].'.edit', $id) }}"  title="Edit {!! $entity['singular']??null !!}">
    {!! $text??null !!}
</a> --}}
<a class='{!! $class ?? '' !!}' href="{{ route($entity['url'].'.makePrimary', $id ?? '') }}"  title="Make Primary" data-toggle="tooltip">
    {!! $text ?? null !!}
</a>
