@hasanyrole('employer|jobseeker')
    @if(isset($entityData->favouritJob) &&  $entityData->favouritJob->count() >=0 )
    <a href="{{ route('favoriteJobs.removeFromFavourit',$id) }}" data-toggle="tooltip" title="{!!__('label.remove_job_title') !!}" class="{{$class_a??'social_btn'}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="#357de8">
            <path d="M15.1111 1C18.6333 1 21 4.3525 21 7.48C21 13.8138 11.1778 19 11 19C10.8222 19 1 13.8138 1 7.48C1 4.3525 3.36667 1 6.88889 1C8.91111 1 10.2333 2.02375 11 2.92375C11.7667 2.02375 13.0889 1 15.1111 1Z" stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
    @else
    <a href="{{ route('favoriteJobs.store',$id) }}" data-toggle="tooltip" title="{!!__('label.save_job_title')!!}" class="{{$class_a??'social_btn'}}">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
            <path d="M15.1111 1C18.6333 1 21 4.3525 21 7.48C21 13.8138 11.1778 19 11 19C10.8222 19 1 13.8138 1 7.48C1 4.3525 3.36667 1 6.88889 1C8.91111 1 10.2333 2.02375 11 2.92375C11.7667 2.02375 13.0889 1 15.1111 1Z" stroke="#717884" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
    @endif
@endrole
 
