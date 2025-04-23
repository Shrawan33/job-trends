<div class="row">
    <div class="col-md-6 m-auto">
        <div class="card">
            <div class="card-header"><h3 class="card-title">{!! trans('label.pricing') !!}</h3></div>
            <div class="card-body">
                <div class="row">
                @foreach ($pricing['type'] as $field => $type)
                    <div class="col-md-6 mb-4">
                        {!! Form::label($field, $pricing['label'][$field]??null) !!}
                        <div class="{!! isset($pricing['postfix'][$field]) ? 'input-group' : 'form-group mb-0' !!}">
                        @if (isset($type))
                            @switch($type)
                                @case('decimal')
                                    {!! Form::number("pricing[$field]", $pricing['value'][$field] ?? null, ['class' => 'form-control', 'step' => '.001', 'min' => '0', 'title' => "Set ".$pricing['label'][$field]??null]) !!}
                                    @break
                                @case('numeric')
                                    {!! Form::number("pricing[$field]", $pricing['value'][$field] ?? null, ['class' => 'form-control', 'step' => '1', 'min' => '0', 'title' => "Set ".$pricing['label'][$field]??null]) !!}
                                    @break
                                @case('email')
                                    {!! Form::email("pricing[$field]", $pricing['value'][$field] ?? null, ['class' => 'form-control', 'title' => "Set ".$pricing['label'][$field]??null]) !!}
                                    @break
                                @case('textarea')
                                    {!! Form::textarea("pricing[$field]", $pricing['value'][$field] ?? null, ['class' => 'form-control', 'title' => "Set ".$pricing['label'][$field]??null, 'rows' => 5]) !!}
                                    @break
                                @default
                                    {!! Form::text("pricing[$field]", $pricing['value'][$field] ?? null, ['class' => 'form-control', 'title' => "Set ".$pricing['label'][$field]??null]) !!}
                            @endswitch
                        @endif

                        @if (isset($pricing['postfix'][$field]))
                            <div class="input-group-append">
                                <div class="input-group-text">{{$pricing['postfix'][$field]}}</div>
                            </div>
                        @endif
                        </div>

                        @widget('AuthorFields', [
                            'updated_by' => isset($pricing['last_updated_by'][$field]) ? $pricing['last_updated_by'][$field] : '',
                            'updated_on' => isset($pricing['last_updated_on'][$field]) ? $pricing['last_updated_on'][$field] : '',
                            'information' => 'last_updated'
                        ])

                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
