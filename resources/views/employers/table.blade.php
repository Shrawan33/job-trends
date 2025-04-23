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
                <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none">
                        <path
                            d="M2 10C2 10 2.12132 9.15076 5.63604 5.63604C9.15076 2.12132 14.8492 2.12132 18.364 5.63604C19.6092 6.88131 20.4133 8.40072 20.7762 10M2 10V4M2 10H8M22 14C22 14 21.8787 14.8492 18.364 18.364C14.8492 21.8787 9.15076 21.8787 5.63604 18.364C4.39076 17.1187 3.58669 15.5993 3.22383 14M22 14V20M22 14H16"
                            stroke="#357de8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
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

    <div class="col-lg-9 employer_list p-0 candidate_list">
        @include('employers.list-employers')
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
            $("#employer-search").toggleClass("active");
            $(".filter-list").toggleClass("active");
        });
    });
</script>
