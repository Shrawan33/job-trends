@extends('layouts.ajax')

@section('content')
    {!! Form::open(['route' => $entity['url'].'.store', 'id' => 'frm_setting']) !!}
        @if ($tab === 'seo')
            {!! Form::hidden('key', 'seo_setting') !!}
            @include($entity['view'].'.fields_seo')
        @elseif ($tab === 'google_analytics')
            {!! Form::hidden('key', 'google_analytics') !!}
            @include($entity['view'].'.fields_google_analytics')
        @endif
        {{-- <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div> --}}
    {!! Form::close() !!}
@endsection
