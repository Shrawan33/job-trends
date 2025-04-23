<?php $selected_class = str_replace(" ", "_", strtolower($selected));?>
<select name="status[{{$id}}]" id="" class="select_status border-0 h-auto p-0 form-control no-select2 table-select {{$selected}}">
    @foreach($statuses as $key => $status)
        <option value="{{$key??''}}" {{$selected == $key ? "selected" : ""}}>{{$status}}</option>
    @endforeach
</select>
<script>
    /* Update status on shortlisted candidate list page*/
    $(document).ready(function() {
        $('select[name="status[{{$id}}]"]').on('change', function () {
            var val = $(this).val();
            var id = "{{$id}}";
            var data= 'id='+id+'&status='+val;

            processAjaxOperation(
                 "{{route('ajax.status-update')}}",
                 "GET",
                 data,
                 false,
                 "shortlisted-candidate"
             )
    });
    });

</script>

