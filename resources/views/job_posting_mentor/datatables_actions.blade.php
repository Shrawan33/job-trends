{!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id"]) !!}
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-{{$color}} btn-sm">{{$label}}</button>
        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            @if (!in_array($state, ['deleted']))
                @include('components.edit_link', ['class' => 'dropdown-item', 'entity' => $entity, 'id' => $id, 'text' => '<i class="fa fa-edit"></i> Edit'])
                @include('components.show_link', ['class' => 'dropdown-item', 'entity' => $entity, 'id' => $id, 'text' => '<i class="fa fa-eye"></i> Show'])
                <div role="separator" class="dropdown-divider"></div>

            @endif

                {!! Form::hidden('process', 'delete') !!}
                @include('components.state_ajax_link', ['id' => $id, 'entity' => $entity, 'state' => $state])

        </div>
    </div>

    {!! Form::close() !!}
