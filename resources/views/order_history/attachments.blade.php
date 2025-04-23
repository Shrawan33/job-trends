@if (isset($order))
    @forelse ($order->orderDocuments as $doc)
        @php
            // Extract the desired file name
            $pattern = '/^[^_]+_(.*)$/'; // Match everything after the first underscore
            $matches = [];
            $fileName = preg_match($pattern, $doc->file_name ?? '', $matches) ? $matches[1] : '';
        @endphp

        <li class="py-2 d-flex justify-content-between file-row dz-complete" style="list-style: none;">
            <div class="text-primary font-weight-medium">
                {{-- <a target="_blank"
                    href="{{ route('download-attachment', [$candidate->id]) }}"
                    style="color:blue!important">{{ explode('/', $doc->file_name ?? '')[1] }}
                </a> --}}
                <a style="text-decoration: none; color: blue;" target="_blank" href="{{ route('download-order-attachment', [$order->id]) }}" style="color: blue!important">
                    {{ $fileName }}
                </a>
            </div>
        </li>
    @empty
        <li class="py-2 d-flex justify-content-between file-row dz-complete">
            <div class="text-primary font-weight-medium">No attachment found..</div>
        </li>
    @endforelse
@endif
