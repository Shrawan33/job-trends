{!! Form::open(['route' => [$entity['url'].'.update-destroy', $id], 'method' => 'delete', 'data-model' => $entity['targetModel'], 'id' => "{$entity['targetModel']}_$id"]) !!}
    {!! Form::hidden('process', 'delete') !!}
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-{{$color}} btn-sm">{{$label}}</button>
        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>

        <div class="dropdown-menu dropdown-menu-right">
            @if (!in_array($state, ['deleted']))
                @include('components.show_link', ['class' => 'dropdown-item', 'entity' => $entity, 'target' => '_blank', 'id' => $id, 'text' => '<i class="fa fa-eye"></i> Show', 'url' => route('order.detail', $model->order_number)])
                {{-- <div role="separator" class="dropdown-divider"></div> --}}
                <a href="{{ route('download-orders', $model->id) }}" class="dropdown-item ml-auto btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18" fill="none">
                        <path
                            d="M17.25 11.75V12.85C17.25 14.3901 17.25 15.1602 16.9503 15.7485C16.6866 16.2659 16.2659 16.6866 15.7485 16.9503C15.1602 17.25 14.3901 17.25 12.85 17.25H5.15C3.60986 17.25 2.83978 17.25 2.25153 16.9503C1.73408 16.6866 1.31338 16.2659 1.04973 15.7485C0.75 15.1602 0.75 14.3901 0.75 12.85V11.75M13.5833 7.16667L9 11.75M9 11.75L4.41667 7.16667M9 11.75V0.75"
                            stroke="black" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Download Invoice
                </a>

                @if ($model->order_process_status == 0)
                    <a href="{{ route('orders.markAsCompleted', $model->id) }}" class="dropdown-item" style="color:#cd4932;"> <i class="fa fa-check"></i> Mark As Complete</a>
                @else
                    <a href="{{ route('orders.markAsPending', $model->id) }}" class="dropdown-item" > <i class="fa fa-check" ></i>Mark As Pending</a>
                @endif
            @endif
            {{-- @include('components.state_ajax_link', ['id' => $id, 'entity' => $entity, 'state' => $state]) --}}
        </div>

    </div>
{!! Form::close() !!}

