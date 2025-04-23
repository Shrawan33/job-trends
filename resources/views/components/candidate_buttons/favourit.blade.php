{{--
@if(!empty($model->favourite))
<a href="javascript:void(0);" data-url="{{ route('candidates.favourit.remove',$model->id) }}"
    data-model="" @if($from??null) data-request='{"from":"{{$from}}"}' @endif
    data-toggle="tooltip" data-placement="top" title="{!! __('label.remove_favourite')!!}"
    class="social_btn ajax-operation {{$class_unfav_btn??''}} ">
    <svg class="saved" xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
        <path d="M12.6545 0.222168C15.7854 0.222168 17.8891 3.11939 17.8891 5.82217C17.8891 11.2958 9.15824 15.7777 9.00022 15.7777C8.84219 15.7777 0.111328 11.2958 0.111328 5.82217C0.111328 3.11939 2.21503 0.222168 5.3459 0.222168C7.14343 0.222168 8.31874 1.10689 9.00022 1.88467C9.6817 1.10689 10.857 0.222168 12.6545 0.222168Z" fill="#1934BD"></path>
    </svg>
</a>
@else
<a href="javascript:void(0);" data-url="{{ route('candidates.favourit',$model->id) }}"
    data-model="" @if($from??null) data-request='{"from":"{{$from}}"}' @endif
    data-toggle="tooltip" data-placement="top" title="{!! __('label.save_as_favourite')!!}"
    class="social_btn ajax-operation {{$class_fav_btn??' '}} ">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
        <path d="M13.4253 1.5C16.3605 1.5 18.3327 4.29375 18.3327 6.9C18.3327 12.1781 10.1475 16.5 9.99935 16.5C9.8512 16.5 1.66602 12.1781 1.66602 6.9C1.66602 4.29375 3.63824 1.5 6.57342 1.5C8.25861 1.5 9.36046 2.35312 9.99935 3.10312C10.6382 2.35312 11.7401 1.5 13.4253 1.5Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>
@endif --}}
@if(!empty($model->favourite))
<a href="javascript:void(0);" data-url="{{ route('candidates.favourit.remove',$model->id) }}"
    data-model="" @if($from??null) data-request='{"from":"{{$from}}"}' @endif
    data-toggle="tooltip" data-placement="top" title="{!! __('label.remove_favourite')!!}"
    class="social_btn ajax-operation {{$class_unfav_btn??''}} ">
    <svg class="saved" xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">
        <path d="M12.6545 0.222168C15.7854 0.222168 17.8891 3.11939 17.8891 5.82217C17.8891 11.2958 9.15824 15.7777 9.00022 15.7777C8.84219 15.7777 0.111328 11.2958 0.111328 5.82217C0.111328 3.11939 2.21503 0.222168 5.3459 0.222168C7.14343 0.222168 8.31874 1.10689 9.00022 1.88467C9.6817 1.10689 10.857 0.222168 12.6545 0.222168Z" fill="#357de8"></path>
    </svg>
</a>
@else
<a href="javascript:void(0);" data-url="{{ route('candidates.favourit',$model->id) }}"
    data-model="" @if($from??null) data-request='{"from":"{{$from}}"}' @endif
    data-toggle="tooltip" data-placement="top" title="{!! __('label.save_as_favourite')!!}"
    class="social_btn ajax-operation {{$class_fav_btn??' '}} ">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
        <path d="M13.4253 1.5C16.3605 1.5 18.3327 4.29375 18.3327 6.9C18.3327 12.1781 10.1475 16.5 9.99935 16.5C9.8512 16.5 1.66602 12.1781 1.66602 6.9C1.66602 4.29375 3.63824 1.5 6.57342 1.5C8.25861 1.5 9.36046 2.35312 9.99935 3.10312C10.6382 2.35312 11.7401 1.5 13.4253 1.5Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>
@endif
