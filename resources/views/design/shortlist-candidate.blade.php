@extends('layouts.front')


@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12">
            <table class="table table-theme">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Job Title</th>
                        <th>Remark</th>
                        <th>Status</th>
                        <th>Question Response</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-title="Name"><a href="" class="text-body"><img src="{{ asset('img/user-1.png') }}"
                                    alt="" class=" mr-2 user-30 rounded-circle img-fluid">Bairam Frootan</a></td>
                        <td data-title="Job Title">Maths Teacher</td>
                        <td data-title="Remark"><a href="" class="text-success" data-toggle="modal"
                                data-target="#RemarkModal">View Remark</a></td>
                        <td data-title="Status"><select name="" id=""
                                class="rounded-pill form-control no-select2 table-select">
                                <option value="">Interviewed</option>
                                <option value="">Contacted</option>
                            </select></td>
                        <td data-title="Response" class="p-md-0 thead-none">
                            <ul class="mb-0 list-inline d-flex align-items-center">
                                <li class="list-inline-item"><a href="" class="btn btn-link py-0"><i
                                            class="fi flaticon-tasks sub-h2 mb-0 text-primary"></i></a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-sm btn-primary rounded-pill">Send
                                        Message</a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-link text-danger">Remove</a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td data-title="Name"><a href="" class="text-body"><img src="{{ asset('img/user-1.png') }}"
                                    alt="" class=" mr-2 user-30 rounded-circle img-fluid">Bairam Frootan</a></td>
                        <td data-title="Job Title">Maths Teacher</td>
                        <td data-title="Remark"><a href="" class="text-success" data-toggle="modal"
                                data-target="#RemarkModal">View Remark</a></td>
                        <td data-title="Status"><select name="" id=""
                                class="rounded-pill form-control no-select2 table-select">
                                <option value="">Interviewed</option>
                                <option value="">Contacted</option>
                            </select></td>
                        <td data-title="Response" class="p-md-0 thead-none">
                            <ul class="mb-0 list-inline d-flex align-items-center">
                                <li class="list-inline-item"><a href="javascript:;" class="btn btn-link py-0" data-toggle="modal" data-target="#QuestionnaireModal"><i
                                            class="fi flaticon-tasks sub-h2 mb-0 text-primary"></i></a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-sm btn-primary rounded-pill">Send
                                        Message</a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-link text-danger">Remove</a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td data-title="Name"><a href="" class="text-body"><img src="{{ asset('img/user-1.png') }}"
                                    alt="" class=" mr-2 user-30 rounded-circle img-fluid">Bairam Frootan</a></td>
                        <td data-title="Job Title">Maths Teacher</td>
                        <td data-title="Remark"><a href="" class="text-success" data-toggle="modal"
                                data-target="#RemarkModal">View Remark</a></td>
                        <td data-title="Status"><select name="" id=""
                                class="rounded-pill form-control no-select2 table-select">
                                <option value="">Interviewed</option>
                                <option value="">Contacted</option>
                            </select></td>
                        <td data-title="Response" class="p-md-0 thead-none">
                            <ul class="mb-0 list-inline d-flex align-items-center">
                                <li class="list-inline-item"><a href="" class="btn btn-link py-0"><i
                                            class="fi flaticon-tasks sub-h2 mb-0 text-primary"></i></a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-sm btn-primary rounded-pill">Send
                                        Message</a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-link text-danger">Remove</a></li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td data-title="Name"><a href="" class="text-body"><img src="{{ asset('img/user-1.png') }}"
                                    alt="" class=" mr-2 user-30 rounded-circle img-fluid">Bairam Frootan</a></td>
                        <td data-title="Job Title">Maths Teacher</td>
                        <td data-title="Remark"><a href="" class="text-success" data-toggle="modal"
                                data-target="#RemarkModal">View Remark</a></td>
                        <td data-title="Status"><select name="" id=""
                                class="rounded-pill form-control no-select2 table-select">
                                <option value="">Interviewed</option>
                                <option value="">Contacted</option>
                            </select></td>
                        <td data-title="Response" class="p-md-0 thead-none">
                            <ul class="mb-0 list-inline d-flex align-items-center">
                                <li class="list-inline-item"><a href="" class="btn btn-link py-0"><i
                                            class="fi flaticon-tasks sub-h2 mb-0 text-primary"></i></a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-sm btn-primary rounded-pill">Send
                                        Message</a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-link text-danger">Remove</a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td data-title="Name"><a href="" class="text-body"><img src="{{ asset('img/user-1.png') }}"
                                    alt="" class=" mr-2 user-30 rounded-circle img-fluid">Bairam Frootan</a></td>
                        <td data-title="Job Title">Maths Teacher</td>
                        <td data-title="Remark"><a href="" class="text-success" data-toggle="modal"
                                data-target="#RemarkModal">View Remark</a></td>
                        <td data-title="Status"><select name="" id=""
                                class="rounded-pill form-control no-select2 table-select">
                                <option value="">Interviewed</option>
                                <option value="">Contacted</option>
                            </select></td>
                        <td data-title="Response" class="p-md-0 thead-none">
                            <ul class="mb-0 list-inline d-flex align-items-center">
                                <li class="list-inline-item"><a href="" class="btn btn-link py-0"><i
                                            class="fi flaticon-tasks sub-h2 mb-0 text-primary"></i></a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-sm btn-primary rounded-pill">Send
                                        Message</a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-link text-danger">Remove</a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td data-title="Name"><a href="" class="text-body"><img src="{{ asset('img/user-1.png') }}"
                                    alt="" class=" mr-2 user-30 rounded-circle img-fluid">Bairam Frootan</a></td>
                        <td data-title="Job Title">Maths Teacher</td>
                        <td data-title="Remark"><a href="" class="text-success" data-toggle="modal"
                                data-target="#RemarkModal">View Remark</a></td>
                        <td data-title="Status"><select name="" id=""
                                class="rounded-pill form-control no-select2 table-select">
                                <option value="">Interviewed</option>
                                <option value="">Contacted</option>
                            </select></td>
                        <td data-title="Response" class="p-md-0 thead-none">
                            <ul class="mb-0 list-inline d-flex align-items-center">
                                <li class="list-inline-item"><a href="" class="btn btn-link py-0"><i
                                            class="fi flaticon-tasks sub-h2 mb-0 text-primary"></i></a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-sm btn-primary rounded-pill">Send
                                        Message</a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-link text-danger">Remove</a></li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td data-title="Name"><a href="" class="text-body"><img src="{{ asset('img/user-1.png') }}"
                                    alt="" class=" mr-2 user-30 rounded-circle img-fluid">Bairam Frootan</a></td>
                        <td data-title="Job Title">Maths Teacher</td>
                        <td data-title="Remark"><a href="" class="text-success" data-toggle="modal"
                                data-target="#RemarkModal">View Remark</a></td>
                        <td data-title="Status"><select name="" id=""
                                class="rounded-pill form-control no-select2 table-select">
                                <option value="">Interviewed</option>
                                <option value="">Contacted</option>
                            </select></td>
                        <td data-title="Response" class="p-md-0 thead-none">
                            <ul class="mb-0 list-inline d-flex align-items-center">
                                <li class="list-inline-item"><a href="" class="btn btn-link py-0"><i
                                            class="fi flaticon-tasks sub-h2 mb-0 text-primary"></i></a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-sm btn-primary rounded-pill">Send
                                        Message</a></li>
                                <li class="list-inline-item"><a href="" class="btn btn-link text-danger">Remove</a></li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- The Modal -->
<div class="modal" id="RemarkModal">
    <div class="modal-dialog modal-lg modal-dialog-centered theme-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Bairam Frootan’s Remarks</h3>

            </div>
            <!-- Modal body -->
            <div class="modal-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>03/29/2021</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et.</td>
                                <td><a href="" class="text-danger">Remove</a></td>
                            </tr>
                            <tr>
                                <td>03/29/2021</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et.</td>
                                <td><a href="" class="text-danger">Remove</a></td>
                            </tr>
                            <tr>
                                <td>03/29/2021</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et.</td>
                                <td><a href="" class="text-danger">Remove</a></td>
                            </tr>
                            <tr>
                                <td>03/29/2021</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et.</td>
                                <td><a href="" class="text-danger">Remove</a></td>
                            </tr>
                            <tr>
                                <td>03/29/2021</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas varius tortor nibh, sit amet tempor nibh finibus et.</td>
                                <td><a href="" class="text-danger">Remove</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row align-items-end">
                        <div class="col">
                            <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder="Add Remark..."></textarea>
                        </div>
                        <div class="col-auto">
                            <a href="" class="btn btn-link text-primary">Add</a>
                        </div>
                    </div>
            </div>
            <div class="modal-footer border-top-0">
                    <button type="button" class="btn btn-default  mr-auto" data-dismiss="modal">Cancel</button>
                    
                    <button type="button" class="btn btn-primary" >{{__('Save')}}</button>
                </div>
        </div>
    </div>
</div>
<div class="modal" id="QuestionnaireModal">
  <div class="modal-dialog  modal-lg modal-dialog-centered theme-modal">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h3 class="modal-title">Add job questionnaire</h3>
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
      </div>

      <!-- Modal body -->
      <div class="modal-body que-form ">
      <form>
                    <div class="form-group mb-4">
                        <label for="" class="text-black-50">Question 01</label>
                        <input type="text" class="form-control text-black" readonly value="Are you able to relocate in Patna?">
                        <textarea name="" id="" cols="30" rows="3" class="form-control mt-3" placeholder="Write your answer here..."></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="" class="text-black-50">Question 02</label>
                        <input type="text" class="form-control text-black" readonly value="Do you have more than 5 years of Experience?">
                        <textarea name="" id="" cols="30" rows="3" class="form-control mt-3" placeholder="Write your answer here..."></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="" class="text-black-50">Question 03</label>
                        <input type="text" class="form-control text-black" readonly value="Can you join within a week?">
                        <textarea name="" id="" cols="30" rows="3" class="form-control mt-3" placeholder="Write your answer here..."></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="" class="text-black-50">Question 04</label>
                        <input type="text" class="form-control text-black" readonly value="Which subjects you can teach?">
                        <textarea name="" id="" cols="30" rows="3" class="form-control mt-3" placeholder="Write your answer here..."></textarea>
                    </div>
                    <div class="form-group mb-4">
                        <label for="" class="text-black-50">Question 05</label>
                        <input type="text" class="form-control text-black" readonly value="Expected Salary?">
                        <textarea name="" id="" cols="30" rows="3" class="form-control mt-3" placeholder="Write your answer here..."></textarea>
                    </div>
                    <div class="form-group mb-4 text-right">
                        <button class="btn btn-primary">Done</button>
                    </div>

            </form>
      </div>

      

    </div>
  </div>
</div>
@endsection