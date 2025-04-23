var $modal = $('#modal');
var $image = $('#image');
var $download = $('#download');
var $dataHeight = $('#dataHeight');
var $dataWidth = $('#dataWidth');
var $imgHeight = '';
var $imgWidth = '';
var $imgInput = '';
var $imgInputName = '';
var $imgIdInputName = '';
var $imgPreviewClass = '';
var $imgContainer = '';
var $remainingLimit = 5;

$(document).ready(function () {
    // Start: Image Cropper
    $("body").on("change", ".image-file-upload", function (e) {
        $imgInput = $(this);
        $imgContainerClass = $imgInput.attr('data-container')
        $imgIdInputName = $imgInput.attr('data-idName');
        // console.log($imgIdInputName);
        $imgInputName = $imgInput.attr('data-name');
        $imgHeight = $imgInput.attr('data-height');
        $imgWidth = $imgInput.attr('data-width');
        $remainingLimit = $imgInput.attr('data-limit');

        //console.log('imgInput: ', $imgInput);
        //console.log('imgInputName: ', $imgInputName);
        //console.log('imgHeight: ', $imgHeight);
        //console.log('imgWidth: ', $imgWidth);
        //console.log('previewClass: ', $imgPreviewClass);

        var files = e.target.files;
        var done = function (url) {
            $image.attr('src', url);
            $image.css('height', '499px');
            $image.css('width', '100%');
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function () {
        $image.cropper({
            viewMode: 0,
            aspectRatio: NaN,
            preview: '.preview',
            ready: function (e) {
                $(this).cropper('setData', {
                    height: $imgHeight,
                    width: $imgWidth
                });
            },
            crop: function (e) {
                $dataWidth.val(Math.round(e.detail.width));
                $dataHeight.val(Math.round(e.detail.height));
            }
        });
    }).on('hidden.bs.modal', function () {
        $image.cropper('destroy');
    });

    $('.cropper-size-text').on("change",function() {
        let getimagedata = $image.cropper("getData");
        // console.log('before, ',getimagedata);
        if ($(this).val()!='' && $(this).val() > 0) {
            getimagedata.width = parseInt($('#dataWidth').val());
            getimagedata.height = parseInt($('#dataHeight').val());
            // console.log('after, ',getimagedata);
            $image.cropper("setData", getimagedata);
        }
    });

    $("#crop").on("click",function () {
        // console.log('height:', $imgHeight);
        // console.log('width:', $imgHeight);
        canvas = $image.cropper("getCroppedCanvas");
        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            $imgContainer = $('.'+$imgContainerClass).find('.to-clone').clone();
            // console.log($imgIdInputName);
            $('input[for="idName"]:hidden', $imgContainer).attr('name', $imgIdInputName);
            $('input[for="image"]:hidden', $imgContainer).attr('name', $imgInputName);
            $('.img-preview', $imgContainer).html('<img src="' + url + '" class="img-responsive" alt="No Image Cropped Yet" />');
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var base64data = reader.result;
                $('input[for="idName"]:hidden', $imgContainer).val(0);
                $('input[for="image"]:hidden', $imgContainer).val(base64data);
                $imgContainer = $($imgContainer).removeClass('d-none to-clone');//.removeClass('to-clone');
                $imgContainer.appendTo('.'+$imgContainerClass);
                // image limit
                $remainingLimit = parseInt($remainingLimit) - 1;
                console.log($remainingLimit);
                setRemainingLimit($remainingLimit)
                $modal.modal('hide');
            }
        });
    });

    // remove image
    $(document).on('click', '.remove-image-container', function(){
        var file_input_name = $(this).attr('data-input_name');
        $imgInput = $('[name='+file_input_name+']');
        // console.log($imgInput, file_input_name);
        availlimit = $imgInput.attr('data-limit');
        availlimit = parseInt(availlimit) + 1;
        setRemainingLimit(availlimit)
        $(this).parent('div').remove();
    })
    // End: Image Cropper
});

function setRemainingLimit(limit)
{
    $($imgInput).attr('data-limit', limit)
    if (limit > 0) {
        $($imgInput).parent('div').removeClass('d-none');
    } else {
        $($imgInput).parent('div').addClass('d-none');
    }
}
