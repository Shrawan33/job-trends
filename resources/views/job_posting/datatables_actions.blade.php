{!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id"]) !!}
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-{{$color}} btn-sm">{{$label}}</button>
        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            @if (Auth::user()->roles->first()->name == 'mentor')
                @if (!in_array($state, ['deleted']))
                    @include('components.edit_link', ['class' => 'dropdown-item', 'entity' => $entity, 'id' => $id, 'text' => '<i class="fa fa-edit"></i> Edit'])
                    @include('components.show_link', ['class' => 'dropdown-item', 'entity' => $entity, 'id' => $id, 'text' => '<i class="fa fa-eye"></i> Show'])
                    @if ($model->approval_status == 0)
                        @include('components.edit_ajax_job_approval', [
                            'class' => 'dropdown-item',
                            'entity' => $entity,
                            'id' => $id,
                            'model' => $model,
                            'status' => 'Approve',
                            'text' => '<i class="fa fa-edit"></i> Approve',
                            'status_id' => 1
                        ])

                        @include('components.edit_ajax_job_approval', [
                            'class' => 'dropdown-item',
                            'entity' => $entity,
                            'id' => $id,
                            'model' => $model,
                            'status' => 'Cancel',
                            'text' => '<i class="fa fa-edit"></i> Cancel',
                            'status_id' => 2
                        ])
                    @elseif ($model->approval_status == 1)
                        @include('components.edit_ajax_job_approval', [
                            'class' => 'dropdown-item',
                            'entity' => $entity,
                            'id' => $id,
                            'model' => $model,
                            'status' => 'Cancel',
                            'text' => '<i class="fa fa-edit"></i> Cancel',
                            'status_id' => 2
                        ])
                    @else
                        @include('components.edit_ajax_job_approval', [
                            'class' => 'dropdown-item',
                            'entity' => $entity,
                            'id' => $id,
                            'model' => $model,
                            'status' => 'Approve',
                            'text' => '<i class="fa fa-edit"></i> Approve',
                            'status_id' => 1
                        ])
                    @endif

                    <div role="separator" class="dropdown-divider"></div>
                @endif
            @else
                @if (!in_array($state, ['deleted']))
                    @include('components.edit_link', ['class' => 'dropdown-item', 'entity' => $entity, 'id' => $id, 'text' => '<i class="fa fa-edit"></i> Edit'])
                    @include('components.show_link', ['class' => 'dropdown-item', 'entity' => $entity, 'id' => $id, 'text' => '<i class="fa fa-eye"></i> Show'])
                    <div role="separator" class="dropdown-divider"></div>

                @endif

                {!! Form::hidden('process', 'delete') !!}
                @include('components.state_ajax_link', ['id' => $id, 'entity' => $entity, 'state' => $state])
            @endif


        </div>
    </div>

    {!! Form::close() !!}
