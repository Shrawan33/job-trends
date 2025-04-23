@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{trans('label.create')}} {!!$entity['singular']!!}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        <div class="card">
            {!! Form::open(['route' => $entity['url'].'.store']) !!}
            <div class="card-body">
                @include($entity['view'].'.fields')
            </div>
            <div class="card-footer text-right">
                @include('components.form-buttons')
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        var prevValue = null;
        var request = null;

        $(function() {
            $('[name="title"]').on('keypress', function(){
                prevValue = this.value
            });
            $('[name="title"]').on('keyup', function(){
                // console.log(this.value, '!=', prevValue)
                if (this.value != prevValue) {
                    var platform = $('[name="guard_name"]').val()
                    getRoleName(this.value, platform)
                    prevValue = this.value
                }
            });
            $('[name="guard_name"]').on("change", function(){
                var title = $('[name="title"]').val()
                getRoleName(title, this.value)
            });
        });

        function getRoleName(title, platform)
        {
            if (request != null) request.abort();
            request = $.ajax({
                type: "GET",
                url: "{{route('ajax.roles')}}",
                data: {term:title, platform},
                success:function(response){
                    $('input[name="name"]').val(response.data);
                    $('#basic_details').find('.help-block').html(response.message);
                }
            });

        }
    </script>
@endpush
