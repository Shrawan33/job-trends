<a href="{{route('candidates.show',$model->slug??'')}}" class="text-body d-flex">
    @if(!empty($model->seekerDetail) && $model->seekerDetail->profilePic)
    <img src="{{ $model->seekerDetail->profilePic->presignedthumbnail_url }}" alt="{{$model->full_name??''}}" class=" mr-2 user-30 rounded-circle img-fluid">
    @else
    <img src="{{ asset('img/Placeholder.svg') }}" alt="no-image" class="mr-2 user-30 rounded-circle img-fluid">
    @endif
    <p class="mb-0"> {{$model->full_name??null}}<br/>
   <span class="text-secondary d-block js_title">{{$model->seekerDetail->title??''}}</span></p>
</a>
@if ($badge_text??false)
<div class="d-flex ml-4">
    <span class="badge badge-outline badge-pill badge-metal px-3 ml-3">{{$badge_text??null}}</span>
</div>
@endif
