<div class="row">
    <div class="col-md-6 m-auto">
        <div class="card">
            <div class="card-header"><h3 class="card-title">{!! trans('label.contact') !!}</h3></div>
            <div class="card-body">
                <div class="row">
                @foreach ($contact['type'] as $field => $type)
                    <div class="col-md-12">
                        {!! Form::label($field, $contact['label'][$field]??null) !!}
                        <div class="{!! isset($contact['postfix'][$field]) ? 'input-group' : 'form-group mb-0' !!}">
                        @if (isset($type))
                            @switch($type)
                                @case('decimal')
                                    {!! Form::number("contact[$field]", $contact['value'][$field] ?? null, ['class' => 'form-control', 'step' => '.001', 'min' => '0', 'title' => "Set ".$contact['label'][$field]??null]) !!}
                                    @break
                                @case('numeric')
                                    {!! Form::number("contact[$field]", $contact['value'][$field], ['class' => 'form-control', 'step' => '1', 'min' => '0', 'title' => "Set ".$contact['label'][$field]??null]) !!}
                                    @break
                                @case('email')
                                    {!! Form::email("contact[$field]", $contact['value'][$field], ['class' => 'form-control', 'title' => "Set ".$contact['label'][$field]??null]) !!}
                                    @break
                                @case('textarea')
                                    {!! Form::textarea("contact[$field]", $contact['value'][$field], ['class' => 'form-control', 'title' => "Set ".$contact['label'][$field]??null, 'rows' => 5]) !!}
                                    @break
                                @default
                                    {!! Form::text("contact[$field]", $contact['value'][$field], ['class' => 'form-control', 'title' => "Set ".$contact['label'][$field]??null]) !!}
                            @endswitch
                        @endif

                        @if (isset($contact['postfix'][$field]))
                            <span class="input-group-addon">{{$contact['postfix'][$field]}}</span>
                        @endif
                        </div>

                        @widget('AuthorFields', [
                            'updated_by' => isset($contact['last_updated_by'][$field]) ? $contact['last_updated_by'][$field] : '',
                            'updated_on' => isset($contact['last_updated_on'][$field]) ? $contact['last_updated_on'][$field] : '',
                            'information' => 'last_updated'
                        ])

                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
