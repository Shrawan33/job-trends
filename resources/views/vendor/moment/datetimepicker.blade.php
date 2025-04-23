@push('page_scripts')
<script>
    $(document).ready(function(){
        @if(isset($dateFields))
            @foreach ($dateFields as $dateElemId => $dateVal)
                var dateVal = "{{ $dateVal }}";
                dateVal = moment(dateVal).format("{{ config('constants.format.moment_date') }}");
                $('#{{ $dateElemId }}').data("DateTimePicker").date(dateVal)
            @endforeach
        @endif
        @if(isset($dateTimeFields))
            @foreach ($dateTimeFields as $dateElemId => $dateVal)
                var dateVal = "{{ $dateVal }}";
                dateVal = moment(dateVal).format("{{ config('constants.format.moment_datetime') }}");
                $('#{{ $dateElemId }}').data("DateTimePicker").date(dateVal)
            @endforeach
        @endif
    });
</script>
@endpush
