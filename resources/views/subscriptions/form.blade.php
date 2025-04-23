{!! Form::open(['url' => route('subscription.subscribe')]) !!}
<input type="hidden" name="user_id" value="{{auth()->user()->id??0}}">
<input type="hidden" name="package_id" value="{{$package_id??0}}">
<input type="hidden" name="renew" value="{{$renew??false}}">
<button type="submit" class="btn btn-primary rounded-pill  {{$class ?? ''}}">{{ $text ?? '' }}</button>
{!! Form::close() !!}
