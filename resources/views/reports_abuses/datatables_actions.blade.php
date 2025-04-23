
@php
if (request()->report_type == 'employerjobs') {
    $text = "Job" ?? '';
    $reportedEntity = FunctionHelper::getEntity('employerJobs');

}
else{
    if (request()->report_type == 'employers') {
        $text = "Employer"?? '';
    }else{
        $text = "Jobseeker" ?? '';
    }
    $reportedEntity = FunctionHelper::getEntity('users');
}

@endphp
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-{{$color}} btn-sm">{{$label}}</button>
        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>

        <div class="dropdown-menu dropdown-menu-right">

            @if (!in_array($state, ['deleted']))

                @include('components.show_ajax_link', ['class' => 'dropdown-item', 'entity' => $entity, 'id' => $id, 'text' => '<i class="fa fa-eye"></i> Show'])
                <div role="separator" class="dropdown-divider"></div>

                {!! Form::open(['route' => ['reportedEntity.active-inactive',['model' =>$reportedEntity['targetModel'] , 'id'=>$model->reported_id]], 'method' => 'delete', 'data-model' => $reportedEntity['targetModel'], 'id' => "{$reportedEntity['targetModel']}_$model->reported_id"]) !!}
                {!! Form::hidden('process', 'delete') !!}

                @include('components.admin.report_abuse_status', ['id' => $model->reported_id, 'entity' => $reportedEntity, 'model' => $model->reported,'text' =>$text])

                {!! Form::close() !!}
                <div role="separator" class="dropdown-divider"></div>
            @endif

            {!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id"]) !!}
            {!! Form::hidden('process', 'delete') !!}

            @include('components.state_ajax_link', ['id' => $model->id, 'entity' => $entity, 'state' => $state])

            {!! Form::close() !!}
        </div>
    </div>



