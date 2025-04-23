<ul class="list-inline d-flex justify-content-between mb-0">
    {{-- @if($from != "candidate-list")
        <li class="list-inline-item">@include('components.report_button',['entity' => 'candidate','entityData' => $model, 'id' =>$model->id])</li>
    @endif --}}
    <li class="list-inline-item" id="favourite_action_{{$model->id}}">@include('components.candidate_buttons.favourit', ['from' => $from??'detail-page', 'class_fav_btn' => ($from == 'detail-page')?'btn-lg':'btn-md', 'class_unfav_btn' => ($from == 'detail-page')?'btn-lg':'btn-md'])</li>
    {{-- @if($from != "candidate-list")
    <li class="list-inline-item">@include('components.share-job-buttons', ['id'=>$model->id,'entityData' =>$model??[]])</li>
    @endif --}}
    {{-- <li class="list-inline-item">@include('components.send_message')</li> --}}
</ul>

