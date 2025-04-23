@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <h3>Welcome {!! auth()->user()->name !!}, This is TM</h3>
        </div>
    </div>
@endsection
