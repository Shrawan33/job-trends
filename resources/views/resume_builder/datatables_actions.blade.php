{!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id"]) !!}
    {!! Form::hidden('process', 'delete') !!}
    <div class="btn-group" role="group">
        @if (!in_array($state, ['deleted']))
                @include('components.edit_step_link', ['class' => 'text-body pr-3 ', 'entity' => $entity, 'id' => $id, 'text' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M13.9818 7.43286L10.5672 4.0182M0.75 17.25L3.63911 16.929C3.99209 16.8898 4.16859 16.8702 4.33355 16.8168C4.47991 16.7694 4.61919 16.7024 4.74761 16.6177C4.89236 16.5223 5.01793 16.3967 5.26906 16.1456L16.5428 4.87186C17.4857 3.92893 17.4857 2.40013 16.5428 1.4572C15.5999 0.514268 14.0711 0.514267 13.1281 1.4572L1.85441 12.7309C1.60328 12.9821 1.47771 13.1076 1.38226 13.2524C1.29757 13.3808 1.23063 13.5201 1.18325 13.6664C1.12984 13.8314 1.11023 14.0079 1.07101 14.3609L0.75 17.25Z" stroke="#1B2432" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'])
            {{-- @if ($model->primary_account == 0)
                @include('components.make_primary_link', ['class' => 'text-body pr-3 ', 'entity' => $entity, 'id' => $id, 'text' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.24992 16.8447C2.45353 15.4095 2 13.7576 2 11.9999C2 6.47705 6.47718 1.99987 12 1.99987" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/><path d="M20.7273 7.11477C21.5377 8.55942 21.9998 10.2258 21.9998 12C21.9998 17.5229 17.5226 22 11.9998 22C9.23834 22 6.73834 20.8807 4.92871 19.0711" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/><path d="M12 1.99975C14.7615 1.99975 17.2615 3.11904 19.0711 4.92871" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round"/><path d="M5.31427 21.5054L4.92871 19.0711L7.36298 18.6856" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M18.6854 2.49466L19.071 4.92893L16.6367 5.31445" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 16.5C16 15.8216 16 15.4824 15.9139 15.2064C15.72 14.5849 15.2198 14.0986 14.5806 13.9101C14.2967 13.8264 13.9478 13.8264 13.25 13.8264H10.75C10.0522 13.8264 9.70333 13.8264 9.41943 13.9101C8.78023 14.0986 8.28002 14.5849 8.08612 15.2064C8 15.4824 8 15.8216 8 16.5M14.25 8.6875C14.25 9.89562 13.2426 10.875 12 10.875C10.7574 10.875 9.75 9.89562 9.75 8.6875C9.75 7.47938 10.7574 6.5 12 6.5C13.2426 6.5 14.25 7.47938 14.25 8.6875Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'])
            @endif --}}

            <a href="{{ route('download-resume', $model->id) }}" target="_blank" class="text-body" title="{!!__('label.download_resume') !!}" data-toggle="tooltip">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18" fill="none">
                    <path
                        d="M17.25 11.75V12.85C17.25 14.3901 17.25 15.1602 16.9503 15.7485C16.6866 16.2659 16.2659 16.6866 15.7485 16.9503C15.1602 17.25 14.3901 17.25 12.85 17.25H5.15C3.60986 17.25 2.83978 17.25 2.25153 16.9503C1.73408 16.6866 1.31338 16.2659 1.04973 15.7485C0.75 15.1602 0.75 14.3901 0.75 12.85V11.75M13.5833 7.16667L9 11.75M9 11.75L4.41667 7.16667M9 11.75V0.75"
                        stroke="black" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </a>
            <div role="separator" class="dropdown-divider"></div>
        @endif
    </div>
{!! Form::close() !!}

