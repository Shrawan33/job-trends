@if ((auth()->user()  && auth()->user()->hasRole('employer')))

<a data-mode="add"  data-modal-size="modal-lg" data-title="{!! __('label.note_title')!!} " data-button_text = "Add"
data-model="candidateNote" data-url="{{ route('candidateNotes.create', ['entity'=>$entity,'id' => $id,]) }}"
href="javascript:void(0)" class="open-form btn btn-primary ml-auto btn-sm ml-md-20"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
    <path d="M10.9999 4.58333V17.4167M4.58325 11H17.4166" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
  </svg> {{__('label.add_candidate_note')}}</a>
@endif
