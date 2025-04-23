<!-- Submit Field -->
<a href="{{ route($entity['url'].'.index') }}" class="btn btn-default">{!! __('label.cancel') !!}</a>
{!! Form::submit(__('label.save'), ['class' => 'btn btn-primary ml-3']) !!}


