<div class="col-sm-12">
    <div class="embed-responsive embed-responsive-16by9">
        <div id="iframe-loader"></div>
        <iframe id="pdfCanvas" class="embed-responsive-item" src="" frameborder="0">
        </iframe>
    </div>
</div>
<script>
    var justloaded = 1;
    var response = "{!!$response ?? ''!!}";
    var form_id = "{!!$form_id ?? ''!!}";
    var action_url = "{!!$action_url ?? ''!!}";

    var iframedom = document.getElementById('pdfCanvas');
    var iframe_url = "{{asset('vendor/pdfjs/2.5.207/web/viewer.html')}}";
    var xhr = null;
    function renderPDF() {

        if( xhr != null ) {
            xhr.abort();
            xhr = null;
        }

        if (form_id == '' || action_url == '') {
            throw('please make sure that form_id and action_url are set properly to process pdf.');
            return false;
        }

        var form_data = $('form#'+form_id).serialize();
        xhr = $.ajax({
            url: action_url,
            type: 'PUT',
            data: form_data,
            success: function(response) {
                // console.log(response);
                loadPDF(response);
            }
        });
    }

    function loadPDF(response) {
        if (isStorageAvailable()) {
            localStorage.setItem('pdfBase64',response);
        }
        if (justloaded > 1) {
            iframedom.contentWindow.location.reload();
        } else {
            setTimeout(function (){
                iframedom.src = iframe_url;
                $('#iframe-loader').hide();
            }, 700);
            justloaded = justloaded + 1
        }
    }

    if (response!='') {
        loadPDF(response)
    }
</script>
