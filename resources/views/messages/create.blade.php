{{-- @extends('layouts.ajax')

@section('content')
{!! Form::open(['route' => $prefix.'send.message', 'id' => 'frm_message']) !!}

    {!! Form::hidden('group', $group??false) !!}
    @if ($group ?? false)
    <div class="form-group mb-4">
        <span class="text-muted">{!! $names??null !!}</span>
    </div>
        {!! Form::hidden('id', $ids) !!}
    @else
        {!! Form::hidden('id', $user->id??null) !!}
    @endif

    {{-- <div class="form-group mb-4">
        {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Subject']) !!}
    </div>

    <!-- message Field -->
    <div class="form-group mb-4">
        {!! Form::textarea('message', null, ['rows' => 4, 'class' => 'form-control', 'placeholder' => 'Message...', 'maxlength' => config('constants.message_length', 500)]) !!}
        <span class="help-block"></span>
        <div class="text-muted text-right">{{trans("message.maximum_message_limit", ['limit' => config('constants.message_length', 500)])}}</div>
    </div>
    <div class="form-group mb-4 text-right">
        <ul class="list-inline">
            {{-- @role('employer')
            <li class="list-inline-item mr-3">
            {!! Form::checkbox('via[]','sms', null, ['label' => trans('label.send_sms'), 'id' => 'via_sms']) !!}
            </li>
            @endrole
            <li class="list-inline-item mr-3">
            {!! Form::checkbox('via[]', 'mail', null, ['label' => trans('label.send_email'), 'id' => 'via_email']) !!}
            </li>
            <li class="list-inline-item" style="display:none;">
            {!! Form::checkbox('via[]', 'database', true, ['label' => trans('label.send_msg'), 'id' => 'via_msg']) !!}
            </li>
        </ul>
    </div>
{!! Form::close() !!}
@endsection

@push('page_scripts')
    <script src="{{asset('js/validation/sendmessage.js')}}"></script>
@endpush --}}

{{-- <style>
    .message-container {
        display: flex;
        flex-direction: column;
    }

    .message-wrapper {
        display: flex;
        align-items: flex-end;
        margin-bottom: 10px;
    }

    .sender .message-content {
        background-color: #DCF8C6;
        border-radius: 16px 16px 0 16px;
        color: #000;
        padding: 10px;
        max-width: 70%;
        align-self: flex-end;
    }

    .receiver .message-content {
        background-color: #EDEFF1;
        border-radius: 16px 16px 16px 0;
        color: #000;
        padding: 10px;
        max-width: 70%;
    }

    .message-time {
        font-size: 12px;
        color: #888;
        margin-top: 5px;
    }

    .sender .message-time {
        text-align: right;
    }

    .receiver .message-time {
        text-align: left;
    }

    .message-text {
        word-wrap: break-word;
        max-width: 100%;
    }
</style> --}}

@extends('layouts.ajax')

@section('content')
    {{-- <div id="message_box" class="" style="height:300px;overflow-y:auto;overflow-x:hidden;margin-bottom:15px;">
        <div class="row d-flex p-4 thread_messages">
            @foreach ($messages as $key => $message)
                @if ($message->sender_id == auth()->user()->id)
                    <div class="col-sm-12 m-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label style="font-weight: 500;">{!! FunctionHelper::fromSqlDateTime($message->created_at->toDateTimeString(), true, '') !!}</label>
                            </div>
                            <div class="col-sm-6 text-right">
                                <h5>{{ auth()->user()->first_name . ' ' . auth()->user()->last_name ?? '' }}</h5>
                            </div>
                        </div>
                        <div class="bg-dark p-3 text-right rounded" style="background: #e5e5e5 !important;">
                            <h6 class="text-right" style="font-size:15px;color:#272729">{{ $message->data['message'] ?? '' }}
                            </h6>
                        </div>
                    </div>
                @else
                    <div class="col-sm-12 m-3 rounded">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5>{{ $user->first_name . ' ' . $user->last_name ?? '' }}</h5>
                            </div>
                            <div class="text-right col-sm-6">
                                <label class="text-right" style="font-weight: 500;">{!! FunctionHelper::fromSqlDateTime($message->created_at->toDateTimeString(), true, '') !!}</label>
                            </div>
                        </div>
                        <div class=" bg-primary text-white p-3 rounded" style="background-color: #0D2D56 !important">
                            <h6 class="text-white text-left" style="font-size:15px;">{{ $message->data['message'] ?? '' }}
                            </h6>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div> --}}

    {{-- <div id="message_box" class="message-container">
    @foreach ($messages as $key => $message)
      <div class="message-wrapper @if ($message->sender_id == auth()->user()->id) sender @else receiver @endif">
        <div class="message-content">
          <div class="message-text">
            {{ $message->data['message'] ?? '' }}
          </div>
          <div class="message-time">
            {!! FunctionHelper::fromSqlDateTime($message->created_at->toDateTimeString(), true, '') !!}
          </div>
        </div>
      </div>
    @endforeach
  </div> --}}


    <div id="message_box" class="" style="height:300px;overflow-y:auto;overflow-x:hidden;margin-bottom:15px;">
        <div class="row d-flex py-4 thread_messages">
            @foreach ($messages as $key => $message)
                @if ($message->sender_id == auth()->user()->id)
                    <div class="col-md-6 my-3 offset-md-6" onclick="showDateTimePopup(this)">
                        {{-- <div class="row">
                {{-- <div class="col-sm-6">
                    <label class="timestamp-label" style="font-weight: 500;">{!!FunctionHelper::fromSqlDateTime($message->created_at->toDateTimeString(),true,'')!!}</label>
                </div> --}}
                        {{-- <div class="col-sm-6 text-right">
                    <h5>{{ auth()->user()->first_name.' '.auth()->user()->last_name??''}}</h5>
                </div>
                </div> --}}
                        <div class="bg-dark p-3 rounded" style="background: #e5e5e5 !important;">
                            <h6 class="text-left" style="font-size:12px;color:#272729">{{ $message->data['message'] ?? '' }}
                            </h6>
                        </div>
                        <div class="datetime-popup">
                            <p class="datetime-text">
                                {{ FunctionHelper::fromSqlDateTime($message->created_at->toDateTimeString(), true, '') }}</p>
                        </div>
                    </div>
                @else
                    <div class="col-md-6 my-3 rounded mr-3" onclick="showDateTimePopup(this)">
                        {{-- <div class="row">
                <div class="col-sm-6">
                    <h5>{{ $user->first_name." ".$user->last_name??''}}</h5>
                </div>
                <div class="text-right col-sm-6">
                    <label class="timestamp-label" style="font-weight: 500;">{!!FunctionHelper::fromSqlDateTime($message->created_at->toDateTimeString(),true,'')!!}</label>
                </div>
            </div> --}}
                        <div class=" bg-primary text-white p-3 rounded" style="background-color: #0D2D56 !important">
                            <h6 class="text-white text-left" style="font-size:12px;">{{ $message->data['message'] ?? '' }}
                            </h6>
                        </div>
                        <div class="datetime-popup">
                            <p class="datetime-text">
                                {{ FunctionHelper::fromSqlDateTime($message->created_at->toDateTimeString(), true, '') }}</p>
                        </div>

                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <style>
        .datetime-popup {
            display: none;
            position: absolute;
            top: calc(90% + 5px);
            left: 50%;
            transform: translateX(-50%);
            padding: 3px 8px;
            /* Adjusted padding */
            background-color: #f8f8f8;
            border-radius: 10px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
            font-size: 10px;
            text-align: center;
            line-height: 1.2;
            /* Adjusted line-height */
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            /* Added flex display */
            align-items: center;
            /* Center vertically */
            justify-content: center;
            /* Center horizontally */
        }

        .datetime-popup.active {
            display: block;
            opacity: 1;
        }
    </style>














    <script>
        function showDateTimePopup(element) {
            var datetimePopup = element.querySelector('.datetime-popup');
            datetimePopup.classList.add('active');
            setTimeout(function() {
                datetimePopup.classList.remove('active');
            }, 1000);
        }
    </script>










    {!! Form::open(['route' => 'send.message', 'id' => 'frm_message', 'name' => 'frm_message']) !!}

    {!! Form::hidden('group', $group ?? false) !!}
    @if ($group ?? false)
        <div class="form-group mb-4">
            <span class="text-muted">{!! $names ?? null !!}</span>
        </div>
        {!! Form::hidden('id', $ids) !!}
    @else
        {!! Form::hidden('id', $user->id ?? null) !!}
    @endif

    {{-- <div class="form-group mb-4">
    {!! Form::text('subject', null, ['class' => 'form-control', 'placeholder' => trans('label.subject')]) !!}
</div> --}}

    <!-- message Field -->
    <div class="">
        {!! Form::textarea('message', null, [
            'rows' => 4,
            'class' => 'form-control',
            'placeholder' => trans('label.message') . '...',
            'maxlength' => config('constants.message_length', 500),
        ]) !!}
        <span class="help-block"></span>
        <div class="text-muted text-right">
            {{ trans('message.maximum_message_limit', ['limit' => config('constants.message_length', 500)]) }}</div>
    </div>
    {!! Form::hidden('via[]', 'database') !!}
    {{-- <div class="form-group mb-4 text-right">
    <ul class="list-inline">
        @role('employer')
        <!--<li class="list-inline-item ">
            {!! Form::checkbox('via[]','sms', null, ['label' => trans('label.send_sms'), 'id' => 'via_sms']) !!}
        </li>-->
        @endrole
        <!--<li class="list-inline-item ">
            {!! Form::checkbox('via[]', 'mail', null, ['label' => trans('label.send_email'), 'id' => 'via_email']) !!}
        </li>
        <li class="list-inline-item">
            {!! Form::checkbox('via[]', 'database', true, ['label' => trans('label.send_msg'), 'id' => 'via_msg']) !!}
        </li>-->

    </ul>
</div> --}}
    {!! Form::close() !!}
@endsection

@push('page_scripts')
    <script src="{{ asset('js/validation/sendmessage.js') }}"></script>
@endpush
