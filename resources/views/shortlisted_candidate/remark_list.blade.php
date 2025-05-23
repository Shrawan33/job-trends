@foreach($favourit->remarks as $key => $value)
<tr class="multi-remark-table" id="remark_list_{{$value->id}}">
    {!! Form::hidden('remark_id[]',old("remark_id.$key", $value->id ?? 0), ['class' => 'form-control']) !!}
    {!! Form::hidden('remark[]',old("remark.$key", $value->content ?? 0), ['class' => 'form-control']) !!}
    <td>
        {!!FunctionHelper::fromSqlDateTime($value->created_at->toDateTimeString(),true,'M d, Y')!!}</td>
    <td>{{ $value->content??''}}</td>
    <td><a href="javascript:void(0)" data-id="{{$value->id}}" class="text-danger remove-remark">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
            <path d="M12.5556 4.6V3.88C12.5556 2.87191 12.5556 2.36786 12.3618 1.98282C12.1913 1.64413 11.9194 1.36876 11.5849 1.19619C11.2046 1 10.7068 1 9.71111 1H8.28889C7.29324 1 6.79542 1 6.41513 1.19619C6.08062 1.36876 5.80865 1.64413 5.63821 1.98282C5.44444 2.36786 5.44444 2.87191 5.44444 3.88V4.6M7.22222 9.55V14.05M10.7778 9.55V14.05M1 4.6H17M15.2222 4.6V14.68C15.2222 16.1921 15.2222 16.9482 14.9316 17.5258C14.6759 18.0338 14.268 18.4469 13.7662 18.7057C13.1958 19 12.449 19 10.9556 19H7.04445C5.55097 19 4.80423 19 4.2338 18.7057C3.73204 18.4469 3.32409 18.0338 3.06843 17.5258C2.77778 16.9482 2.77778 16.1921 2.77778 14.68V4.6" stroke="#F00404" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </a></td>
</tr>
@endforeach
