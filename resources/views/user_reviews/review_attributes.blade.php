@foreach ($model as $attribute)
            <li>
                <div class="review_specs d-flex align-items-center">
                    {{-- <span class="review_title_text">{{ $attribute->title }}</span> --}}
                    {{-- {!! Form::label($name, $attribute->title) !!} --}}
                    {!! Form::checkbox($name, $attribute->title, false, ['class' => 'form-control checkbox', 'label'=> $attribute->title]) !!}
                </div>
            </li>

@endforeach

