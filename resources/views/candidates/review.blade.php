<div class="review_main_wraper pb-40 mt-30">
    <div class="row">
        <div class="col-md-4 col-lg-3 left_side mb-30 mb-md-0">
            @include('candidates.badges', ['badges' => $badges])
        </div>
        <div class="col-md-8 col-lg-9 right_side">
            <div class="review-list mx-lg-0">
                @include('candidates.inner_review', ['reviews' => $reviews])
            </div>
        </div>
    </div>
</div>
@push('page_scripts')
    @include('candidates.review_script')
@endpush
