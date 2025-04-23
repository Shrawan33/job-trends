@hasanyrole('employer|jobseeker')
    @if(isset($entityData->favouritJob) &&  $entityData->favouritJob->count() >=0 )
    {{-- <a href="{{ route('favoriteJobs.removeFromFavourit',$id) }}" data-toggle="tooltip" title="{!!__('label.remove_job_title') !!}" class="{{$class_a??'social_btn'}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="#1934BD">
            <path d="M13.4253 1.5C16.3605 1.5 18.3327 4.29375 18.3327 6.9C18.3327 12.1781 10.1475 16.5 9.99935 16.5C9.8512 16.5 1.66602 12.1781 1.66602 6.9C1.66602 4.29375 3.63824 1.5 6.57342 1.5C8.25861 1.5 9.36046 2.35312 9.99935 3.10312C10.6382 2.35312 11.7401 1.5 13.4253 1.5Z" stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a> --}}
    <a id="directFavorite_{{ $id }}" href="javascript:void(0)" class="{{$class_a??'social_btn'}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="#357de8">
            <path d="M15.1111 1C18.6333 1 21 4.3525 21 7.48C21 13.8138 11.1778 19 11 19C10.8222 19 1 13.8138 1 7.48C1 4.3525 3.36667 1 6.88889 1C8.91111 1 10.2333 2.02375 11 2.92375C11.7667 2.02375 13.0889 1 15.1111 1Z" stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </a>
    <script>
        $('#directFavorite_{{ $id }}').on('click', function(e) {
            processAjaxOperation("{{ route('favoriteJobs.removeFromFavouritAjax', $id) }}", 'GET', 'applicaion/json')
        })
    </script>
    @else
    <a id="directFavorite_{{ $id }}" href="javascript:void(0)" class="{{$class_a??'social_btn'}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18" fill="none">
            <path d="M13.4253 1.5C16.3605 1.5 18.3327 4.29375 18.3327 6.9C18.3327 12.1781 10.1475 16.5 9.99935 16.5C9.8512 16.5 1.66602 12.1781 1.66602 6.9C1.66602 4.29375 3.63824 1.5 6.57342 1.5C8.25861 1.5 9.36046 2.35312 9.99935 3.10312C10.6382 2.35312 11.7401 1.5 13.4253 1.5Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
    {{-- <a class="btn btn-primary btn-w-sm" href="javascript:void(0)" id="directApplyNow_{{ $id }}">{!! __('label.apply_btn') !!}</a> --}}

            <script>
                $('#directFavorite_{{ $id }}').on('click', function(e) {
                    //e.preventDefault()

                    processAjaxOperation("{{ route('favoriteJobs.storeAjax', $id) }}", 'GET', 'applicaion/json')
                })
            </script>


    @endif
@endrole

