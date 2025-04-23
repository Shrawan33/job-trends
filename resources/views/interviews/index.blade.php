@extends('layouts.front')

@section('content')
<div class="container my-5">
	<div class="arc_inner_bg_img text-left">
		<h3 class="text-left inner_page_heading">{{ trans('label.interviews') }}</h3>
	</div>
	<div class="row mb-40 jobseeker_dashboard">
		@include('auth.job_seeker.profile.layout')
		<div class="col-md-10 col-lg-9">
			<div class="right_side_wraper">
				<div>
					<div class="box_wraper mb-3 table_box">
						<div class="d-flex align-items-center justify-content-between">
							<div class="col-12 p-0">
							@includeFirst([$entity['view'].'.table', 'components.table'])
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
