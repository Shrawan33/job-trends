@extends('layouts.ajax')

@section('content')
    {!! Form::open(['route' => $entity['url'].'.assign-to-employer', 'id' => 'frm_'.$entity['targetModel']]) !!}
    <div class="row">
        {!! Form::hidden('employer_id', $employer->id??null, null) !!}
        {!! Form::hidden('assign_id', $assignEmployerId??0, null) !!}
        <!-- Account Mangers Field -->
        <div class="form-group col-sm-12">
            {!! Form::select('account_manager_id', $accountManagers??[], $accountAssignIDs??null, ['class' => 'form-control', 'placeholder' => 'Select Account Manager','id' => 'select_account']) !!}
            <span class="help-block"></span>
        </div>

    {!! Form::close() !!}
@endsection
