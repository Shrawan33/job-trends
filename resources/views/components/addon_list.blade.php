@foreach ($addOns as $addon)
    {!! Form::checkbox('addon_list[]', $addon->id, false, ['class' => 'form-control checkbox', 'label'=>$addon->title, 'id'=>'addon_'.$addon->id]) !!}
@endforeach
