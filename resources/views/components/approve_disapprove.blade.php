<a class="{!! $class??'' !!}" href="#" onclick="event.preventDefault(); document.getElementById('{{ $action }}Form{{$id}}').submit();" title="{{ ucfirst($action) }} {!! $entity['singular']??null !!}">
    {!! $text !!}
</a>
<form id="{{ $action }}Form{{$id}}" action="{{ route($action.'Review') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="id" value="{{$id}}">
</form>
