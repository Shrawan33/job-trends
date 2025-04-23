<div class="profile_box col-12 p-0">
    {{-- <h3 class="mb-4">{{trans('label.skills')}}*</h3> --}}
    <h3 class="mb-4" style="display: flex;">{{trans('label.skills')}}<span style="color: red;">*</span></h3>

</div>
{!! Form::hidden('user_id', $user->id ??'', ['class' => 'form-control']) !!}
{!! Form::hidden('form_title', $main_title ??'', ['class' => 'form-control']) !!}
@csrf
<div class="col-12 p-0">
    <div class="skill-fields">
        <div class="row skill-field">
            <div class="col-md-6 col-lg-4">
                <div class="form-group row mb-4">
                    <div class="col">
                        <select class="form-control no-select2" name="skill_to_add">
                            <option value="">{{trans('label.choose_one')}}</option>
                            @foreach ($skills as $id => $item)
                            <option value="{{$id}}" @if(!empty($skillsData) && $skillsData->where('skill_id',
                                $id)->count()) disabled="disabled" @endif>{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        {{-- <button type="button"
                            class="item-add-field btn btn-link text-primary px-0"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M7.99998 1.58331V14.4166M1.58331 7.99998H14.4166" stroke="#152b9b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg> {{trans('label.add')}}</button> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <ul class="list-inline profile_list_item_edit mb-0" id="items-tags">
                {{-- @dd($skillsData); --}}
                @foreach($skillsData as $key => $value)
                <li class="tag-btn list-inline-item item-field text-black">
                    {!! Form::hidden("ski_id[$key]", old("ski_id.$key", $value->id ?? 0)) !!}
                    {!! Form::hidden("skill_id[$key]", old("skill_id.$key", $value->skill_id ?? 0), ['id' =>
                    'hid_skill_id']) !!}
                    <span class="tag-text">{{$skills[$value->skill_id] ?? null}}</span><a href="javascript:void(0)"
                        class=" ml-3 p-0 btn-link text-danger item-remove-field">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 18 20" fill="none" class="mr-2">
                            <path d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6" stroke="#F00404" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </li>
                @endforeach
                <li class="tag-btn list-inline-item to-clone d-none item-field text-black">
                    {!! Form::hidden("ski_id", 0, ['disabled' => true]) !!}
                    {!! Form::hidden("skill_id", 0, ['id' => 'hid_skill_id', 'disabled' => true]) !!}
                    <span class="tag-text"></span><a href="javascript:void(0)"
                        class=" ml-3 p-0 btn-link text-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 18 20" fill="none" class="mr-2">
                            <path d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6" stroke="#F00404" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>


@push('page_scripts')
<script type="text/javascript">
    $(function() {

        var skills = {!! json_encode($skills) !!}
        var $wrapper = $('#items-tags');
        var $inputfield = $('[name="skill_to_add"]');

        // Add button (No longer needed)
        /* $(".item-add-field").on('click', function(e) {
            // Code for adding items...
        }); */

        // On dropdown selection change, directly display the selected option
        $inputfield.on('change', function() {
            var selectedSkillId = $(this).val();
            var selectedSkillName = skills[selectedSkillId];

            if (selectedSkillName) {
                var namekey = $('.list-inline-item', $wrapper).not('.d-none').length;
                var cloned_content = $('.to-clone', $wrapper).clone(true).appendTo($wrapper);
                cloned_content.removeClass('to-clone d-none');
                cloned_content.find('span.tag-text').html(selectedSkillName);
                cloned_content.find('[name=skill_id]').val(selectedSkillId).prop('disabled', false);
                cloned_content.find('[name=ski_id]').prop('disabled', false);
                cloned_content.find('a').addClass('item-remove-field');
                cloned_content.find('input').each(function() {
                    stringtoreplace = $(this).attr('name');
                    $(this).attr('name', stringtoreplace + "["+namekey+"]");
                });
                $inputfield.find('option[value="'+selectedSkillId+'"]').prop('disabled', true);
            }
            $inputfield.val('');
            $inputfield.focus();
        });

        // Remove buttons
        $('.item-field', $wrapper).on("click", ".item-remove-field", function() {
            var skill_id = $(this).parents('.item-field').find("#hid_skill_id").val();
            $inputfield.find('option[value="'+skill_id+'"]').prop('disabled', false);
            $(this).parents('.item-field').remove();
        });

    });
</script>

@endpush
