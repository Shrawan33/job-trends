@extends('layouts.front')


@section('content')
<div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <h1 class="font-weight-bold mb-4 h2">Messages</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group mb-4">
                    <input type="text" class="form-control" placeholder="Search By Name">
                </div>
            </div>
            <div class="col">
                <div class="form-group mb-4">
                    <input type="text" class="form-control" placeholder="Search By Message Description">
                </div>
            </div>
            <div class="col-auto">
                <div class="form-group mb-4">
                   <button class="px-5 btn btn-primary rounded-pill">Search</button>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12">
                <table class="table table-theme">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-title="Name" class="text-nowrap"><a href="" class="text-body mr-2"><img
                                        src="{{ asset('img/user-1.png') }}" alt=""
                                        class=" mr-2 user-30 rounded-circle img-fluid ">Bairam Frootan</a>
                                <span class="badge badge-outline badge-pill badge-metal px-3">Send</span>
                            </td>
                            <td data-title="Message">
                                <div class="collapse-text position-relative">
                                <p class="message-text mb-0 collapse " id="collapseExample">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus sit
                                eveniet Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus sit
                                eveniet Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus sit
                                eveniet Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus sit
                                eveniet

                            </p>
                            <a role="button" class="collapsed" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"></a>
                            </div>
                        </td>
                            <td data-title="Date">01/25/2021</td>
                            <td data-title="Action"><a href="">Reply</a></td>

                        </tr>
                        <tr>
                            <td data-title="Name" class="text-nowrap"><a href="" class="text-body  mr-2"><img
                                        src="{{ asset('img/user-1.png') }}" alt=""
                                        class=" mr-2 user-30 rounded-circle img-fluid">Bairam Frootan</a>
                                <span class="badge badge-outline badge-pill badge-metal px-3">Received</span>
                            </td>
                            <td data-title="Message">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus sit
                                eveniet </td>
                            <td data-title="Date">01/25/2021</td>
                            <td data-title="Action"><a href="">Reply</a></td>

                        </tr>
                        <tr>
                            <td data-title="Name" class="text-nowrap"><a href="" class="text-body  mr-2"><img
                                        src="{{ asset('img/user-1.png') }}" alt=""
                                        class=" mr-2 user-30 rounded-circle img-fluid">Bairam Frootan</a>
                                <span class="badge badge-outline badge-pill badge-metal px-3">Received</span>
                            </td>
                            <td data-title="Message">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus sit
                                eveniet </td>
                            <td data-title="Date">01/25/2021</td>
                            <td data-title="Action"><a href="">Reply</a></td>

                        </tr>
                        <tr>
                            <td data-title="Name" class="text-nowrap"><a href="" class="text-body  mr-2"><img
                                        src="{{ asset('img/user-1.png') }}" alt=""
                                        class=" mr-2 user-30 rounded-circle img-fluid">Bairam Frootan</a>
                                <span class="badge badge-outline badge-pill badge-metal px-3">Received</span>
                            </td>
                            <td data-title="Message">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus sit
                                eveniet </td>
                            <td data-title="Date">01/25/2021</td>
                            <td data-title="Action"><a href="">Reply</a></td>

                        </tr>
                        <tr>
                            <td data-title="Name" class="text-nowrap"><a href="" class="text-body  mr-2"><img
                                        src="{{ asset('img/user-1.png') }}" alt=""
                                        class=" mr-2 user-30 rounded-circle img-fluid">Bairam Frootan</a>
                                <span class="badge badge-outline badge-pill badge-metal px-3">Received</span>
                            </td>
                            <td data-title="Message">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus sit
                                eveniet </td>
                            <td data-title="Date">01/25/2021</td>
                            <td data-title="Action"><a href="">Reply</a></td>

                        </tr>
                        <tr>
                            <td data-title="Name" class="text-nowrap"><a href="" class="text-body  mr-2"><img
                                        src="{{ asset('img/user-1.png') }}" alt=""
                                        class=" mr-2 user-30 rounded-circle img-fluid">Bairam Frootan</a>
                                <span class="badge badge-outline badge-pill badge-metal px-3">Received</span>
                            </td>
                            <td data-title="Message">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus sit
                                eveniet </td>
                            <td data-title="Date">01/25/2021</td>
                            <td data-title="Action"><a href="">Reply</a></td>

                        </tr>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endsection
