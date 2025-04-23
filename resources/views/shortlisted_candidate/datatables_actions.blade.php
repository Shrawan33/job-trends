{!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' =>
$entity['targetModel'], 'id' => "{$entity['targetModel']}_$id",'class'=>'delete_frm']) !!}
{!! Form::hidden('process', 'delete') !!}
<div class="list-inline-item text-center d-flex align-items-center">
    {{-- <div class="mr-1"> @include('components.job_post',['model' => $model, 'class' => 'social_btn','user' =>
        $model->user??''])
    </div> --}}
    <div class="mr-1">
        @include('components.send_message', [ 'class_sendmail_btn' => '','notBtn' => true,'class_sendmailmobile_btn' =>
        '','model' => $model->user,'text' => '<i class="fi flaticon-send"></i>'])
    </div>
    <div class="ml-2">
        @include('shortlisted_candidate.front_delete_link', ['class' => '', 'entity' => $entity, 'id' => $id,'msg' =>'Do you want to delete this candidate?'])

        {{-- @include('components.front_delete_link', ['class' => '', 'entity' => $entity, 'id' => $id,'msg' =>'Do you want to delete this candidate?']) --}}
    </div>
</div>
{!! Form::close() !!}
