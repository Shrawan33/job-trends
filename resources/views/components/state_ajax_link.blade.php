@if (in_array($state, ['archived', 'deleted']))
    <a class="dropdown-item" href="javascript:submitFormByaction('restore', '{{$entity['targetModel']}}_{{$id}}', '{!! trans('message.active_msg',['module'=>$entity['singular']])!!}')" title="{{trans('label.activate')}} {{$entity['singular']}}">
        <i class="fa fa-recycle"></i> {!! __('label.activate') !!}
    </a>
@else
    <a class="dropdown-item" href="javascript:submitFormByaction('archive', '{{$entity['targetModel']}}_{{$id}}', '{!! trans('message.inactive_msg',['module'=>$entity['singular']])!!}')" title="{{trans('label.deactivate')}} {{$entity['singular']}}">
        <i class="fa fa-archive"></i> {!! __('label.deactivate') !!}
    </a>
@endif
@if ($state != 'deleted')
    <a class="dropdown-item" href="javascript:submitFormByaction('delete', '{{$entity['targetModel']}}_{{$id}}', '{!! trans('message.delete_msg',['module'=>$entity['singular']])!!}')" title="{{trans('label.delete')}} {{$entity['singular']}}">
        <i class="fa fa-trash"></i> {!! __('label.delete') !!}
    </a>
@endif
