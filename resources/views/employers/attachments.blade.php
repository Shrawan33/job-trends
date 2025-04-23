@if (isset($candidate->seekerDetail))
	@forelse ($candidate->seekerDetail->documents as $doc)
		<li class="py-2 d-flex justify-content-between file-row dz-complete">
			<div class="text-primary font-weight-medium"><a target="_blank" href="{{route('download-attachment', [$candidate->id])}}" style="color:blue!important">{{explode('/',$doc->file_name??'')[1]}}</a>
			</div>
		</li>
	@empty
		<li class="py-2 d-flex justify-content-between file-row dz-complete">
			<div class="text-primary font-weight-medium">No attachment found..</div>
		</li>
	@endforelse
@endif

