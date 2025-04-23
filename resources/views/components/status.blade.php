
{{-- <a class="btn btn-danger" href="javascript:submitFormByaction('restore', '{{$entity['targetModel']}}_{{$id}}')"
    title="Inactive {{$entity['singular']}}">
    <i class="fa fa-recycle"></i> {!! __('label.deactive') !!}
</a>  --}}
<label class="switch">
    {{-- <input type="checkbox" @if (!in_array($state, ['archived'])) checked @endif name="{{$entity['targetModel']}}_{{$id}}" id="{{$entity['targetModel']}}_{{$id}}"> --}}
    <select class="status_selection @if (!in_array($state, ['archived'])) active_status @else inactive_status @endif" name="{{$entity['targetModel']}}_{{$id}}" id="{{$entity['targetModel']}}_{{$id}}" >
        <option value="active" @if (!in_array($state, ['archived'])) selected @endif class='@if (!in_array($state, ['archived'])) active @endif'>{{ config('constants.state.data.active') }}</option>
        <option value="archived" @if ( !in_array($state, ['active'])) selected @endif class='@if ( !in_array($state, ['active'])) inactive @endif'>{{ config('constants.state.data.archived') }}</option>
    </select>
    <div>
        <span></span>
    </div>
</label>

<script>
$(document).ready(function(){
    $("#{{$entity['targetModel']}}_{{$id}}").on('change', function() {

        if (this.value == 'active') {
            submitFormByaction('restore', '{{$entity['targetModel']}}_{{$id}}')
        } else {
            submitFormByaction('archive', '{{$entity['targetModel']}}_{{$id}}')
        }
    })
});
</script>

