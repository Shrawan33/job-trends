@if(isset($prefix) && $prefix == "account")
<a href="#" class="">
    @if(!empty($model->usersProfile) && $model->usersProfile->profilePic)
    <img src="{{ $model->usersProfile->profilePic->presigned_url }}" alt="{{$model->company_name??''}}" class=" mr-2 user-30 rounded-circle img-fluid">
    @else
    <img src="{{ asset('img/Placeholder.svg') }}" alt="no-image" class="mr-2 user-30 rounded-circle img-fluid">
    @endif
    {{$model->company_name??null}}
</a>
@else
<a href="{{route('job-detail.employer.show', $model->slug??'')}}" class="">
    @if(!empty($model->usersProfile) && $model->usersProfile->profilePic)
    <img src="{{ $model->usersProfile->profilePic->presignedthumbnail_url }}" alt="{{$model->company_name??''}}" class=" mr-2 user-30 rounded-circle img-fluid">
    @else
    <img src="{{ asset('img/Placeholder.svg') }}" alt="no-image" class="mr-2 user-30 rounded-circle img-fluid">
    @endif
    {{$model->company_name??null}}
</a>
@endif
@if ($badge_text??false)
<div class="d-flex ml-4">
<span class="badge badge-outline badge-pill badge-metal px-3 ml-3">{{$badge_text??null}}</span>
</div>
@endif
