@extends('layouts.front')

@section('content')
<div class="container main_banner py-5 mb-2 about_banner find_job_banner">
	<div class="">
		<h2 class="mb-0">Find Jobs</h2>
	</div>
</div>
<div class="react_main_wraper">
    @includeFirst(["components.react.build.app"])
</div>
@endsection
