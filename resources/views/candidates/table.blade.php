@section('third_party_stylesheets')
    @include('layouts.datatables_css')
@endsection
<div class="row mb-50">
    <div class="col-lg-3 filter-list side_scroll">
        <div class="d-flex align-items-center justify-content-between mb-20">
            <h3>Filters</h3>
            <div class="d-flex align-items-center">
                <span class="more_search d-block d-lg-none mr-3" title="" data-toggle="tooltip"
                    data-original-title="Advance Search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44"
                        fill="none">
                        <rect width="44" height="44" rx="8" fill="#F6FAFE"></rect>
                        <path d="M28.3996 18.8L21.9996 25.2L15.5996 18.8" stroke="#357de8" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
                <a href="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44"
                        fill="none">
                        <rect width="44" height="44" rx="8" fill="#F6FAFE"></rect>
                        <path
                            d="M13.1992 20.2222C13.1992 20.2222 13.306 19.4673 16.3989 16.3431C19.4919 13.219 24.5066 13.219 27.5995 16.3431C28.6953 17.4501 29.4029 18.8006 29.7223 20.2222M13.1992 20.2222V14.8889M13.1992 20.2222H18.4792M30.7992 23.7778C30.7992 23.7778 30.6925 24.5327 27.5995 27.6569C24.5066 30.7811 19.4919 30.7811 16.3989 27.6569C15.3031 26.5499 14.5955 25.1994 14.2762 23.7778M30.7992 23.7778V29.1111M30.7992 23.7778H25.5192"
                            stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
            </div>
        </div>
        @includeFirst(
            [$entity['view'] . '.refine_search', 'components.search'],
            [
                'form_id' => isset($entity['targetModel']) ? "search-{$entity['targetModel']}" : 'search-form',
            ]
        )
    </div>

    <div class="col-lg-9 candidate_list p-0">
        @include('candidates.list-candidates')
    </div>
</div>
@section('third_party_scripts')
    @include('vendor.job.search', [
        'id' => isset($entity['targetModel']) ? "{$entity['targetModel']}-datatable" : 'dataTableBuilder',
        'form_id' => isset($entity['targetModel']) ? "search-{$entity['targetModel']}" : 'search-form',
    ])
@endsection
<script>
    $(document).ready(function() {
        $(".more_search").click(function() {
            $("#candidate-search").toggleClass("active");
            $(".filter-list").toggleClass("active");
        });
    });
</script>
