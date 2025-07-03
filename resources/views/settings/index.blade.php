@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-md-6 text-right">
                    @if(request()->get('tab') !== 'google_analytics')
                        @include('components.add_ajax_link', [
                            'class' => 'btn btn-primary float-right',
                            'entity' => $entity,
                            'text' => trans('label.add_new')
                        ])
                    @endif
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        {{-- Tabs --}}
        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link {{ request()->get('tab') !== 'google_analytics' ? 'active' : '' }}"
                   href="{{ route($entity['url'] . '.index', ['tab' => 'seo']) }}">
                    SEO
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->get('tab') === 'google_analytics' ? 'active' : '' }}"
                   href="{{ route($entity['url'] . '.index', ['tab' => 'google_analytics']) }}">
                    Google Analytics
                </a>
            </li>
        </ul>

        {{-- Content --}}
        <div class="card">
            <div class="card-body">
                @if(request()->get('tab') === 'google_analytics')
                    @php
                        $setting = \App\Models\Setting::where('key', 'google_analytics')->first();
                        $decoded = $setting ? $setting->decoded_value : [];
                    @endphp

                    {!! Form::model($setting, [
                        'route' => $setting
                            ? [$entity['url'] . '.update', $setting->id]
                            : [$entity['url'] . '.store'],
                        'method' => $setting ? 'patch' : 'post',
                        'id' => 'frm_' . $entity['targetModel'],
                    ]) !!}
                        @include('settings.google_analytics.fields', ['decoded' => $decoded])
                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    {!! Form::close() !!}
                @else
                    {{-- Default SEO table --}}
                    @includeFirst([$entity['view'] . '.table', 'components.admin.table'])
                @endif
            </div>
        </div>
    </div>
@endsection
