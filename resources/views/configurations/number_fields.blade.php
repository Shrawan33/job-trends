<div class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
                <div class="card-body">
                    <!-- Name Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('configurations['.$index.'][setting_type]', 'Type') !!}
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                {!! Form::radio('configurations['.$index.'][setting_type]', config('constants.configuration_setting_type.1', 'prefix'), old('configurations['.$index.'][setting_type]', !empty($numberFields) ? $numberFields->setting_type : config('constants.configuration_setting_type.1', 'prefix')) == config('constants.configuration_setting_type.1', 'prefix'), ['wrapper-class' => 'd-inline', 'class' => 'gnum-radio-button', 'data-type' => 'prefix', 'id' => 'setting_type_1_'.$index, 'label' => 'Prefix']) !!}
                                {!! Form::radio('configurations['.$index.'][setting_type]', config('constants.configuration_setting_type.2', 'pattern'), old('configurations['.$index.'][setting_type]', !empty($numberFields) ? $numberFields->setting_type : config('constants.configuration_setting_type.1', 'prefix')) == config('constants.configuration_setting_type.2', 'pattern'), ['wrapper-class' => 'd-inline', 'class' => 'gnum-radio-button', 'data-type' => 'pattern', 'id' => 'setting_type_2_'.$index, 'label' => 'Pattern']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 prefix-pattern-types prefix-div">
                        {!! Form::label('configurations['.$index.'][setting_value]', 'Prefix') !!}
                        {!! Form::text('configurations['.$index.'][setting_value]', !empty($numberFields) && $numberFields->setting_type == config('constants.configuration_setting_type.1', 'prefix') ? $numberFields->setting_value : null, ['class' => 'form-control', 'id' => 'setting_value_1_'.$index]) !!}
                    </div>
                    <div class="form-group col-sm-12 prefix-pattern-types pattern-div">
                        {!! Form::label('configurations['.$index.'][setting_value]', 'Pattern') !!}
                        <div class="input-group">
                            {!! Form::text('configurations['.$index.'][setting_value]', !empty($numberFields) && $numberFields->setting_type == config('constants.configuration_setting_type.2', 'pattern') ? $numberFields->setting_value : null, ['class' => 'form-control pattern-input', 'id' => 'setting_value_2_'.$index, "data-tooltipcontent" => $settingField ]) !!}

                            <div class="input-group-append helpToolTip" style="cursor: pointer;" data-tooltipcontent="{{ $settingField }}">
                                <div class="input-group-text"><i class="fas fa-question"></i></div>
                            </div>
                        </div>
                        <span class="text-danger pattern-span"></span>
                        <div class="d-none {{ $settingField }}ToolTipContent">
                            @if (config('constants.number_patterns.general', false))
                                @foreach (config('constants.number_patterns.general') as $key => $pattern)
                                    <li>
                                        @if (isset($pattern['extra_info']))
                                            {{ $key }} - {!! $pattern['extra_info'] !!}
                                        @else
                                            {{ $pattern }}
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                            @if (config("constants.number_patterns.$settingField", false))
                                @foreach (config("constants.number_patterns.$settingField") as $key => $pattern)
                                    <li>
                                        @if (isset($pattern['extra_info']))
                                            {{ $key }} - {!! $pattern['extra_info'] !!}
                                        @else
                                            {{ $pattern }}
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-sm-12 pattern-preview-span"></div>
                    <div class="form-group col-sm-12">
                        {!! Form::label('info', 'Specify a prefix or use a custom pattern to dynamically set the '.$lableName.'.') !!}
                        {!! Form::hidden('configurations['.$index.'][setting_field]', $settingField) !!}
                    </div>
                    @if (!empty($numberFields))
                        <div class="row">
                            <div class="col-sm-12">
                                @widget('AuthorFields', ['model' => $numberFields])
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
