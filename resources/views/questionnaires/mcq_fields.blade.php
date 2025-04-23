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
                    <a href="javascript:void(0)" data-id="0" class="text-danger btn btn-link">{{ trans("label.remove") }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="javascript:void(0)" id="add_question" class="btn btn-link px-0 @if(count($questionnaire??[]) >= config('constants.questions_limit', 5)) d-none @endif">{{ trans("label.add_question") }}</a>

@push('page_scripts')
<script type="text/javascript">
var $wrapper = $('#questionnaire-container');
var $question_limit = {!! config('constants.questions_limit', 5) !!}
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
