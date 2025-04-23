<input type="hidden" name="active_tab" id="active_tab" value="basic-tab">
{!! Form::hidden('review_type', 1, ['class' => 'form-control', 'id' => 'review_type']) !!}

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link review-type-tab active" id="basic-tab" data-toggle="tab" data-target="#basic"
            type="button" role="tab" aria-controls="basic" aria-selected="true">Basic</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link review-type-tab" id="advance-tab" data-toggle="tab" data-target="#advance"
            type="button" role="tab" aria-controls="advance" aria-selected="false">Advance</button>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
        {{-- @dd($review_count) --}}
        @if ($review_count['basic_review_count'] > 0)
            @include($entity['view'] . '.no_review')
        @else
            @include($entity['view'] . '.basic_fields')
        @endif

    </div>
    <div class="tab-pane fade" id="advance" role="tabpanel" aria-labelledby="advance-tab">
        @if (auth()->user() &&
                auth()->user()->hasRole('jobseeker'))
            @if ($review_count['advance_review_count'] > 0)
                @include($entity['view'] . '.no_review')
            @else
                @include($entity['view'] . '.advance_fields')
            @endif
        @else
            @include($entity['view'] . '.no_review_permission')
        @endif
    </div>
</div>
{{-- <script>
$(document).ready(function() {
    var basicReviewCount = {!! $review_count['basic_review_count'] !!};
    var advanceReviewCount = {!! $review_count['advance_review_count'] !!};

    console.log('Basic Review Count:', basicReviewCount);
    console.log('Advance Review Count:', advanceReviewCount);

    // Initial check to hide "Save" button if both counts are 1
    if (basicReviewCount === 1 && advanceReviewCount === 1) {
        hideSaveButton();
    }

    $('.nav-link.review-type-tab').on('click', function() {
        var tabId = this.id;
        $('#active_tab').val(tabId);

        if (tabId == 'basic-tab') {
            $('#review_type').val(1);
            if (basicReviewCount === 1) {
                hideSaveButton();
            } else {
                showSaveButton();
            }
        } else {
            $('#review_type').val(2);
            if (advanceReviewCount === 1) {
                hideSaveButton();
            } else {
                showSaveButton();
            }
        }
    });
});

</script> --}}



