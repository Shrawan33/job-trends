<div class="row">
    <div class="col-12">
    <div class="clearfix"></div>
    @include('flash::message')
    <div class="clearfix"></div>
    </div>
    {{-- <div class="col-12">
    @includeFirst([$entity['view'].'.search'])
    </div> --}}
    <div class="col-12">
    @includeFirst([$entity['view'].'.table', 'components.table'])
    </div>
</div>
