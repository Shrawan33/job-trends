<div class="row">

    <!-- User Id Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('badge_id', 'Review Category:') !!}
        {!! Form::select('badge_id', $badges ?? null, null, ['class' => 'form-control custom-select']) !!}
        <span class="help-block"></span>
    </div>

    <!-- Review Category Type Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('review_category_type', 'Review Category Type:') !!}
        {!! Form::select('review_category_type', $review_category_types, null, ['class' => 'form-control custom-select']) !!}
        <span class="help-block"></span>
    </div>


    <!-- Title Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
        <span class="help-block"></span>
    </div>

</div>
