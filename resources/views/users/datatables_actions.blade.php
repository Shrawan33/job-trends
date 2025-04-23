{!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id"]) !!}
    {!! Form::hidden('process', 'delete') !!}
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-{{$color}} btn-sm">{{$label}}</button>
        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            @if (!in_array($state, ['deleted']))
                @include('components.edit_ajax_link', ['class' => 'dropdown-item', 'entity' => $entity, 'id' => $id, 'text' => '<i class="fa fa-edit"></i> Edit'])
                @include('components.show_ajax_link', ['class' => 'dropdown-item', 'entity' => $entity, 'id' => $id, 'text' => '<i class="fa fa-eye"></i> Show'])
                @if($model->hasRole('employer'))
                @include('components.assign_to_account', ['class' => 'dropdown-item', 'entity' => $entity, 'id' => $id, 'text' => '<i class="fa fa-tasks"></i> Assign Account Manager'])
                @endif
                <div role="separator" class="dropdown-divider"></div>
            @endif

            @if ($model->email_verified_at == null)
                <a href="{{ route('users.verified', $model->id) }}" class="dropdown-item"> <i class="fa fa-check"
                        style="color:#32cd32;"></i> Make Verified</a>
                {{-- @else
						<a href="{{route('users.unverified', $model->id)}}" class="dropdown-item"> <i class="fa fa-times" style="color:red;"></i> Make Unverified</a> --}}
            @endif

            <a href="{{ route('users.loginbyid', $model->id) }}" class="dropdown-item"> <i class="fa fa-check"
                style="color:#32cd32;"></i> Login As Users</a>

            @include('components.state_ajax_link', ['id' => $id, 'entity' => $entity, 'state' => $state])
        </div>
    </div>
{!! Form::close() !!}

