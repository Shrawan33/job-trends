@if($model->remarks && $model->remarks->count() > 0)
    <a class="open-form remark-text view-remark" data-mode="edit" data-modal-size="modal-lg" data-title="Remarks for {{$model->user->full_name}}"
    data-model="remark"  data-url="{{ route('remark-create',$model->id) }}"
    href="javascript:void(0)">{{__('label.view_remark')}}</a>
@else
    <a class="open-form remark-text add-remark" data-mode="edit" data-modal-size="modal-lg" data-title="Remarks for {{$model->user->full_name}}"
    data-model="remark"  data-url="{{ route('remark-create',$model->id) }}"
    href="javascript:void(0)" id="">{{__('label.add_remark')}}</a>
@endif

