<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                {{-- <th>All</th> --}}
                <th>{{trans('label.Module')}}</th>
                @foreach (config("modules.permission") as $permission)
                <th class="text-center">{{$permission}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($mod_perms as $module => $permissions)
            {{-- {{dd($mod_perms)}} --}}
            <tr>
                {{-- <td>{!! Form::checkbox('row_chk_all', 1, null) !!}</td> --}}
                <td>{!! config("modules.list.$platform.$module.label", null) ?: config("modules.list.$platform.$module", null)  !!}</td>
                @foreach (config("modules.permission") as $permission => $label)
                <td class="text-center">
                @if (FunctionHelper::permissionAllowed(config("modules.list.$platform.$module", null), $permission))
                    {!! Form::checkbox("permissions[$platform][]", $permissions[$permission]['id']??null, $permissions[$permission]['checked']??false, ['id' => $platform.'_'.$module.'_'.$permissions[$permission]['id']??null]) !!}
                @endif
                </td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
