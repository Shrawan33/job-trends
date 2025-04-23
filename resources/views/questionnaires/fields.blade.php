<div class="row">
    <div class="col-md" id="questionnaire-container">
        @include('questionnaires.list', ['job' => $job, 'list' => $questionnaire??[]])

        <!-- Question block to clone from -->
        <div class="form-group mb-4 question-item d-none to-clone">
            <div class="row align-items-center">
                <div class="col pr-0">
                    <input type="hidden" name="questionnaire[0][id]" disabled="disabled" value="0">
                    <input type="text" name="questionnaire[0][title]" class="form-control text-black" disabled="disabled" placeholder="{{trans("label.new_question_placeholder")}}" autocomplete="off">
                </div>
                <div class="col-auto pl-0">
                    <a href="javascript:void(0)" data-id="0" class="text-danger ml-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none" class="mr-2">
                            <path d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6" stroke="#F00404" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="javascript:void(0)" id="add_question" class="btn btn-link px-0 @if(count($questionnaire??[]) >= config('constants.questions_limit', 5)) d-none @endif">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
        <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="#152b9b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg> {{ trans("label.add_question") }}</a>

@push('page_scripts')
<script type="text/javascript">
var $wrapper = $('#questionnaire-container');
var $question_limit = {!! config('constants.questions_limit', 5) !!}
// $(document).ready(function() {
//     $('#add_question').trigger('click');
// });

$('#add_question').on("click", function(e) {
    e.preventDefault();
    var total_questions = $('.question-item', $wrapper).not('.d-none').length;
    var cloned_content = $('.to-clone', $wrapper).clone(true).appendTo($wrapper);
    cloned_content.removeClass('to-clone d-none');
    cloned_content.find('[name^=questionnaire]').prop('disabled', false)
    cloned_content.find('a').addClass('item-remove-field').attr('data-id', total_questions);
    cloned_content.find('input').each(function(){
        stringtoreplace = $(this).attr('name');
        $(this).attr('name', stringtoreplace.replace("[0]", "["+total_questions+"]"))
    });
    // console.log($question_limit, total_questions);
    if ((total_questions+1) >= $question_limit) {
        $(this).addClass('d-none')
    }
});

// Remove buttons
$('.question-item', $wrapper).on("click", ".item-remove-field", function() {
    $(this).parents('.question-item').remove();
    var total_questions = $('.question-item', $wrapper).not('.d-none').length;
    if (total_questions < $question_limit) {
        $('#add_question').removeClass('d-none')
    }
});
</script>
@endpush
