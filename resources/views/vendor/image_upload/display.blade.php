@if ($document_type == 2)
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>


    <style>
        .zoomed-img {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .zoomed-img img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            border-radius: 10px;
        }
    </style>
@endif
@if ($document_type == 0)
    @if ($thumbnail ?? false)
        @if (!empty($images['thumbnail_image']))
            @foreach ($images['thumbnail_image'] as $index => $item)
                <div class="img-preview {{ $class_li ?? '' }} job-detail-img">
                    <img src="{!! $item !!}" alt="Image Loading"
                        class="img-fluid {{ $wrapper_class ?? 'user-90' }} mb-3" />
                </div>
            @endforeach
        @endif
    @else
        @if (!empty($images['image']))
            @foreach ($images['image'] as $index => $item)
                <div class="img-preview {{ $class_li ?? '' }} job-detail-img">
                    <img src="{!! $item !!}" alt="Image Loading"
                        class="img-fluid {{ $wrapper_class ?? 'user-90' }} mb-3" />
                </div>
            @endforeach
        @endif
    @endif
@else
    @if (!empty($images['image']))
        <ul class="list-unstyled row mb-0 p-0 m-0">
            @foreach ($images['image'] as $index => $item)
                <li class="col-12 pl-0 {{ $class_li ?? 'col-md-6 col-lg-4' }} job-detail-img">
                    <a href="{!! $item !!}" data-fancybox="gallery">
                        <img src="{!! $item !!}" alt="Image Loading"
                            class="img-fluid {{ $wrapper_class ?? '' }} mb-3" />
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        {{ trans('label.no_image_provided') }}
    @endif
@endif

@if ($document_type == 2)
    <script>
        $(document).ready(function() {
            $('[data-fancybox="gallery"]').fancybox({
                loop: true, // enable infinite loop
                buttons: [
                    //   "zoom", // enable zoom button
                    "slideShow", // enable slideshow button
                    "fullScreen", // enable fullscreen button
                    //   "thumbs", // enable thumbnail navigation
                    "close" // enable close button
                ],
                clickContent: function(current, event) {
                    //   return current.type === "image" ? "zoom" : false; // enable zoom only for images
                }
            });
        });
    </script>

    <script>
        function zoomImage(imgContainer) {
            // Get the image element
            var imgElement = imgContainer.getElementsByTagName("img")[0];

            // Create a new element to contain the zoomed image
            var zoomedImg = document.createElement("div");
            zoomedImg.className = "zoomed-img";

            // Create a new image element with the same source as the original image
            var img = document.createElement("img");
            img.src = imgElement.src;

            // Append the new image element to the zoomed image container
            zoomedImg.appendChild(img);

            // Add the zoomed image container to the page
            document.body.appendChild(zoomedImg);

            // Add a click event listener to the zoomed image container to close it when clicked
            zoomedImg.addEventListener("click", function() {
                document.body.removeChild(zoomedImg);
            });
        }
    </script>
@endif
