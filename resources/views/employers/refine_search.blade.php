{!! Form::open(['id' => 'employer-search']) !!}


<div class="location-form">
    <div class="colapce-about">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="mb-3">Location</h3>
                    {{-- <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="" aria-expanded="true">Location</a> --}}
                </div>
                <div id="collapse1" class="panel-collapse in collapse show" style="">
                    <div class="panel-body">
                        <div class="form-location-input">
                            @include('components.state', [
                                'states' => $stateFilter ?? [],
                                'selected' => $input['state_id'] ?? null,
                                'multiple' => false,
                                'data-placeholder' => __('label.search_by_state'),
                                'dependent' => true,
                            ])
                        </div>
                    </div>
                </div><br>
                <div id="collapse1" class="panel-collapse in collapse show border-bottom pb-4 mb-4" style="">
                    <div class="panel-body">
                        <div class="form-location-input">
                            @include('components.location', [
                                'locations' => $locationFilter ?? [],
                                'selected' => $input['location_id'] ?? null,
                                'multiple' => false,
                                'data-placeholder' => __('label.search_by_location'),
                                'dependent' => true,
                            ])
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="mb-3">Company</h3>
                    {{-- <a data-toggle="collapse" data-parent="#accordion" href="#collapse9" class="collapsed" aria-expanded="true">Company</a> --}}
                </div>
                <div id="collapse9" class="panel-collapse in collapse show">
                    <div class="panel-body">
                        <div class="form-job-type-input">
                            {!! Form::text('company', $input['company'] ?? null, [
                                'class' => 'form-control form-control-lg',
                                'placeholder' => __('label.company'),
                                'autocomplete' => 'off',
                                'id' => 'company',
                            ]) !!}
                            {{-- {!! Form::select('company', $companiesFilter??null, old('company', null), ['class' => 'form-control select2'. (isset($errors) && $errors->has('company') ? ' is-invalid' : ''), 'data-placeholder'=> trans('label.company'), 'multiple' => false,'id' =>'company']) !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div class="filter-button">
	<a href="" class="btn btn-filtter" >Reset <i class="fal fa-long-arrow-right"></i></a>
</div> --}}
{!! Form::close() !!}
