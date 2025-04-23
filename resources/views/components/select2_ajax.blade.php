@push('page_scripts')
<script>
// var dependent = "{!!$attributes['select-parent']??''!!}";
var options = {
    width: "{!!$attributes['width']??'100%'!!}",
    placeholder: "{!!$attributes['data-placeholder']??'Choose One'!!}",
    allowClear: "{!!$attributes['data-allowclear']??false!!}",
    theme: 'bootstrap4'
};

options['ajax'] = {
    url: "{!!$attributes['ajax-url']??''!!}",
    dataType: 'json',
    data: function (params) {
        var dependent = $(this).attr('select-parent');
        var request_param = JSON.parse('{!!json_encode($attributes["ajax-data"]??[])!!}');
        if (dependent != '' && dependent != undefined) {
            request_param['parent_id'] = $('[name="'+dependent+'"]').val();
        }
        request_param['term'] = params.hasOwnProperty('term')?params.term:''; // search term
        request_param['_type'] = params.hasOwnProperty('_type') ? params['_type'] : 'query';
        // console.log(request_param);
        return Object.assign({}, request_param);
    }
}
// console.log(options);
$("select[name='{!!$name??'noname'!!}']").select2(options);
</script>
@endpush
