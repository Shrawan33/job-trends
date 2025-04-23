@if (isset($candidate->seekerDetail))
    @forelse ($candidate->seekerDetail->documents as $doc)
        @php
            // Extract the desired file name
            $pattern = '/^[^_]+_(.*)$/'; // Match everything after the first underscore
            $matches = [];
            $fileName = preg_match($pattern, $doc->file_name ?? '', $matches) ? $matches[1] : '';
        @endphp


                {{-- <a target="_blank"
                    href="{{ route('download-attachment', [$candidate->id]) }}"
                    style="color:blue!important">{{ explode('/', $doc->file_name ?? '')[1] }}
                </a> --}}
                <a target="_blank" href="{{ route('download-attachment', [$candidate->id]) }}">
                    {{ $fileName }}
                </a>

    @empty

            <div class="text-primary font-weight-medium">{{ __('label.your_cover_letter') }}</div>

    @endforelse
@endif
