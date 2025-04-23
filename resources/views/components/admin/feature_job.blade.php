<input type="checkbox" name="is_featured[{{$id}}]" id="is_featured" class="form-control" {{$model->is_featured == 1 ? "checked" : ''}}/>

<script>
    /* Update is featured on job-posting list page*/
    $(document).ready(function() {
        $('input[name="is_featured[{{$id}}]"]').on('change', function () {
            var val;
            if($(this).is(':checked')){
                val = 1;
            }else{
                val = 0;
            }
            var id = "{{$id}}";
            var data= 'id='+id+'&is_featured='+val;

            processAjaxOperation(
                 "{{route('ajax.is_featured.update')}}",
                 "GET",
                 data,
                 false,
                 "job-posting"
             )
    });
    });

</script>

