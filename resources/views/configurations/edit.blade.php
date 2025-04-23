@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @include('adminlte-templates::common.errors')
                <div class="col-sm-12">
                    <h1>{{trans('label.configurations')}}</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">
        <div class="card  card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-line-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab_generatedNumbers" role="tab">{{trans('label.generate_code')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab_general" role="tab">{{trans('label.general')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab_contact" role="tab">{{trans('label.contact')}}</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab_feed" role="tab">{{trans('label.feed')}}</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab_pricing" role="tab">{{trans('label.pricing')}}</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div id="tab_generatedNumbers" class="tab-pane fade in active show">
                        {!! Form::open(['route' => ['configurations.generatedNumbers.update'], 'method' => 'post', 'data-model' => 'generatedNumbers', 'class' => 'frm-delete-datatable-row']) !!}
                        <div class="card-body">
                            @include('configurations.generated_numbers')
                        </div>
                        <div clas="row">
                            <div class="col-md-12 text-right">
                                {!! Form::submit('Update', ['class' => 'btn btn-primary', 'id' => 'update-button-gnnum']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div id="tab_general" class="tab-pane fade in">
                        {!! Form::open(['url' => route('configurations.update', ['type' => 'general']), 'method' => 'post', 'data-model' => 'general', 'class' => 'frm-delete-datatable-row']) !!}
                        <div class="card-body">
                            @include('configurations.general')
                        </div>
                        <div clas="row">
                            <div class="col-md-12 text-right">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'update-button-general']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    <div id="tab_contact" class="tab-pane fade in">
                        {!! Form::open(['url' => route('configurations.update', ['type' => 'contact']), 'method' => 'post', 'data-model' => 'general', 'class' => 'frm-delete-datatable-row']) !!}
                        <div class="card-body">
                            @include('configurations.contact')
                        </div>
                        <div clas="row">
                            <div class="col-md-12 text-right">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'update-button-contact']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    {{-- <div id="tab_feed" class="tab-pane fade in">
                        {!! Form::open(['url' => route('configurations.update', ['type' => 'contact']), 'method' => 'post', 'data-model' => 'general', 'class' => 'frm-delete-datatable-row']) !!}
                        <div class="card-body">
                            @include('configurations.feed')
                        </div>
                        <div clas="row">
                            <div class="col-md-12 text-right">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'update-button-contact']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div> --}}
                    <div id="tab_pricing" class="tab-pane fade in">
                        {!! Form::open(['url' => route('configurations.update', ['type' => 'pricing']), 'method' => 'post',
                        'data-model' => 'pricing', 'class' => 'frm-delete-datatable-row']) !!}
                        <div class="card-body">
                            @include('configurations.pricing')
                        </div>
                        <div clas="row">
                            <div class="col-md-12 text-right">
                                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'update-button-pricing'])
                                !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page_scripts')
    <script>
        var modalContentForHelpToolTip = $("#modalContentForHelpToolTip");

        $(document).ready(function () {
            $("input.gnum-radio-button").each(function() {
                console.log(this.value);
                if ($(this).is(":checked")) {
                    showSettingValueDiv(this);
                } else {
                    hideSettingValueDiv(this);
                }
            });

            $(".helpToolTip").click(function () {
                modalContentForHelpToolTip.find("ul#helpModelUl").html(getPatternDivContent(this));
                contentModal("Pattern Help", "modalContentForHelpToolTip");
            });

            $(".pattern-input").change(function (e) {
                e.preventDefault();
                getPatternPreview(this);
                var pattern = $(this).val();
                var patternSpan = $(this).closest(".pattern-div").find("span.pattern-span");
                var updateButton = $("#update-button-gnnum");

                if((pattern.indexOf("{$counter}") != -1) || pattern == "") {
                    if(!validatePattern(this)) {
                        patternSpan.html("Some inserted patterns are not available. please check help box to get all available patterns");
                        updateButton.attr("disabled", "disabled");
                    } else {
                        patternSpan.html("");
                        updateButton.removeAttr("disabled");
                    }
                } else {
                    patternSpan.html("Please add counter to make sure every generated id is unique");
                    updateButton.attr("disabled", "disabled");
                }
            });
        });

        $(document).on('change', '.gnum-radio-button', function() {
            // console.log(this.checked, this.value);
            $(this).closest('.card-body').find('.prefix-pattern-types').hide()
            showSettingValueDiv(this);
            // if(this.value == 'prefix') {
            //     showSettingValueDiv(this);
            // } else {
            //     hideSettingValueDiv(this);
            // }
        });

        function hideSettingValueDiv(radioButtonObject) {
            console.log($(radioButtonObject).data("type"));
            $(radioButtonObject).closest('.card-body').find('.' + $(radioButtonObject).data("type") + '-div').hide().find("input:text").attr("disabled", "disabled").closest('.card-body').find("div.pattern-preview-span").html(null);
        }

        function showSettingValueDiv(radioButtonObject) {
            console.log($(radioButtonObject).data("type"));
            $(radioButtonObject).closest('.card-body').find('.' + $(radioButtonObject).data("type") + '-div').show().find("input:text").removeAttr("disabled");
        }

        function getPatternPreview(textBoxObject) {
            var previewSpan = $(textBoxObject).closest(".card-body").find("div.pattern-preview-span");

            $.ajax({
                url: '{{ route("configurations.get-pattern-preview") }}',
                type: 'GET',
                data: {pattern: $(textBoxObject).val(), name: $(textBoxObject).data("tooltipcontent")},
                success: function(response) {
                    if(response.success === true) {
                        if (response.data === "" || response.data === null) {
                            previewSpan.html(null);
                        } else {
                            previewSpan.html("<span>Example: "+response.data+"</span>")
                        }
                    }
                }
            });

        }

        function getPatternDivContent(object) {
            return $(object).closest(".pattern-div").find("div." + $(object).data("tooltipcontent") + "ToolTipContent").html();
        }

        function validatePattern(textBoxObject) {
            var insertedPattern = [];
            var allowedPattern = [];

            var pattern = $(textBoxObject).val();
            var patternHtml = getPatternDivContent(textBoxObject);
            var patternRegex= /{(.*?)}/igm;
            var datePatternRegex = /\{\$date:([^}]+)\}/g;

            $.each(pattern.match(datePatternRegex), function(index, value) {
                pattern = pattern.replace(value,'');
            });

            $.each(pattern.match(patternRegex), function(index, value) {
                insertedPattern.push(value);
            });

            $.each(patternHtml.match(patternRegex), function(index, value) {
                allowedPattern.push(value);
            });

            var passed = insertedPattern.every((val) => allowedPattern.indexOf(val) !== -1);

            return passed;
        }
    </script>
    <script>
        jQuery(function(){
             var $select = jQuery(".selectDay");
             var $selected = '{{ isset($salary_day) && $salary_day != "" ? $salary_day : "" }}';

             console.log($selected);
             var $msg ="";
             for (i=1;i<=31;i++){
                if(i == $selected){
                     $msg = "selected";
                }
                else{
                    $msg = "";
                }
                 $select.append(jQuery('<option '+$msg+'></option>').val(i).html(i));
             }
         });
    </script>
@endpush

