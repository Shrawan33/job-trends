
@foreach($candidate->candidateNote as $note)
{{-- @dd($note->employer->usersProfile->logo) --}}
    <div class="can-d-progresbar-main-area remark_inner_box py-30">
        <p class="mb-20 note"> {{$note->note ?? ''}}</p>
        <div class="d-flex align-items-center">
            @if(!empty($note->employer->usersProfile->logo) && $note->employer->usersProfile->logo->count())
            @include('vendor.image_upload.display', ['wrapper_class' => 'mr-10 user-90',
            'document_type' =>
            config('constants.document_type.image', 0), 'imageModel' => $note->employer->usersProfile, 'thumbnail' => true])
            @else
            @include('vendor.image_upload.no_image', ['class_li' => 'mr-10'])
            @endif
            <div>
                <p class="company_name mb-0"> {{$note->employer->company_name ?? ''}}</p>
                <p class="date mb-0">{{FunctionHelper::fromSqlDate($note->created_at->toDateString(), true, true) ?? ''}}</p>
            </div>
        </div>
    </div>
@endforeach

