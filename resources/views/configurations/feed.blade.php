<div class="row">
    <div class="col-md-6 m-auto">
        <div class="card">
            <div class="card-header"><h3 class="card-title">{!! trans('label.feed') !!}</h3></div>
            <div class="card-body">
                <div class="row">
                @foreach ($feed['type'] as $field => $type)
                    <div class="col-md-12  mb-2">
                        {!! Form::label($field, $feed['label'][$field]??null) !!}
                        <div class="form-group mb-0">
                            @if (isset($type))
                                @switch($type)
                                    @case('decimal')
                                        {!! Form::number("feed[$field]", $feed['value'][$field] ?? null, ['class' => 'form-control', 'step' => '.001', 'min' => '0', 'title' => "Set ".$feed['label'][$field]??null]) !!}
                                        @break
                                    @case('numeric')
                                        {!! Form::number("feed[$field]", $feed['value'][$field] ?? null, ['class' => 'form-control', 'step' => '1', 'min' => '0', 'title' => "Set ".$feed['label'][$field]??null]) !!}
                                        @break
                                    @case('email')
                                        {!! Form::email("feed[$field]", $feed['value'][$field] ?? null, ['class' => 'form-control', 'title' => "Set ".$feed['label'][$field]??null]) !!}
                                        @break
                                    @case('textarea')
                                        {!! Form::textarea("feed[$field]", $feed['value'][$field] ?? null, ['class' => 'form-control', 'title' => "Set ".$feed['label'][$field]??null, 'rows' => 5]) !!}
                                        @break
                                    @default
                                        {!! Form::text("feed[$field]", $feed['value'][$field] ?? null, ['class' => 'form-control', 'title' => "Set ".$feed['label'][$field]??null]) !!}
                                @endswitch
                            @endif


                        </div>

                        @widget('AuthorFields', [
                            'updated_by' => isset($feed['last_updated_by'][$field]) ? $feed['last_updated_by'][$field] : '',
                            'updated_on' => isset($feed['last_updated_on'][$field]) ? $feed['last_updated_on'][$field] : '',
                            'information' => 'last_updated'
                        ])

                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
