@extends('layouts.ajax')

@section('content')
        @foreach($messages as $key => $message)
        @if ($message->sender_id == auth()->user()->id)
        <div class="col-md-6 m-3 ml-auto" onclick="showDateTimePopup(this)">
            {{-- <div class="row">
                <div class="col-sm-6">
                    <label style="font-weight: 500;">{!!FunctionHelper::fromSqlDateTime($message->created_at->toDateTimeString(),true,'')!!}</label>
                </div>
                <div class="col-sm-6 text-right">
                    <h5>{{ auth()->user()->first_name.' '.auth()->user()->last_name??''}}</h5>
                </div>
            </div> --}}
            <div class="bg-dark p-3 rounded" style="background: #e5e5e5 !important;">
                <h6 class="text-left" style="font-size:15px;color:#272729">{{ $message->data['message']??''}}</h6>
            </div>
            <div class="datetime-popup">
                <p class="datetime-text">{{FunctionHelper::fromSqlDateTime($message->created_at->toDateTimeString(),true,'')}}</p>
            </div>
        </div>
        @else
        <div class="col-md-6 m-3 rounded" onclick="showDateTimePopup(this)">
            {{-- <div class="row">
                <div class="col-sm-6">
                    <h5>{{ $user->first_name." ".$user->last_name??''}}</h5>
                </div>
                <div class="text-right col-sm-6">
                    <label class="text-right" style="font-weight: 500;">{!!FunctionHelper::fromSqlDateTime($message->created_at->toDateTimeString(),true,'')!!}</label>
                </div>
            </div> --}}
            <div class=" bg-primary text-white p-3 rounded" style="background-color: #0D2D56 !important">
                <h6 class="text-white text-left" style="font-size:15px;">{{ $message->data['message']??''}}</h6>
            </div>
            <div class="datetime-popup">
                <p class="datetime-text">{{FunctionHelper::fromSqlDateTime($message->created_at->toDateTimeString(),true,'')}}</p>
            </div>
        </div>
        <style>
            .popup {
                display: none;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 200px;
                padding: 10px;
                background-color: #f8f8f8;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                font-size: 14px;
                z-index: 999;
            }

            .popup.active {
                display: block;
                animation: fadeIn 0.3s ease;
            }

            @keyframes fadeIn {
                0% {
                    opacity: 0;
                }
                100% {
                    opacity: 1;
                }
            }
        </style>


        <script>
            function showDateTimePopup(element) {
                var datetimePopup = element.querySelector('.datetime-popup');
                datetimePopup.classList.add('active');
                setTimeout(function() {
                    datetimePopup.classList.remove('active');
                }, 1000);
            }
        </script>
        @endif
        @endforeach
@endsection
