<small class="help-block text-right">
    @if (!empty($config['updated_by']) && (!empty($config['updated_on'])))
    <i>{{trans('label.last_updated_by')}} {{ $config['updated_by'] }}, on {{ $config['updated_on'] }}</i>
    @endif
</small>
