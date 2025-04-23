@auth
    @role('jobseeker')
        @if (auth()->user()->hide_profile == 1)
            <a href="javascript:void(0)" data-toggle="tooltip" title="{{ trans('label.is_hide_profile_label') }}"
                class="btn btn-primary px-2">{!! __('label.apply_btn') !!}</a>
        @else
            @if (isset($entityData->appliedJob) && $entityData->appliedJob->count() >= 0)

                <a class="disabled btn btn-outline-success btn-sm" href="javascript:void(0)" title="{!! __('label.already_apply_title') !!}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="12" viewBox="0 0 20 12" fill="none">
                        <path
                            d="M0.833984 6.00033L5.41732 10.5837M10.0007 6.00033L14.584 1.41699M5.41732 6.00033L10.0007 10.5837L19.1673 1.41699"
                            stroke="#36951E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    {!! __('label.applied_btn') !!}</a>
                    {{-- <script>
                        window.onload = function() {
                            window.location.href = "{{ route('thank_you') }}";
                        };
                    </script> --}}
            @else
                @if (isset($entityData->questionnaire) && $entityData->questionnaire->count() > 0)
                    <a class="open-form btn btn-primary btn-sm" data-mode="edit" data-modal-size="modal-lg"
                        data-title="{!! __('label.apply_title') !!}" data-model="applyJob"
                        data-url="{{ route('applyJobs.create', $id) }}" href="javascript:void(0)">{!! __('label.apply_btn') !!}</a>
                @else
                    <a class="btn btn-primary btn-sm" href="javascript:void(0)"
                        id="directApplyNow_{{ $id }}">{!! __('label.apply_btn') !!}</a>
                    @push('page_scripts')
                        {{-- <script>
                            $('#directApplyNow_{{ $id }}').on('click', function(e) {
                                e.preventDefault()
                                var $data = JSON.stringify({
                                    user_id: {{ auth()->user()->id ?? 0 }}
                                });
                                processAjaxOperation("{{ route('applyJobs.save', $id) }}", 'POST', $data, 'applicaion/json');
                                window.location.href = "{{ route('applyJobs.thank_you') }}";
                            })
                        </script> --}}
                        <script>
                            $('#directApplyNow_{{ $id }}').on('click', function(e) {
                                e.preventDefault();
                                var $data = JSON.stringify({
                                    user_id: {{ auth()->user()->id ?? 0 }}
                                });
                                processAjaxOperation("{{ route('applyJobs.save', $id) }}", 'POST', $data, 'applicaion/json');
                                // processAjaxOperation("{{ route('thank_you', $id) }}", 'POST', $data, 'applicaion/json');
                            });
                        </script>
                    @endpush
                @endif
            @endif
        @endif
    @endrole
@else
    <a class="btn btn-primary px-2 btn-sm btn-w-sm" href="{{ route('login') }}">{!! __('label.apply_btn') !!}</a>
@endauth
