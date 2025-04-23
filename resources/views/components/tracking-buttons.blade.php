
<ul class="list-inline mb-0">
    <li class="list-inline-item"><a href="" class="btn btn-link p-0"><i class="fi fi flaticon-tasks h2 mb-0 text-primary"></i></a></li>
    <li class="list-inline-item"><a class="btn btn-md btn-outline-primary btn-circle rounded-circle" href=""><i
                class="fi flaticon-heart"></i></a></li>
   <li class="list-inline-item"><a class="open-form btn btn-sm btn-outline-primary rounded-pill" data-mode="create"
            data-modal-size="modal-lg" data-title="Change Status" data-model="applicationTracking"
            data-url="{{ route('applicationTrackings.actions',$jobSeeker->id) }}" href="javascript:void(0)">{{trans('label.action')}}</a>
    </li>
    <li class="list-inline-item"><a class="open-form btn btn-sm  font-weight-medium btn-primary rounded-pill" data-mode="create"
            data-modal-size="modal-lg" data-title="Send message to {{$jobSeeker->full_name}}"
            data-model="applicationTracking" data-url="{{ route('send.messageForm',$jobSeeker->id) }}"
            href="javascript:void(0)">{{trans('label.send_msg')}}</a></li>
    <li class="list-inline-item">
    @include('components.candidate_buttons.favourit', ['model' => Auth::user()])
    </li>
    <li class="list-inline-item">
    @include('components.send_message', ['model' => Auth::user()])
    </li>


</ul>
