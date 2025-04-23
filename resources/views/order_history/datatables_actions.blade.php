


    {!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id"]) !!}
    {!! Form::hidden('process', 'delete') !!}
    <div class="btn-group link_type_btn" role="group">

        <button type="button" class="dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <svg width=25 height=25 fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M13.32 18.48a1.8 1.8 0 1 1-3.6 0 1.8 1.8 0 0 1 3.6 0Zm0-6a1.8 1.8 0 1 1-3.6 0 1.8 1.8 0 0 1 3.6 0Zm0-6a1.8 1.8 0 1 1-3.6 0 1.8 1.8 0 0 1 3.6 0Z" />
            </svg>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            @if (!in_array($state, ['deleted']))
                <a class="dropdown-item px-3" href="{!! route('order.detail', $model->order_number) !!}" title="Show Job">
                    <svg class="mr-2" width="18" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.21845 11.6538C2.09361 11.4561 2.03119 11.3573 1.99625 11.2048C1.97 11.0903 1.97 10.9097 1.99625 10.7952C2.03119 10.6428 2.09361 10.5439 2.21845 10.3463C3.25007 8.71278 6.32078 4.58334 11.0004 4.58334C15.68 4.58334 18.7507 8.71278 19.7823 10.3463C19.9071 10.5439 19.9695 10.6428 20.0045 10.7952C20.0307 10.9097 20.0307 11.0903 20.0045 11.2048C19.9695 11.3573 19.9071 11.4561 19.7823 11.6538C18.7507 13.2872 15.68 17.4167 11.0004 17.4167C6.32078 17.4167 3.25007 13.2872 2.21845 11.6538Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.0004 13.75C12.5192 13.75 13.7504 12.5188 13.7504 11C13.7504 9.48123 12.5192 8.25001 11.0004 8.25001C9.48159 8.25001 8.25037 9.48123 8.25037 11C8.25037 12.5188 9.48159 13.75 11.0004 13.75Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg> View
                </a>

                <a href="{{ route('orderHistory.download-orders', $model->id) }}" class="dropdown-item px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="22"
                        viewBox="0 0 18 18" fill="none">
                        <path
                            d="M17.25 11.75V12.85C17.25 14.3901 17.25 15.1602 16.9503 15.7485C16.6866 16.2659 16.2659 16.6866 15.7485 16.9503C15.1602 17.25 14.3901 17.25 12.85 17.25H5.15C3.60986 17.25 2.83978 17.25 2.25153 16.9503C1.73408 16.6866 1.31338 16.2659 1.04973 15.7485C0.75 15.1602 0.75 14.3901 0.75 12.85V11.75M13.5833 7.16667L9 11.75M9 11.75L4.41667 7.16667M9 11.75V0.75"
                            stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Download Invoice
                </a>
                @if ($model->payment_status == 0)
                    <a class="dropdown-item px-3" href="{!! route('pay.order', $model->order_number) !!}" title="Show Job">
                        <svg class="mr-2" width="18" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.1668 9.16668H1.8335M10.0835 12.8333H5.50016M1.8335 7.51668L1.8335 14.4833C1.8335 15.5101 1.8335 16.0235 2.03332 16.4157C2.20909 16.7606 2.48955 17.0411 2.83451 17.2169C3.22668 17.4167 3.74007 17.4167 4.76683 17.4167L17.2335 17.4167C18.2603 17.4167 18.7736 17.4167 19.1658 17.2169C19.5108 17.0411 19.7912 16.7606 19.967 16.4157C20.1668 16.0235 20.1668 15.5101 20.1668 14.4833V7.51668C20.1668 6.48992 20.1668 5.97653 19.967 5.58436C19.7912 5.2394 19.5108 4.95893 19.1658 4.78317C18.7736 4.58334 18.2603 4.58334 17.2335 4.58334L4.76683 4.58334C3.74007 4.58334 3.22669 4.58334 2.83451 4.78316C2.48955 4.95893 2.20909 5.2394 2.03332 5.58436C1.8335 5.97653 1.8335 6.48991 1.8335 7.51668Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                         Pay Now
                    </a>
                @endif
            @endif

            {{-- <div role="separator" class="dropdown-divider"></div>
            @include('components.state_ajax_link', ['id' => $id, 'entity' => $entity, 'state' => $state]) --}}

        </div>
    </div>
{!! Form::close() !!}


 {{-- {!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id", 'button-type' => 'button']) !!}
 {!! Form::hidden('process', 'delete') !!}
 @include('favorite_jobs.front_delete_link', ['class' => 'text-danger pr-3', 'entity' => $entity, 'id' => $id, 'msg' =>'Do you want to delete this job?'])
{!! Form::close() !!} --}}



