@extends('layouts.front')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 my-50">
            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row">
                <h1 class="h2 font-weight-bold mb-30 mb-md-0">Current Subscription Package</h1>
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="" class="btn btn-primary px-lg-50">Add Plan</a>
                    </li>
                    <li class="list-inline-item"><a href="" class="btn btn-primary px-lg-50">Renew</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-md-4 col-lg-3 mb-40">
            <p class="text-primary mb-10">Package Name</p>
            <p class="h3"> Gold Plan</p>
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-40">
            <p class="text-primary mb-10">Validity</p>
            <p class="h3">6 Months</p>
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-40">
            <p class="text-primary mb-10">Activation Date</p>
            <p class="h3"> 07/05/2021</p>
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-40">
            <p class="text-primary mb-10">Expiry Date</p>
            <p class="h3"> 10/11/2021</p>
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-40">
            <p class="text-primary mb-10">Total Credits</p>
            <p class="h3"> 600</p>
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-40">
            <p class="text-primary mb-10">Used Credits</p>
            <p class="h3"> 125</p>
        </div>
        <div class="col-6 col-md-4 col-lg-3 mb-40">
            <p class="text-primary mb-10">Status</p>
            <p class="h3"> Active</p>
        </div>
    </div>
    <div class="row mb-50">
        <div class="col-12 mt-50">
            <h4 class="font-weight-bold mb-30">Past Subscription Package</h4>
            <table class="table table-theme">
                <thead>
                    <tr>
                        <th>Package Name</th>
                        <th>Validity</th>
                        <th>Activation Date</th>
                        <th>Expiry Date</th>
                        <th>Total Credits</th>
                        <th>Used Credits</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-title="Package Name">Gold Plan</td>
                        <td data-title="">6 Months</td>
                        <td data-title="Activation Date">10/11/2020</td>
                        <td data-title="Expiry Date">07/05/2021</td>
                        <td data-title="Total Credits">599</td>
                        <td data-title="Used Credits">125</td>
                        <td data-title="Status">Expired</td>
                        <td class="p-md-0 thead-none"><a href="" class="btn btn-primary btn-sm">Renew</a>
                        </td>
                    </tr>
                    <tr>
                        <td data-title="Package Name">Gold Plan</td>
                        <td data-title="">6 Months</td>
                        <td data-title="Activation Date">10/11/2020</td>
                        <td data-title="Expiry Date">07/05/2021</td>
                        <td data-title="Total Credits">599</td>
                        <td data-title="Used Credits">125</td>
                        <td data-title="Status">Expired</td>
                        <td class="p-md-0 thead-none"><a href="" class="btn btn-primary btn-sm">Renew</a>
                        </td>
                    </tr>
                    <tr>
                        <td data-title="Package Name">Gold Plan</td>
                        <td data-title="">6 Months</td>
                        <td data-title="Activation Date">10/11/2020</td>
                        <td data-title="Expiry Date">07/05/2021</td>
                        <td data-title="Total Credits">599</td>
                        <td data-title="Used Credits">125</td>
                        <td data-title="Status">Expired</td>
                        <td class="p-md-0 thead-none"><a href="" class="btn btn-primary btn-sm">Renew</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection