<span class="text-secondary">
    @if(!empty($model->deleted_at)  && $model->is_deleted == 0)
   {!! __('label.inactive') !!}
   @elseif(!empty($model->deleted_at) && $model->is_deleted == 1)
   {!! __('label.deleted') !!}
   @else
   {!! __('label.active') !!}
   @endif
</span>
