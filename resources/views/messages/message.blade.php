<div class="">
    <div class="thread_msg_wraper">
        <h4 class="mb-3">{!! $msg_type == 2 ? trans('message.message_sent_to') : trans('message.message_sent_from')!!}</h4>
        <div class="d-flex align-items-center">
            @if($user->hasRole('employer') && !empty($user->usersProfile) && $user->usersProfile->profilePic)
            <img src="{{ $user->usersProfile->profilePic->presigned_url }}" alt="{{$user->company_name??''}}" class=" mr-2 user-30 rounded-circle img-fluid">
            @elseif(!empty($user->seekerDetail) && $user->seekerDetail->profilePic)
            <img src="{{ $user->seekerDetail->profilePic->presigned_url }}" alt="{{$user->full_name??''}}" class=" mr-2 user-30 rounded-circle img-fluid">
            @else
            <img src="{{ asset('img/user-pp-placeholder.png') }}" alt="no-image" class="mr-2 user-30 rounded-circle img-fluid">
            @endif
            <h4 class="mb-0"> {{$user->hasRole('employer') ? $user->company_name : $user->full_name}}</h4>
        </div>
    </div>
    <div class="row d-flex p-4">
        @foreach($messages as $key => $message)
        <div class="col-sm-12 border-top border-dark p-3">
            <label>{!!FunctionHelper::fromSqlDateTime($message->created_at->toDateTimeString(),true,'')!!}</label>
            <h6>{{ $message->data['message']??''}}</h6>
        </div>
        @endforeach
    </div>
</div>
