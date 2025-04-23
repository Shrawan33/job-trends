@forelse ($list as $key => $item)
@if ($display??false)
<div class="form-group mb-4 question-item">
    <div class="row align-items-center">
        <div class="col pr-0">
            {{$item['title']??null}}
            <input type="hidden" name="questionnaire[{{$key}}][id]" value="{{$item['id'] ?? 0}}">
            <input type="hidden" name="questionnaire[{{$key}}][title]" value="{{$item['title'] ?? null}}">
        </div>
        <div class="col-auto pl-0">
            <a href="javascript:void(0)" data-id="{{$key}}" class="text-danger item-remove-field">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                    <path d="M14.2586 6.05V5.39C14.2586 4.46591 14.2586 4.00387 14.081 3.65092C13.9248 3.34045 13.6754 3.08803 13.3688 2.92984C13.0202 2.75 12.5639 2.75 11.6512 2.75H10.3475C9.43482 2.75 8.97848 2.75 8.62988 2.92984C8.32325 3.08803 8.07395 3.34045 7.91771 3.65092C7.74009 4.00387 7.74009 4.46591 7.74009 5.39V6.05M9.36972 10.5875V14.7125M12.629 10.5875V14.7125M3.66602 6.05H18.3327M16.7031 6.05V15.29C16.7031 16.6761 16.7031 17.3692 16.4366 17.8986C16.2023 18.3643 15.8283 18.743 15.3684 18.9802C14.8455 19.25 14.161 19.25 12.7919 19.25H9.20676C7.83774 19.25 7.15323 19.25 6.63034 18.9802C6.17038 18.743 5.79643 18.3643 5.56207 17.8986C5.29565 17.3692 5.29565 16.6761 5.29565 15.29V6.05" stroke="#F00404" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</div>
@else
<div class="form-group mb-4 question-item">
    <div class="row align-items-center">
        <div class="col pr-0">
            <input type="hidden" name="questionnaire[{{$key}}][id]" value="{{$item['id'] ?? 0}}">
            <input type="text" name="questionnaire[{{$key}}][title]" value="{{$item['title'] ?? null}}" class="form-control text-black" placeholder="{{trans("label.new_question_placeholder")}}" autocomplete="off">
        </div>
        <div class="col-auto pl-0">
            <a href="javascript:void(0)" data-id="{{$key}}" class="text-danger ml-4 item-remove-field">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                    <path d="M14.2586 6.05V5.39C14.2586 4.46591 14.2586 4.00387 14.081 3.65092C13.9248 3.34045 13.6754 3.08803 13.3688 2.92984C13.0202 2.75 12.5639 2.75 11.6512 2.75H10.3475C9.43482 2.75 8.97848 2.75 8.62988 2.92984C8.32325 3.08803 8.07395 3.34045 7.91771 3.65092C7.74009 4.00387 7.74009 4.46591 7.74009 5.39V6.05M9.36972 10.5875V14.7125M12.629 10.5875V14.7125M3.66602 6.05H18.3327M16.7031 6.05V15.29C16.7031 16.6761 16.7031 17.3692 16.4366 17.8986C16.2023 18.3643 15.8283 18.743 15.3684 18.9802C14.8455 19.25 14.161 19.25 12.7919 19.25H9.20676C7.83774 19.25 7.15323 19.25 6.63034 18.9802C6.17038 18.743 5.79643 18.3643 5.56207 17.8986C5.29565 17.3692 5.29565 16.6761 5.29565 15.29V6.05" stroke="#F00404" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </div>
</div>
@endif
@empty
@if ($display??false)

@endif
@endforelse

{{-- <script type="text/javascript">
var $wrapper = $('#questionnaire-list');
// Remove buttons
var quest_remove_url = '{{route("questionnaire.remove", ["job" => $job])}}';
$('.question-item', $wrapper).on("click", ".item-remove-field", function() {
    $key = JSON.stringify({key: $(this).attr('data-id')});
    processAjaxOperation(quest_remove_url, 'POST', $key, 'applicaion/json')
    // $(this).parents('.question-item').remove();
});
</script> --}}
