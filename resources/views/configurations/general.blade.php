<div class="row">
    <div class="col-md-6 m-auto">
        <div class="card">
            <div class="card-header"><h3 class="card-title">General</h3></div>
            <div class="card-body">
                <div class="row">
                @foreach ($general['type'] as $field => $type)
                    <div class="col-md-12">
                        {!! Form::label($field, $general['label'][$field]??null) !!}
                        <div class="{!! isset($general['postfix'][$field]) ? 'input-group' : 'form-group mb-0' !!} {!! $general['type'][$field] == 'checkbox' ? 'd-inline-block' : '' !!}">
                        @if (isset($type))
                            @switch($type)
                                @case('decimal')
                                    {!! Form::number("general[$field]", $general['value'][$field] ?? null, ['class' => 'form-control', 'step' => '.001', 'min' => '0', 'title' => "Set ".$general['label'][$field]??null]) !!}
                                    @break
                                @case('numeric')
                                    {!! Form::number("general[$field]", $general['value'][$field], ['class' => 'form-control', 'step' => '1', 'min' => '0', 'title' => "Set ".$general['label'][$field]??null]) !!}
                                    @break
                                @case('checkbox')
                                    {!! Form::hidden("general[$field]", 0, ['class' => 'form-check-input']) !!}
                                    {!! Form::checkbox("general[$field]", 1, $general['value'][$field]??false)  !!}
                                    @break
                                @default
                                    {!! Form::text("general[$field]", $general['value'][$field], ['class' => 'form-control', 'title' => "Set ".$general['label'][$field]??null]) !!}
                            @endswitch
                        @endif

                        @if (isset($general['postfix'][$field]))
                            <span class="input-group-addon">{{$general['postfix'][$field]}}</span>
                        @endif
                        </div>

                        @widget('AuthorFields', [
                            'updated_by' => isset($general['last_updated_by'][$field]) ? $general['last_updated_by'][$field] : '',
                            'updated_on' => isset($general['last_updated_on'][$field]) ? $general['last_updated_on'][$field] : '',
                            'information' => 'last_updated'
                        ])

                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
