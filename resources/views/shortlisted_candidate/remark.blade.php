{!! Form::open(['route' => 'remark-store', 'id' => 'frm_remark']) !!}
{!! Form::hidden('shortlisted_id', $favourit->id ??'', ['class' => 'form-control']) !!}

                <table class="table table-striped multi-remark-wrapper" id="multi-remark-wrapper">
                    <tbody>
                       @include('shortlisted_candidate.remark_list')
                    </tbody>
                </table>

        <div class="row align-items-end">
            <div class="col">
                <textarea name="remark[]"  cols="30" rows="4" class="form-control" placeholder="Add Remark..." id="txtArea"></textarea>
                {!! Form::hidden('remark_id[]', 0, ['class' => 'form-control']) !!}
            </div>
        </div>


{!! Form::close() !!}
<script type="text/javascript">
    $(function() {
        $('#save_button').attr('disabled', true);

        $('#txtArea').on('keyup',function() {
            var textarea_value = $("#txtArea").val();

            if(textarea_value != '') {
                $('#save_button').attr('disabled', false);
            } else {
                $('#save_button').attr('disabled', true);
            }
        });
        var $wrapper = $('#multi-remark-wrapper');
        $('.multi-remark-table',$wrapper).on('click','.remove-remark', function() {

            var id = $(this).attr('data-id');
            var shortlisted_id = $('input[name="shortlisted_id"]').val();
            var data=JSON.stringify({id: id, shortlisted_id: shortlisted_id});

            processAjaxOperation(
                 "{{route('shortlisted-candidate.remarks.remove')}}",
                 "POST",
                 data,
                 'applicaion/json',
             )
            //  window.LaravelDataTables["shortlisted-candidate-datatable"].draw();
        });


});
</script>
