@extends('layouts.ajax')

@section('content')
    <div class="row">
        @include($entity['view'].'.show_fields')
    </div>

@endsection


