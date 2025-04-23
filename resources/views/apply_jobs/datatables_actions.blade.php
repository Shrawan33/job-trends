
    {!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id"]) !!}
    {!! Form::hidden('process', 'delete') !!}
    @include('apply_jobs.front_delete_link', ['class' => 'text-danger pr-3', 'entity' => $entity, 'id' => $id, 'msg' =>'Do you really want to withdraw application from this job?'])
{!! Form::close() !!}

