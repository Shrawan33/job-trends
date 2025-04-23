@extends('layouts.front')


@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12">
            <h1 class="font-weight-bold mb-0 h2"><a href=""><i class="fi flaticon-left-arrow mr-2 text-body"></i></a>
                Make a Resume</h1>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex  justify-content-between align-items-center">
                        <h3 class="mb-0">CV</h3>
                        <div class="card-action">
                            <a href=""
                                class="  d-block d-sm-inline-flex font-weight-medium text-primary mb-3 mb-sm-0 mr-sm-4">bairam-frootan-cv.pdf</a>
                            <a href=""
                                class="d-block d-sm-inline-flex  font-weight-medium text-secondary ml-sm-4">bairam-frootan-cv.doc</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row mt-3 ">
                        <div class="col-12 d-flex flex-column flex-lg-row">
                            <img src="{{ asset('img/user-pp.png') }}" alt=""
                                class="img-fluid rounded-pill user-profile-pic">


                            <div class="pt-4 pt-lg-0 pl-lg-4 w-100">
                                <h2 class="text-primary">Bairam Frootan</h2>
                                <p class="mb-2">Maths Teacher</p>
                                <p class="mb-2">Male</p>
                                <p class="mb-2">Santiago Centro, Santiago de Chile
                                <p class="mb-2"><a class="text-body" href="tel:+56224992200">+56224992200</a></p>
                                <p class="mb-2"><a class="text-body" href="mailto:mail@yoursite.com">mail@yoursite.com</a></p>

                            </div>
                        </div>
                        <div class="col-12 mt-4">
                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga aspernatur corrupti
                                    nesciunt natus nobis voluptatum dignissimos facere accusamus dolorem rerum explicabo
                                    saepe exercitationem labore consequatur asperiores nostrum, in quam vitae.</p>
                        </div>
                        <div class="col-12 mt-4  pt-md-3">
                            <h3 class="mb-4">Experience</h3>
                            <table class="table table-theme mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-primary font-weight-normal"> Company </th>
                                        <th class="text-primary font-weight-normal"> Position </th>
                                        <th class="text-primary font-weight-normal"> Location </th>
                                        <th class="text-primary font-weight-normal"> Duration </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-title="Company">Atract Solutions</td>
                                        <td data-title="Position">Jr. Teacher</td>
                                        <td data-title="Location">Houston</td>
                                        <td data-title="Duration">2008 - 2009</td>
                                    </tr>
                                    <tr>
                                        <td data-title="Company">Atract Solutions</td>
                                        <td data-title="Position">Jr. Teacher</td>
                                        <td data-title="Location">Houston</td>
                                        <td data-title="Duration">2008 - 2009</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="col-12 mt-4  pt-md-3">
                            <h3 class="mb-4">Education</h3>
                            <table class="table table-theme mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-primary font-weight-normal"> Course Name </th>
                                        <th class="text-primary font-weight-normal"> University/Institute </th>
                                        <th class="text-primary font-weight-normal"> Location </th>
                                        <th class="text-primary font-weight-normal"> Duration </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td data-title="Course Name ">Diploma in Fine Arts</td>
                                        <td data-title="University/Institute">Walters University</td>
                                        <td data-title="Location">Bangkok</td>
                                        <td data-title="Duration">2002 - 2003</td>
                                    </tr>
                                    <tr>
                                        <td data-title="Course Name ">Diploma in Fine Arts</td>
                                        <td data-title="University/Institute">Walters University</td>
                                        <td data-title="Location">Bangkok</td>
                                        <td data-title="Duration">2002 - 2003</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 mt-4  pt-md-3">
                            <h3 class="mb-4">Training &amp; Certifications</h3>
                            <ul class="list-inline">

                                <li
                                    class="rounded-pill  tag-btn bg-light d-inline-block border mb-2  mr-2 list-inline-item ">
                                    Certified Teacher</li>
                                    <li
                                    class="rounded-pill  tag-btn bg-light d-inline-block border mb-2  mr-2 list-inline-item ">
                                    Certified Production Engineer</li>

                            </ul>
                        </div>
                        <div class="col-12 mt-4  pt-md-3">
                            <h3 class="mb-4">Skills </h3>
                            <ul class="list-inline">

                                <li
                                    class="rounded-pill  tag-btn bg-light d-inline-block border mb-2  mr-2 list-inline-item ">
                                    Development</li>
                                    <li
                                    class="rounded-pill  tag-btn bg-light d-inline-block border mb-2  mr-2 list-inline-item ">
                                    Document Management</li>
                                    <li
                                    class="rounded-pill  tag-btn bg-light d-inline-block border mb-2  mr-2 list-inline-item ">
                                    Production Engineer</li>

                            </ul>
                        </div>
                        <!-- <div class="col-12 mt-4  pt-md-3">
                            <h3 class="mb-4">Training and Certifications</h3>
                            <ul class="list-inline">

                                <li
                                    class="rounded-pill  tag-btn bg-light d-inline-block border mb-2  mr-2 list-inline-item ">
                                    Certified Teacher</li>

                            </ul>
                        </div>
                        <div class="col-12">
                            <h3 class="mt-5 mb-4">Skills</h3>
                            <ul class="list-inline">
                                @if(isset($candidate->seekerSkill))
                                @foreach($candidate->seekerSkill as $skill)
                                <li
                                    class="rounded-pill tag-btn bg-light d-inline-block border mb-2  mr-2 list-inline-item ">
                                    {{$skill->skill->title ?? ''}}</li>
                                @endforeach
                                @endif
                            </ul>
                        </div> -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
