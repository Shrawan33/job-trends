
    <div class="pull-right">

        <div id="statisticsrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 6px 14px; border: 1px solid #ccc; margin-top: 0px; margin-left:18px" >
            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
             {!! Form::hidden('start_date', null, ['id' => 'startDate']) !!}
             {!! Form::hidden('end_date',null, ['id' => 'endDate']) !!}
            <span></span> <b class="caret"></b>
        </div>
    </div>


    @push('page_css')
    <link rel="stylesheet" type="text/css" href="{{asset("vendor/bootstrap-daterangepicker/3.14.1/daterangepicker.min.css") }}" />

    @endpush

    @push('page_scripts')
    <script type="text/javascript" src="{{asset("vendor/bootstrap-daterangepicker/3.14.1/daterangepicker.min.js") }}"></script>
    <script>

        var chartGroupBy = 'day';
        var dateRanges = {!! FunctionHelper::dateRangeOptions() !!};
        var startDate;
        var endDate;
        var lastRange;

        $(document).ready(function() {

            // Initialize date range selector
            startDate = moment().subtract(29, 'days');
            endDate = moment();
            lastRange = false;

            if (isStorageAvailable()) {
                lastRange = localStorage.getItem('last:report_range');

            }

            if (!lastRange) {
                lastRange = "Last 30 Days";
            }

            dateRange = dateRanges[lastRange];
            if (dateRange) {
                startDate = dateRange[0];
                endDate = dateRange[1];
            }

            function cb(start, end, label) {
                console.log(start, end, label);
                $('#statisticsrange span').html(start.format('{{ config("constants.format.moment_date") }}') + ' - ' + end.format('{{ config("constants.format.moment_date") }}'));
                startDate = start;
                endDate = end;
                $('#startDate').val(start.format('{{ config("constants.format.sql_date") }}'));
                $('#endDate').val(end.format('{{ config("constants.format.sql_date") }}'));
                // loadDataTable
                window.LaravelDataTables["{{ $id }}"].draw();

                if (isStorageAvailable() && label && label != "Custom Range") {
                    localStorage.setItem('last:report_range', label);
                }
            }

            $('#statisticsrange').daterangepicker({
                locale: {
                    format: "{{ config('constants.format.moment_date') }}",
                    customRangeLabel: "Custom Range",
                    applyLabel: "Filter",
                    cancelLabel: "Cancel",
                },
                startDate: startDate,
                endDate: endDate,
                linkedCalendars: false,
                ranges: dateRanges,
            }, cb);

            cb(startDate, endDate, lastRange);
        });
</script>
    @endpush
