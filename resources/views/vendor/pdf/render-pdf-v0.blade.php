<div id="pdfCanvas" class="col-sm-12 pdf-canvas">
    <nav aria-label="...">
        <ul class="pager">
            <li><a href="javascript:void(0)" id="prev">Previous</a></li>
            <li><span>Page: <span id="page_num"></span> / <span id="page_count"></span></span></li>
            <li><a href="javascript:void(0)" id="next">Next</a></li>
        </ul>
    </nav>
    <canvas id="render-pdf"></canvas>
</div>
@push('scripts')
<script src="{{asset('vendor/pdfjs/2.4.456/pdf.min.js')}}"></script>
<script>
    var response = "{!!$response ?? ''!!}";
    var form_id = "{!!$form_id ?? ''!!}";
    var action_url = "{!!$action_url ?? ''!!}";
    var pdfjsLib = window['pdfjs-dist/build/pdf'];
    // The workerSrc property shall be specified.
    pdfjsLib.GlobalWorkerOptions.workerSrc = "{{asset('vendor/pdfjs/2.4.456/pdf.worker.min.js')}}";

    var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    scale = 1.5,
    canvas = document.getElementById('render-pdf'),
    ctx = canvas.getContext('2d');

    /**
    * Get page info from document, resize canvas accordingly, and render page.
    * @param num Page number.
    */
    function renderPage(num) {
        pageRendering = true;
        // Using promise to fetch the page
        pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport({scale: scale});
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            // Render PDF page into canvas context
            var renderContext = {
                canvasContext: ctx,
                viewport: viewport
            };
            var renderTask = page.render(renderContext);

            // Wait for rendering to finish
            renderTask.promise.then(function() {
                pageRendering = false;
                if (pageNumPending !== null) {
                    // New page rendering is pending
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
                $('#pdfCanvas').show();
            });
        });
        // Update page counters
        document.getElementById('page_num').textContent = num;
    }

    /**
    * If another page rendering in progress, waits until the rendering is
    * finised. Otherwise, executes rendering immediately.
    */
    function queueRenderPage(num) {
        if (pageRendering) {
            pageNumPending = num;
        } else {
            renderPage(num);
        }
    }

    /**
    * Displays previous page.
    */
    function onPrevPage() {
        if (pageNum <= 1) {
            return;
        }
        pageNum--;
        queueRenderPage(pageNum);
    }
    document.getElementById('prev').addEventListener('click', onPrevPage);

    /**
    * Displays next page.
    */
    function onNextPage() {
        if (pageNum >= pdfDoc.numPages) {
            return;
        }
        pageNum++;
        queueRenderPage(pageNum);
    }
    document.getElementById('next').addEventListener('click', onNextPage);

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
        var pdfData = atob(response)
        // Using DocumentInitParameters object to load binary data.
        var loadingTask = pdfjsLib.getDocument({data: pdfData});
        loadingTask.promise.then(function(pdf) {
            // console.log('PDF loaded');
            // console.log(pdf.numPages);
            pdfDoc = pdf;
            document.getElementById('page_count').textContent = pdfDoc.numPages;

            // Initial/first page rendering
            renderPage(pageNum);

        }, function (reason) {
            // PDF loading error
            console.error(reason);
        });
    }

    if (response!='') {
        loadPDF(response)
    }
</script>
@endpush
