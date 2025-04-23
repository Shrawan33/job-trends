
@if (in_array($state, ['deleted']))
    <a class="dropdown-item" href="javascript:submitFormByaction('restore', '{{$entity['targetModel']}}_{{$id}}','{!! trans('message.active_msg',['module'=>$entity['singular']]) !!}')" title="{{trans('label.activate')}} {{$text}}">
        <i class="fas fa-toggle-off text-success"></i> {!! __('label.activate')!!} {{$text}}
    </a>
@endif
@if ($state != 'deleted')
    <a class="dropdown-item" href="javascript:submitFormByaction('delete', '{{$entity['targetModel']}}_{{$id}}', '{!! trans('message.inactive_msg',['module'=>$entity['singular']])!!}')" title="{{trans('label.deactivate')}} {{$text}}">
        <i class="fas fa-toggle-on text-danger"></i> {!! __('label.deactivate') !!} {{$text}}
    </a>
@endif
