@extends('layouts.'.$layout)

@section('content')
<div class="container">
      @include($entity['view'].'.show_fields')
        </div>
@endsection
