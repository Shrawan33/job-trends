
@if($wrapper_class == 'circle')
<div class="{!! $wrapper_class !!}">
<a href="javascript:void(0)" id="add-container-{{$id??'image'}}" class="border text-body bg-gray d-inline-block px-5 py-3 text-center add-gallery-image add-image-container" >
    <span class="h3 font-weight-normal text-secondary">+</span>
    <span class="text-primary d-block">{{trans('label.add_more_photo')}}</span>
    <span class="d-block small">{{trans('label.image_below')}}</span>
</a>

</div>
@else
<div class="{!! $wrapper_class !!}">
<a href="javascript:void(0)" id="add-container-{{$id??'image'}}" class="border text-body bg-gray d-inline-block px-5 py-3 text-center add-gallery-image add-image-container" >
{{trans('label.upload_edit')}}
</a>
</div>
@endif
