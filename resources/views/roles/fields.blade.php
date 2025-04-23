<div class="row">
    <div class="col-md-3">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{trans('label.basic_detail')}}</h3>
            </div>
            <div class="card-body">
                <div class="row" id="basic_details">
                    <!-- Name Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('name', trans('label.roles').':') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    </div>

                    <!-- Title Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('title', trans('label.title_')) !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                    </div>

                    <!-- Guard Name Field -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('guard_name', trans('label.platform').':') !!}
                        {!! Form::select('guard_name', $platforms, 'web', ['class' => 'form-control', 'data-placeholder' => 'Select Platform']) !!}
                    </div>

                    <div class="col-sm-12 error help-block">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-9">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{trans('label.permission')}}</h3>
            </div>
            <div class="card-body">
                <div id="web" class="permission-tables {!! old('guard_name', isset($role) ? $role->guard_name:'web') == 'web' ? '' : 'd-none' !!}">
                    @include('roles.partials.permissions', ['mod_perms' => $permissions['web'], 'platform' => 'web'])
                </div>
                <div id="api" class="permission-tables {!! old('guard_name', isset($role) ? $role->guard_name:null) == 'api' ? '' : 'd-none' !!}">
                    @include('roles.partials.permissions', ['mod_perms' => $permissions['api'], 'platform' => 'api'])
                </div>
            </div>
        </div>
    </div>
</div>
@push('page_scripts')
    <script>
        $(function() {
            $('select#guard_name').on("change", function() {
                $('.permission-tables').addClass('d-none');
                $('div#'+this.value).removeClass('d-none');
            });
        });
    </script>
@endpush
