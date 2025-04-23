{{-- <div class="d-flex align-items-center">
@if (request()->get('message_type', 2) == 2) <!-- Sent -->

    @include('components.send_message', [
        'model' => $model->notifiableWithTrashed,
        'type' => 'link',
        'text' => trans('label.reply'),
        'to' => auth()->user()->hasRole('empzloyer') ? $model->notifiableWithTrashed->full_name : $model->notifiable->company_name??null,
        'prefix' => $entity['prefix'] == 'account' ? 'account.' : ''
    ])

@else <!-- Received -->

    @include('components.send_message', [
        'model' => $model->actorWithTrashed,
        'type' => 'link',
        'text' => trans('label.reply'),
        'to' => auth()->user()->hasRole('employer') ? $model->actorWithTrashed->full_name : $model->actor->company_name??null,
        'prefix' => $entity['prefix'] == 'account' ? 'account.' : ''
    ])

@endif
@include('messages.show_more', ['model' => $model, 'user_id' => request()->get('message_type', 2) == 2 ? $model->notifiable_id : $model->sender_id, 'is_btn' => true,'text'=>'Thread','class'=>'ml-3','message_type' => request()->get('message_type', 1),'prefix' => $entity['prefix'] == 'account' ? 'account.' : ''])

</div> --}}


{{-- @if (request()->get('message_type', 2) == 2)
<!-- Sent -->
@include('components.send_message', [
'model' => $model->notifiable,
'type' => 'link',
'text' => trans('label.reply'),
'to' => auth()->user()->hasRole('employer') ? $model->notifiable->full_name : $model->notifiable->company_name??null
])
@else
<!-- Received -->
@include('components.send_message', [
'model' => $model->actor,
'type' => 'link',
'text' => trans('label.reply'),
'to' => auth()->user()->hasRole('employer') ? $model->actor->full_name : $model->actor->company_name??null
])
@endif --}}



@if (request()->get('message_type', 2) == 2)
    <!-- Sent -->
    @include('components.send_message', [
        'model' => $model->notifiable,
        'type' => 'link',
        'text' => trans('label.reply'),
        'to' => auth()->user()->hasRole('employer')
            ? $model->notifiable->full_name
            : $model->notifiable->company_name ?? null,
    ])
@else
    <!-- Received -->
    @include('components.send_message', [
        'model' => $model->actor,
        'type' => 'link',
        'text' => trans('label.reply'),
        'to' => auth()->user()->hasRole('employer')
            ? $model->actor->full_name
            : $model->actor->company_name ?? null,
    ])

    {{-- {{ __('label.messages') }} @if (Auth::user()->id)
        ({{ $notificationUnreadCount ?? 0 }}) --}}
    {{-- @endif --}}
@endif
