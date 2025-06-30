<div class="form-group">
    <label for="google_analytics_head">Head Section</label>
    <small class="form-text text-muted">Insert your JS code</small>
    {!! Form::textarea('google_analytics_head', $decoded['google_analytics_head'] ?? '', ['class' => 'form-control', 'rows' => 4]) !!}
</div>

<div class="form-group">
    <label for="google_analytics_body">Body Section</label>
    <small class="form-text text-muted">Insert your JS code</small>
    {!! Form::textarea('google_analytics_body', $decoded['google_analytics_body'] ?? '', ['class' => 'form-control', 'rows' => 4]) !!}
</div>

<div class="form-group">
    <label for="google_analytics_footer">Footer Section</label>
    <small class="form-text text-muted">Insert your JS code</small>
    {!! Form::textarea('google_analytics_footer', $decoded['google_analytics_footer'] ?? '', ['class' => 'form-control', 'rows' => 4]) !!}
</div>

{!! Form::hidden('key', 'google_analytics') !!}
