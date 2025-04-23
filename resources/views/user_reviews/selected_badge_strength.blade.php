@foreach ($model as $attribute)
    <li>
        <div class="review_specs d-flex align-items-center">
            @if (in_array($attribute->title, $review->badge_strength))
                {!! Form::checkbox($name, $attribute->title, false, [
                    'class' => 'form-control checkbox',
                    'label' => $attribute->title,
                    'id' => 'strength-checkbox-' . $attribute->id, // Add an ID here
                    'checked' => 'checked'
                ]) !!}
            @else
                {!! Form::checkbox($name, $attribute->title, false, [
                    'class' => 'form-control checkbox',
                    'label' => $attribute->title,
                    'id' => 'strength-checkbox-' . $attribute->id, // Add an ID here
                ]) !!}
            @endif
        </div>
    </li>
@endforeach
