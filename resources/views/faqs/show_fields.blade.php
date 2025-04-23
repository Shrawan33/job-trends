
<!-- Question Field -->
<div class="col-sm-12">
    {!! Form::label('question', trans('label.question').':') !!}
    <p>{{ $faq->question }}</p>
</div>

<!-- Answer Field -->
<div class="col-sm-12">
    {!! Form::label('answer', trans('label.answer').':') !!}
    <p>{{ $faq->answer }}</p>
</div>



