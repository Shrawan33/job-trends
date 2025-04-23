<div class="modal fade" id="modal" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{trans('label.image_cropper')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-8">
                            <img id="image" src="" alt="No Image Available">
                        </div>
                        <div class="col-4">
                            <div class="preview"></div>
                            <div class="docs-data">
                                <div class="input-group input-group-sm">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text" for="dataWidth">{{ trans('label.width') }}</label>
                                        </span>
                                        <input type="text" class="form-control" id="dataWidth" placeholder="{{ trans('label.width') }}">
                                        <span class="input-group-append">
                                            <span class="input-group-text">px</span>
                                        </span>
                                    </div>
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text" for="dataHeight">{{ trans('label.height') }}</label>
                                        </span>
                                        <input type="text" class="form-control" id="dataHeight" placeholder="{{ trans('label.height') }}">
                                        <span class="input-group-append">
                                            <span class="input-group-text">{{ trans('label.px') }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('label.cancel') }}</button>
                <button type="button" class="btn btn-primary" id="crop">{{ trans('label.crop') }}</button>
            </div>
        </div>
    </div>
</div>
