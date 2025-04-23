
    @include('components.send_message', [
        'model' => $model->employer??null,
        'type' => 'link',
        'text' => trans('label.message'),
        'to' => $model->employer->company_name??null,
        'prefix' => $entity['prefix'] == 'account' ? 'account.' : ''
    ])
