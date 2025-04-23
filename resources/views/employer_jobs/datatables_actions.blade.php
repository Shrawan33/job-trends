{!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id"]) !!}
{!! Form::hidden('process', 'delete') !!}

    @hasanyrole('employer|admin')
    @if ($package_access)
        @include('components.front_edit_link', ['class' => 'text-body pr-2 ', 'href_url' => !empty(auth()->user()->activeUserPackage) ?: false, 'entity' => $entity, 'id' => $id, 'text' => trans('label.edit'),'tolltip_text' => 'To use this feature, please activate your package'])

        @include('components.front_clone_link', ['class' => (auth()->user()->activeUserPackage ? 'text-primary' : 'text-body')  .' pr-3', 'href_url' => !empty(auth()->user()->activeUserPackage) ?: false, 'entity' => $entity, 'id' => $id, 'text' => trans('label.clone'),'tolltip_text' => 'To use this feature, please activate your package'])
    @else
        @include('components.front_edit_link', ['class' => 'text-body pr-2 ', 'href_url' => true, 'entity' => $entity, 'id' => $id, 'text' => trans('label.edit'),'tolltip_text' => 'To use this feature, please activate your package'])

        @include('components.front_clone_link', ['class' => 'text-body pr-2', 'href_url' => true, 'entity' => $entity, 'id' => $id, 'text' => trans('label.clone'),'tolltip_text' => 'To use this feature, please activate your package'])
    @endif

        @include('components.front_show_link', ['class' => 'text-danger ', 'entity' => $entity, 'id' => $id,'msg' => 'Do you want to delete this job?'])

        @include('employer_jobs.front_delete_link', ['class' => 'text-danger ', 'entity' => $entity, 'id' => $id,'msg' => 'Do you want to delete this job?'])
    @endhasanyrole



{!! Form::close() !!}

