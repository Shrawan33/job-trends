<hr>
<div>
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <span><b>{{trans('label.created_by')}}</b></span><br>
                    <span>{{ !empty($config['model']->createdByUser) ? $config['model']->createdByUser->name : ' ' }}</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <span><b>{{trans('label.last_updated_by')}}</b></span><br>
                    <span>{{ !empty($config['model']->updatedByUser) ? $config['model']->updatedByUser->name : ' ' }}</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <span><b>{{trans('label.create_on')}}</b></span><br>
                    <span>{{  $config['model']->created }}</span>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card bg-light">
                <div class="card-body">
                    <span><b>{{trans('label.last_updated_on')}}</b></span><br>
                    <span>{{ $config['model']->updated }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
