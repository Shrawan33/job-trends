<div class="col-sm-12">
    {!! Form::label('review_category_id', 'Review Category Id:') !!}
    <p>{{ $reviewCategoryStrengthWeekness->reviewCategory->title ?? '' }}</p>
</div>

<!-- Review Category Type Field -->
<div class="col-sm-12">
    {!! Form::label('review_category_type', 'Review Category Type:') !!}
    <p>{{ config("constants.review_category_type.{$reviewCategoryStrengthWeekness->review_category_type}", null) }}</p>
</div>

<!-- Title Field -->
<div class="col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $reviewCategoryStrengthWeekness->title }}</p>
</div>

