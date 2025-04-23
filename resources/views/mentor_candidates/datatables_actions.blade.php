
<a class="open-form btn btn-primary" href="javascript:void(0)" data-mode="edit" data-title="{!! $model->hasRole('employer') ? $model->company_name : $text = $model->full_name  !!} Score"
data-model="mentor_candidate" data-url="{!! route($entity['targetModel'].'.score', $id) !!}" title="{!! $model->hasRole('employer') ? $model->company_name : $text = $model->full_name  !!} Score">
Score
</a>
