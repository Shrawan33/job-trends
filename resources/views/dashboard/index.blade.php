@extends('layouts.admin')

@section('content')
<section class="content-header">
    <div class="row">
        <div class="col-md-6">
            <h1>Dashboard</h1>
        </div>
        @hasanyrole('admin')
        <div class="col-md-6">
            <div class="text-right">
                <div id="dashboard-btn-group" class="btn-group" role="group">
                    <button type="button" class="btn btn-primary active" data-button="day">{{ "Today" }}</button>
                    <button type="button" class="btn btn-default" data-button="week">{{ "Last 7 days" }}</button>
                    <button type="button" class="btn btn-default" data-button="month">{{ "Last 30 days" }}</button>
                    <button type="button" class="btn btn-default" data-button="total">{{ "Total" }}</button>
                </div>
            </div>
        </div>
        @endhasanyrole
        <div class="col-md-12 mt-3">
            <h4 class="text-secondary">Welcome, to the Dashboard.</h4>
        </div>
    </div>
</section>
<div class="content">
      <div class="row">
        @hasanyrole('admin')
            <div class="container-fluid">
            <div class="row">
                @include('dashboard.partials.main')
              </div>
            </div>
        @endhasanyrole

    </div>
</div>
@endsection
@push('page_scripts')

<script>

var chartGroupBy = 'day';
var dateRanges = {!! FunctionHelper::dateRangeOptions() !!};
var startDate;
var endDate;
var lastRange;
$(document).ready(function() {

    // Initialize date range selector
    startDate = moment();

    $('#dashboard-btn-group .btn').on('click', function () {
        $(this).addClass('btn-primary').removeClass('btn-default').siblings().removeClass('btn-primary');
        $(this).siblings().addClass('btn-default');
        selected = $(this).data('button');
        if(selected == "week"){
            startDate = moment().subtract(7, 'days');
        }
        else if(selected == "month"){
            startDate = moment().subtract(30, 'days');
        }
        else if(selected == "total"){
            startDate = null;

        }
        else{
            startDate = moment();
        }

        loadData();

    })

    function loadData() {
        var url = "{{ route('dashboard.statistics') }}";
        var data = {"start_date":  startDate !=null ? startDate.format('YYYY-MM-DD') : 0};
        $.ajax({
            url: url,
            method: "POST",
            data: data,
            dataType: "json",
            success: function(response) {
                // console.log(response);
                // response = JSON.parse(response);
                var data = response['data'];

                $('.count_sales').text(data.sales);
                $('.count_employerJob').text(data.employerJob);
                $('.count_employer').text(data.employer);
                $('.count_applyJob').text(data.application);
                $('.count_jobAlert').text(data.jobalert);
                $('.count_jobseeker').text(data.jobseeker);

            }
        });
    }


});

</script>
@endpush
