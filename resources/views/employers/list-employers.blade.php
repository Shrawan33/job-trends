<div class="list-item-view side_scroll px-3" id="load">
    <p class="text-black mb-4 show_result_text">{!! __('label.showing') !!} {{$employers->firstItem()??0}}-{{$employers->lastItem()}} of {{$employers->total()}} {!! __('label.result') !!}</p>
    @php

       if ($entity['prefix'] == 'account') {

            $prefix = 'account.' ;
        } elseif ($entity['prefix'] == 'mentor') {

            $prefix = 'mentor.';
        } else {

            $prefix = '';
        }

    @endphp
    {{-- @if(isset($prefix) && $prefix != "account." && $prefix != "mentor.")
        <div class="row">
            <div class="col-12">
                <div class="d-inline-flex ml-2">
                {!! Form::checkbox('select_all',null, null,['class' => 'select_all', 'id' => 'select_all', 'label' => __('label.select_all')]) !!}
                </div>
                <a href="javascript:void(0)" onclick="sendGroupMessage(this)" title="{{trans('label.send_group_msg')}}" class="btn btn-link py-0 text-secondary"> {!! __('label.send_group_msg') !!}</a>
            </div>
        </div>
    @endif --}}
        <div class="row mt-3">

            @forelse($employers as $employer)

            @include('employers.card',['class' => "col-md-12", 'from' => 'employer-list'])

            @empty
            <div class="col-12">
            <h4 class="text-center">{!! __('label.no_data_found') !!}</h4>
            </div>
            @endforelse

        </div>
    </div>
    {!! $employers->render('vendor.pagination.custom') !!}
    @push('page_scripts')
    <script>
    $(document).ready(function(){
        $('.candidate_list').on('change', '#select_all', function () {
            $('.candidate-checkbox').prop('checked', this.checked)
        });
    })

    function sendGroupMessage(object) {
        var selectedLength = $('.candidate-checkbox:checked').length;
        if (selectedLength > 0) {
            var url = "{{route('send.group.messageForm')}}";
            var requestdata = {'users': []};
            $('.candidate-checkbox:checked').map((key, item) => { return requestdata.users.push(item.value); });
            getForm(url, requestdata, 'message', object.title, 'modal-lg', "{{trans('label.send')}}");
        } else {
            toastr.error("{{trans('message.no_candidate_selected_to_send_group_message')}}");
        }
    }
    </script>
    @endpush
