{!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id",'class'=>'delete_frm']) !!}
{!! Form::hidden('process', 'delete') !!}

@include('components.front_delete_link', ['class' => 'text-danger pr-3', 'entity' => $entity, 'id' => $id,'msg' =>'Do you really want to remove this Job Alert?'])
{!! Form::close() !!}

