<input type="hidden" value="{{url()->current()}}" id="copy_url_input" >
<a href="javascript:void(0);" onclick="copyToClipboard('#copy_url_input')" data-toggle="tooltip" data-placement="top" title="{!! __('label.share_btn_title')!!}" id="shareJob" class="btn btn-circle rounded-pill btn-outline-primary btn-sm"><i class="fa fa-share"></i></a>
