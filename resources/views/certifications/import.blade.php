
<div class="row">

    <!-- import Field -->
<div class="form-group col-sm-12">
    {!! Form::open(['route' => 'certifications.import', 'id' => 'frm_skill', 'files'=>true])!!}

        {!! Form::label('import_file', 'Choose File:') !!}
        {!! Form::file('import_file', null, ['class' => 'form-control']) !!}


    <span class="help-block"></span>
    {!! Form::close() !!}
</div>

</div>
