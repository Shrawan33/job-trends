<input type="text" name="suggested_title[{{$id}}]" id="suggest_title" class="form-control px-2" value="{{$suggest??''}}" placeholder="Job Title"/>

<script>
    /* Update status on shortlisted candidate list page*/
    $(document).ready(function() {
        $('input[name="suggested_title[{{$id}}]"]').on('change', function () {
            var val = $(this).val();
            var id = "{{$id}}";
            var data= 'id='+id+'&suggested_title='+val;

            processAjaxOperation(
                 "{{route('ajax.suggesttitle.save')}}",
                 "GET",
                 data,
                 false,
                 "shortlisted-candidate"
             )
    });
    });

</script>

