@extends('layouts.front')

@section('content')

<div class="container">
    <div class="">
        <div class="col-md-12 mt-4 px-lg-0">
            <div class="job_top_banner bg_frame position-relative mb-4">
                <img src="{{ asset('images/inner_banner.png') }}" alt="fea_img" width="100%" class="inner_banner">
                <h1 class="my-3 position-relative">Find {{$categoryFilter->title??''}} Jobs</h1>
            </div>
        </div>
        {!! Form::open(['id' => 'check-search']) !!}
        <div class="col-12 search_job_form_wraper pt-20 border-top mb-3 mb-lg-0 border-bottom pb-0 px-lg-0">
            {{-- @includeFirst([$entity['view'].'.search']) --}}
            <div class="filter-list">
                @includeFirst([$entity['view'].'.refine_search', 'components.search'], ['form_id' => isset($entity['targetModel']) ? "search-{$entity['targetModel']}" : 'search-form'])
            </div>
        </div>
        <div class="col-12 px-lg-0">
            <div class="clearfix"></div>
            @include('flash::message')
            <div class="clearfix"></div>

        </div>

        <div class="col-12 mb-5 px-lg-0">
        @includeFirst([$entity['view'].'.table', 'components.table'])
        </div>
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@push('page_scripts')
{{-- <script>
$(function() {
        // var url = $(this).attr('href');
        // // window.history.pushState("", "", url);
        // formdata = $("form#check-search").serialize();
        // loadJobs(url, formdata);
    $("form#check-search").find('select,input[type="checkbox"],input[type="radio"]').on('change', function() {
        var formdata = $("form#check-search").serialize();
        var url = "{{route($entity['url'].'.search')}}";
        loadJobs(url, formdata);
    });

    $("form#check-search").find('input[type="text"]').on('keyup', function() {
        var formdata = $("form#check-search").serialize();
        var url = "{{route($entity['url'].'.search')}}";
        loadJobs(url, formdata, $("#sort_by").val());
    });


    $(document).on('change', '#sort_by', function() {
        var sortby = $(this).val();
        var url = "{{route($entity['url'].'.search')}}";
        var formdata = $("form#check-search").serialize();
        loadJobs(url, formdata, sortby);
    });

    $('.btnreset').click(function() {
        $("form#check-search").find('select, input[type="text"]').val("").trigger('change');
        $("form#check-search").find('input[type="checkbox"],input[type="radio"]').prop('checked',false);
        var url = "{{route($entity['url'].'.search')}}";
        loadJobs(url, "", "");
    });

    $('body').on('click', '.pagination a', function(e) {
        e.preventDefault();

        var url = $(this).attr('href');
        // window.history.pushState("", "", url);
        formdata = $("form#check-search").serialize();
        loadJobs(url, formdata, $("#sort_by").val());
        // window.scrollTo(0, 0);
    });

    // $('body').on('load', '.pagination a', function(e) {
    //     e.preventDefault();


    // });

    function loadJobs(url, formdata) {
        $.ajax({
            type: "GET",
            url: url,
            data: formdata,
            success: function(response) {
                console.log(response.data);
                $('.job-list').html('');
                $('.job-list').html(response.data);
            },
            error: function() {
                console.log("Failed to load data!");
            }
        });
    }

    function loadJobs(url, formdata, sortby) {
        console.log(formdata);
        if(sortby!="")
        {
            if(url.indexOf('?')!=-1)
            {
                url = url.replace("#search","")+"&sortby="+sortby;
            }
            else {
                url = url.replace("#search","")+"?sortby="+sortby;
            }
        }
        $.ajax({
            type: "POST",
            url: url,
            data: formdata,
            success: function(response) {
                // console.log(response.data);
                $('.job-list').html('');
                $('.job-list').html(response.data);
                $('#sort_by').val(sortby);

                $("#sort_by").change(function() {
                    var sortby = $(this).val();
                    var url = "{{route($entity['url'].'.search')}}";
                    var formdata = $("form#check-search").serialize();
                    loadJobs(url, formdata, sortby);
                });
                $('html, body').animate({
                   scrollTop: $("#check-search").offset().top
                }, 100);
            },
            error: function() {
                console.log("Failed to load data!");
            }
        });
    }
});
</script> --}}

{{-- <script>
    $(function() {
        $("form#check-search").find('select,input[type="checkbox"],input[type="radio"]').on('change', function() {
            var formdata = $("form#check-search").serialize();
            var url = "{{route($entity['url'].'.search')}}";
            loadJobs(url, formdata);
        });

        $("form#check-search").find('input[type="text"]').on('keyup', function() {
            var formdata = $("form#check-search").serialize();
            var url = "{{route($entity['url'].'.search')}}";
            loadJobs(url, formdata, $("#sort_by").val());
        });

        $(document).on('change', '#sort_by', function() {
            var sortby = $(this).val();
            var url = "{{route($entity['url'].'.search')}}";
            var formdata = $("form#check-search").serialize();
            loadJobs(url, formdata, sortby);
        });

        $('.btnreset').click(function() {
            $("form#check-search").find('select, input[type="text"]').val("").trigger('change');
            $("form#check-search").find('input[type="checkbox"],input[type="radio"]').prop('checked', false);
            var url = "{{route($entity['url'].'.search')}}";
            loadJobs(url, "", "");
        });

        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            var url = $(this).attr('href');
            formdata = $("form#check-search").serialize();
            loadJobs(url, formdata, $("#sort_by").val());
        });

        function loadJobs(url, formdata, sortby = "") {
            $.ajax({
                type: "POST",
                url: url,
                data: formdata + "&sort_by=" + sortby, // Include sort order in form data
                success: function(response) {
                    $('.job-list').html(response.data);
                    $('#sort_by').val(sortby);
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Request Error:", error);
                }
            });
        }
    });
</script> --}}

<script>
    $(function() {
        // Set the default sort order
        var defaultSort = "newest";

        $("form#check-search").find('select,input[type="checkbox"],input[type="radio"]').on('change', function() {
            var formdata = $("form#check-search").serialize();
            var url = "{{route($entity['url'].'.search')}}";
            loadJobs(url, formdata);
        });

        $("form#check-search").find('input[type="text"]').on('keyup', function() {
            var formdata = $("form#check-search").serialize();
            var url = "{{route($entity['url'].'.search')}}";
            loadJobs(url, formdata, $("#sort_by").val());
        });

        $(document).on('change', '#sort_by', function() {
            var sortby = $(this).val();
            var url = "{{route($entity['url'].'.search')}}";
            var formdata = $("form#check-search").serialize();
            loadJobs(url, formdata, sortby);
        });

        $('.btnreset').click(function() {
            $("form#check-search").find('select, input[type="text"]').val("").trigger('change');
            $("form#check-search").find('input[type="checkbox"],input[type="radio"]').prop('checked', false);
            var url = "{{route($entity['url'].'.search')}}";
            loadJobs(url, "", defaultSort); // Set default sort order on reset
        });

        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();

            var url = $(this).attr('href');
            formdata = $("form#check-search").serialize();
            loadJobs(url, formdata, $("#sort_by").val());
        });

        // Load jobs on page load with default sort order
        var url = "{{route($entity['url'].'.search')}}";
        var formdata = $("form#check-search").serialize();
        loadJobs(url, formdata, defaultSort);

        function loadJobs(url, formdata, sortby = "") {
            if (sortby === "") {
                sortby = defaultSort; // Set default sort order if no sort order is provided
            }
            $.ajax({
                type: "POST",
                url: url,
                data: formdata + "&sort_by=" + sortby, // Include sort order in form data
                success: function(response) {
                    $('.job-list').html(response.data);
                    $('#sort_by').val(sortby);
                    $('html, body').animate({
                    scrollTop: $("#check-search").offset().top
                    }, 100);
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Request Error:", error);
                }
            });
        }
    });
</script>




@endpush
