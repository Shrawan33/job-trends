<div class="form-group">
    {!! Form::label('page', 'Page') !!}
    {!! Form::select('page', [
        'home' => 'Home',
        'Career Service' => 'Career Service',
        'Blog' => 'Blog',
        'Feeds' => 'Feeds',
        'Search Jobs' => 'Search Jobs',
        'Terms Condition' => 'Terms Condition',
        'Events' => 'Events',
        'About Us' => 'About Us',
        'Contact Us' => 'Contact Us',
    ], old('page', $setting->page ?? ''), ['class' => 'form-control', 'placeholder' => 'Select Page']) !!}
</div>

{!! Form::hidden('key', 'seo_setting') !!}

<div class="form-group">
    {!! Form::label('meta_title', 'Meta Title') !!}
    {!! Form::text('meta_title', $decoded['meta_title'] ?? '', ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('meta_description', 'Meta Description') !!}
    {!! Form::textarea('meta_description', $decoded['meta_description'] ?? '', ['class' => 'form-control']) !!}
</div>
