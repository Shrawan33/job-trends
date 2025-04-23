<style>
	li{
		cursor: pointer;
	}
</style>
<div class="container">
	<div class="row my-5">
		<div class="col-md-9 job_detail_wraper">
			<div class="candidate-details-section">
				<div class="row mx-0 align-items-center job_detail_inner border-bottom pb-4 mb-2">
					<div class="col-md-2 col-3 p-0 info_box">
						<div class="candidate-single-profile">
							@if(!empty($candidate->seekerDetail) && $candidate->seekerDetail->logo->count())
								@include('vendor.image_upload.display', ['document_type' => config('constants.document_type.image', 0), 'imageModel' => $candidate->seekerDetail, 'class_li' => 'mb-2'])
							@else
								@include('vendor.image_upload.no_user', ['class_li' => ''])
							@endif
						</div>
					</div>
					<div class="col-md-7 pl-md-0 col-9">
						<div>
							<div class="candidate-single-dagignation">
								<h2>{{$candidate->first_name.' '.$candidate->middle_name.' '.$candidate->last_name??null}} @if($candidate->verified == 1)&nbsp; @endif</h2>
								@if (!empty($candidate->seekerDetail))
									<p class="posted_on mb-0">{{$candidate->seekerDetail->title??''}} </span></p>

								@endif
							</div>
						</div>
					</div>
						<div class="col-lg-3 mt-3 mt-lg-0">
							{{--<div class="reported">
								@if("detail-page" != "candidate-list")
									@include('components.report_button',['entity' => 'candidate','entityData' => $candidate, 'id' =>$candidate->id])</li>
								@endif
							</div>
							<div class="candidate-shortlist ml-lg-3 mt-3 mt-lg-0">
								@role('employer')
									@if(isset($candidate->favourite) &&  $candidate->favourite->count() >=0 )
										<a href="{{ route('candidates.favourit.remove',['id' => $candidate->id, 'employer_job_id' => 0]) }}" title="{!! __('label.remove_favourite')!!}" >
										<svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
											<path d="M17 8.26858V9.00458C16.999 10.7297 16.4404 12.4083 15.4075 13.79C14.3745 15.1718 12.9226 16.1826 11.2683 16.6717C9.61394 17.1608 7.8458 17.1021 6.22757 16.5042C4.60934 15.9064 3.22772 14.8015 2.28877 13.3542C1.34981 11.907 0.903833 10.195 1.01734 8.47363C1.13085 6.75223 1.79777 5.11364 2.91862 3.80224C4.03948 2.49083 5.55423 1.57688 7.23695 1.1967C8.91967 0.816507 10.6802 0.990449 12.256 1.69258M17 2.6L9 10.608L6.6 8.208" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
										{{__('label.shortlist')}}</a>
									@else
										<a href="{{ route('candidates.favourit',['id' => $candidate->id, 'employer_job_id' => 0]) }}" title="{!! __('label.save_as_favourite')!!}">
										<svg class="mr-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
											<path d="M17 8.26858V9.00458C16.999 10.7297 16.4404 12.4083 15.4075 13.79C14.3745 15.1718 12.9226 16.1826 11.2683 16.6717C9.61394 17.1608 7.8458 17.1021 6.22757 16.5042C4.60934 15.9064 3.22772 14.8015 2.28877 13.3542C1.34981 11.907 0.903833 10.195 1.01734 8.47363C1.13085 6.75223 1.79777 5.11364 2.91862 3.80224C4.03948 2.49083 5.55423 1.57688 7.23695 1.1967C8.91967 0.816507 10.6802 0.990449 12.256 1.69258M17 2.6L9 10.608L6.6 8.208" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
										</svg>
										{{__('label.shortlist')}}</a>
									@endif
								@endrole
							</div>--}}
							<div class="candidate-daunlode-cv mt-3 mt-lg-0">
								<a href="{{route('download-cv', $candidate->id)}}" class="btn btn-primary ml-auto btn-sm">
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
										<path d="M17.25 11.75V12.85C17.25 14.3901 17.25 15.1602 16.9503 15.7485C16.6866 16.2659 16.2659 16.6866 15.7485 16.9503C15.1602 17.25 14.3901 17.25 12.85 17.25H5.15C3.60986 17.25 2.83978 17.25 2.25153 16.9503C1.73408 16.6866 1.31338 16.2659 1.04973 15.7485C0.75 15.1602 0.75 14.3901 0.75 12.85V11.75M13.5833 7.16667L9 11.75M9 11.75L4.41667 7.16667M9 11.75V0.75" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
                                    Download Resume</a>
							</div>
							@if (config('constants.enable_cover_video', false) === true && ($candidate->display_cover_video??false) == true && !empty($candidate->video))
								<div class="candidate-cover-video ml-lg-3 mt-3 mt-lg-0">
									<a href="javascript:void(0)" onclick="contentModal('{{trans('label.cover_video_modal_title')}}', 'cover-video-{{$candidate->id}}')" title="{!!__('label.cover_video_button_text')!!}"><i class="fa fa-video"></i> {{ __('label.cover_video_button_text')}} </a>
									<div class="d-none" class="cover-video" id="cover-video-{{$candidate->id}}">
										@include('components.video', ['video' => $candidate->video, 'width' => '100%', 'height' =>
									'100%'])
									</div>
								</div>
							@endif
							{{--<div class="candidate-attachment">
									<a href="javascript:void(0)" onclick="contentModal('{{trans('label.download_attachments')}}', 'document-list-{{$candidate->id}}')"><i class="fa fa-download"></i> {{ trans('label.attachments')}}</a>
									<div class="d-none" class="cover-video" id="document-list-{{$candidate->id}}">
										@include('candidates.attachments', ['candidate' => $candidate, 'width' => '100%', 'height' => '100%'])
									</div>
							</div>--}}
							</div>
						</div>
					</div>



			<div class="candidate-detailse-menu-section">
				<div class="menu-candidate-detailse-iner-description">
					<ul class="candiddate-details-nav m-0 p-0 tabs_nav_wraper">
						<li class="candidate-details-nav-li">
							<a class="cd-nav-a-link tablink active" onclick="openPage('Career Profile')"  id="defaultOpen">Career Profile</a>
						</li>
						{{-- @role('employer')
							<li class="candidate-details-nav-li">
								<a class="cd-nav-a-link tablink" onclick="openPage('Interview')">Interview</a>
							</li>
						@endrole --}}
						<li class="candidate-details-nav-li">
							<a class="cd-nav-a-link tablink" onclick="openPage('Attachments')">Attachments</a>
						</li>
						{{--<li class="candidate-details-nav-li">
							<a class="cd-nav-a-link tablink" onclick="openPage('Notes & Recommendation')">Notes & Recommendation</a>
						</li>--}}
					</ul>
				</div>
			</div>
			<div class="candidate-detailse-containte-section">
				<div class="">
					<div class="">
						<div class="tabcontent" id="Career Profile">
							@if($candidate->seekerDetail->description)
							<div class="candi-about-me-area py-4 border-bottom">
								<h3 class="can-d-h3">{{__('label.about_me')}}</h3>
								<p>{{$candidate->seekerDetail->description??''}}</p>
							</div>
							@endif
							@if (isset($candidate->seekerEducation) &&$candidate->seekerEducation->count() > 0)
							<div class="candi-education-area py-4 border-bottom">
								<h3 class="can-d-h3">{{__('label.education')}}</h3>
								@foreach($candidate->seekerEducation as $education)
									<div class="de-dont-containt awards">
										<ul>
											<li class="name">{{$education->university ??''}}</li>
											<li class="role">{{$education->qualification->title ?? ''}}</li>
											<li class="time">
												{{ config('constants.months_range.duration_months.' . $education->duration_from_month) . ' '
												?? '' }}{{ $education->duration_from ?? '' }}
												-
												@if ($education->currently_working == 1)
													{{ trans('label.present') }}
												@else
													{{ config('constants.months_range.duration_months.' . $education->duration_to_month) . ' '
													?? '' }}{{ $education->duration_to ?? '' }}
												@endif
											</li>
										</ul>
									</div>
								@endforeach
							</div>
							@endif
							@if (isset($candidate->seekerExperience) && $candidate->seekerExperience->count() > 0)
								<div class="can-d-exprience-area py-4 border-bottom">
									<h3 class="can-d-h3">{{__('label.experience')}}</h3>
									@foreach($candidate->seekerExperience as $experience)
										<div class="de-dont-containt awards">
											<ul>
												<li class="name">{{$experience->company ?? ''}}</li>
												<li class="role">{{$experience->role ?? ''}}</li>
												<li class="time">
													{{ config('constants.months_range.duration_months.' . $experience->duration_from_month) . ' '
													?? '' }}{{ $experience->duration_from ?? '' }}
													-
													@if ($experience->currently_working == 1)
													{{ trans('label.present') }}
													@else
													{{ config('constants.months_range.duration_months.' . $experience->duration_to_month) . ' '
													?? '' }}{{ $experience->duration_to ?? '' }}
													@endif
												</li>
											</ul>
										</div>
									@endforeach
								</div>
							@endif
							@if(isset($candidate->seekerSkill) && $candidate->seekerSkill->count() > 0)
								<div class="can-d-skils-area py-4 border-bottom">
									<h3 class="can-d-h3">{{__('label.skills')}}</h3>
									<ul class="profile_list_item m-0 pl-4 mb-3">
										@if(isset($candidate->seekerSkill))
											@foreach($candidate->seekerSkill as $skill)
												<li class="">{{$skill->skill->title ?? ''}} </li>
											@endforeach
										@endif
									</ul>
								</div>
							@endif
							@if(isset($candidate->seekerLicense) && $candidate->seekerLicense->count() > 0)
								<div class="can-d-award-area pt-4">
									<h3 class="can-d-h3">{{__('Certifications')}}</h3>
									@if(isset($candidate->seekerLicense))
										@foreach($candidate->seekerLicense as $license)
											<div class="de-dont-containt awards">
												<ul>
													<li class="name">{{$license->license->title??''}}</li>
													@if(!empty($license->certification_detail))
														<li>{{$license->certification_detail??''}}</li>
													@endif
												</ul>
											</div>
										@endforeach
									@endif
								</div>
							@endif

						</div>
						{{-- <div class="tabcontent" id="Interview">
							@if(count($interviews) > 0)
							<div class="candi-about-me-area">
								<h3 class="can-d-h3">{{__('Interview')}}</h3>
								<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th style="width:250px!important">Job title</th>
											<th>Interview</th>
											<th width="300px">Description</th>
											<th style="width:200px!important">Date / Time</th>
										</tr>
									</thead>
									@foreach($interviews as $interview)
									<tbody>
										<td style="width:250px!important">{!! $interview->jobtitle !!}</td>
										<td>{!! $interview->title !!}</td>
										<td width="300px">{!! $interview->description !!}</td>
										<td style="width:200px!important">{!! date('d/m/Y h:i A', strtotime($interview->datetime)) !!}</td>
									</tbody>
									@endforeach
								</table>
								</div>
							</div>
							@else
							<div class="text-primary font-weight-medium">You have no interview scheduled with this candidate.</div>
							@endif
						</div> --}}
						<div class="tabcontent" id="Attachments">
							<div class="candi-about-me-area">
								<h3 class="can-d-h3 mt-4">{{__('Attachments')}}</h3>
								@include('candidates.attachments', ['candidate' => $candidate, 'width' => '100%', 'height' => '100%'])
							</div>
						</div>

						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3 mt-5 mt-md-0 px-0">
				@if(isset($candidate->seekerDetail))
					<div class="candidate-informatin-can-d-area detail_sidebar">
						<h3 class="">{{trans('label.per_info')}}</h3>
						<div class="can-information-box">
							<div class="can-info-icone-text-box">
								<div class="can-info-text-area">
									<span>{{__('Contact Number')}}</span>
									<p>{{$candidate->phone_number ?? ''}}</p>
								</div>
							</div>
							<div class="can-info-icone-text-box">
								<div class="can-info-text-area">
									<span>{{__('Email Address')}}</span>
									<p>{{$candidate->email ?? ''}}</p>
								</div>
							</div>
							{{-- <div class="can-info-icone-text-box">
								<div class="can-info-text-area">
									<span>{{__('label.expected_salary')}}</span>
									@if($candidate->seekerDetail->salary)
										<p>${{$candidate->seekerDetail->salary}} / {{config('constants.salary_type.data.'.$candidate->seekerDetail->salary_type_id)}}</p>
									@endif
								</div>
							</div> --}}
							<?php $parent_user = auth()->user()->created_by; ?>
							{{-- @if($candidate->activeUserPackage($parent_user) || auth()->user()->roles[0]['name'] == 'admin')
								<div class="can-info-icone-text-box">
									<div class="icone-img-can-info">
										<i class="fal fa-file"></i>
									</div>
									<div class="can-info-text-area">
										<h3>{{__('Assessment Report')}}</h3>
										<p><a href="{{ route('assesmentcandidate', $candidate->id) }}" class="text-black"><span class="pr-2 float-right"><i class="fas fa-angle-right"></i></span>{{trans('Assessment Report') }}</a></p>
									</div>
								</div>
							@endif --}}
                            {{-- <div class="can-info-icone-text-box">
								<div class="can-info-text-area">
									<span>{{__('label.licence_no')}}</span>
									<p>{{$candidate->seekerDetail->licence_no ?? ''}}</p>
								</div>
							</div>
                            <div class="can-info-icone-text-box">
								<div class="can-info-text-area">
									<span>{{__('label.licence_validity')}}</span>
                                    <p>{{ isset($candidate->seekerDetail->licence_validity) ? date('d-m-y', strtotime($candidate->seekerDetail->licence_validity)) : '' }}</p>

									{{-- <p>{{$candidate->seekerDetail->licence_validity ?? ''}}</p> --}
								</div>
							</div> --}}
                            @if(isset($candidate->seekerDetail->nationality))
                                <div class="can-info-icone-text-box">
                                    <div class="can-info-text-area">
                                        <span>{{__('label.nationality')}}</span>
                                        <p>{{config('constants.nationality_choices.data.'.$candidate->seekerDetail->nationality)}}</p>
                                    </div>
                                </div>
                                <div class="can-info-icone-text-box">
                                    <div class="can-info-text-area">
                                        <span>{{__('label.work_permit')}}</span>
                                        <p> @if ($candidate->seekerDetail->nationality == 1) No @else Yes @endif </p>
                                    </div>
                                </div>
                            @endif
							<div class="can-info-icone-text-box">
								<div class="can-info-text-area">
									<span>{{__('label.experience')}}</span>
									<p>{{$candidate->seekerDetail->total_experience ?? ''}}  {{__('label.years')}}</p>
								</div>
							</div>
                            <div class="can-info-icone-text-box">
								<div class="can-info-text-area">
									<span>{{__('label.qualification')}}</span>
									@foreach($candidate->seekerEducation as $education)
									<p class="mb-0">{{$education->qualification->title ?? ''}}</p>
									@endforeach
								</div>
							</div>
							{{-- <div class="can-info-icone-text-box">
								<div class="icone-img-can-info">
									<i class="fal fa-language"></i>
								</div>
								<div class="can-info-text-area">
									<h3>{{__('label.languages')}}</h3>
									@foreach($candidate->seekerLanguages as $language)
										<p>{{$language->language->title ?? ''}}</p>
									@endforeach
								</div>
							</div> --}}
						</div>
					</div>
				@endif
			</div>
		</div>

	</div>
</div>

<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
	$('a').click(function() {
		$('a.cd-nav-a-link.active').removeClass("active");
		$(this).addClass("active");
	});
});
</script>

<script>
function openPage(pageName,elmnt,color) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }
  document.getElementById(pageName).style.display = "block";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
