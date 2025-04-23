{!! Form::open(['route' => ['roles.update-destroy', $id], 'method' => 'delete', 'data-model' => 'role', 'id' => "role_$id"]) !!}
    {!! Form::hidden('process', 'delete') !!}
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-{{$color}} btn-sm">{{$label}}</button>
        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            @if (!in_array($state, ['deleted']))
                <a class="dropdown-item" href="{{ route('roles.edit', $id) }}" title="{{trans('label.edit')}}">
                    <i class="fa fa-edit"></i> {{trans('label.edit')}}
                </a>
                <a class="dropdown-item" href="{{ route('roles.show', $id) }}" title="{{trans('label.show')}}">
                    <i class="fa fa-eye"></i> {{trans('label.show')}}
                </a>
                <div role="separator" class="dropdown-divider"></div>
            @endif
            @if (in_array($state, ['archived', 'deleted']))
                <a class="dropdown-item" href="javascript:submitFormByaction('restore', 'role_{{$id}}')" title="{{trans('label.restore')}}">
                    <i class="fa fa-recycle"></i> {{trans('label.restore')}}
                </a>
            @else
                <a class="dropdown-item" href="javascript:submitFormByaction('archive', 'role_{{$id}}')" title="{{trans('label.archive')}}">
                    <i class="fa fa-archive"></i> {{trans('label.archive')}}
                </a>
            @endif
            @if ($state != 'deleted')
                <a class="dropdown-item" href="javascript:submitFormByaction('delete', 'role_{{$id}}')" title="{{trans('label.delete')}}">
                    <i class="fa fa-trash"></i> {{trans('label.delete')}}
                </a>
            @endif
        </div>
    </div>
{!! Form::close() !!}
