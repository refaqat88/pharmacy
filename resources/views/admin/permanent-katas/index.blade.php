@extends('layouts.app')
@section('title', 'Permanent Katas')
@section('content')
    <style>
        .add-div-error{
            color:red;
        }
        .edit-div-error{
            color:red;
        }
    </style>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <div class="row">
                        <h4 class="card-title col-sm-6">Permanent Khata's</h4>
                        <div class="col-sm-6 pull-right">
                            <a type="button" class="btn btn-secondary btn-round float-right" id="add-kata-btn" href="javascript:void(0)">Add Kata</a>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-12">




                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title">Permanent Khata's Record List</h6>
                            </div>
                            <div class="card-body">
                                <div class="toolbar">
                                    <div class="form-group col-sm-2 select-wizard">
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-sm-12 float-right">
                                            <button
                                                class="btn btn-simple btn-tumblr btn-icon float-right "><i
                                                    class="fa fa-print"
                                                    title="Print"
                                                    data-toggle=""></i></button>
                                            <button
                                                class="btn btn-simple btn-tumblr btn-icon float-right "><i
                                                    class="fa fa-file-excel-o"
                                                    title="Export to Excel"
                                                    data-toggle=""></i></button>
                                        </div>
                                    </div>--}}
                                    <!--        Here you can write extra buttons/actions for the toolbar              -->
                                </div>

                                <table id="datatable" data-id="datatable" class="table table-hover custom_border" cellspacing="0" width="100%">
                                    <thead class="table-secondary">
                                    <tr>
                                        <th style="font-size:11px" class=" text-center">S.No</th>
                                        <th style="font-size:11px" class="">Name</th>
                                        <th style="font-size:11px" class="">Receipt</th>
                                        <th style="font-size:11px" class="">Mobile</th>
                                        <th style="font-size:11px" class="">Total</th>
                                        <th style="font-size:11px" class="">Paid</th>
                                        <th style="font-size:11px" class="">Remaining</th>
                                        <th style="font-size:11px" class="">Paid Date</th>
                                        <th style="font-size:11px" class="">Status</th>
                                        <th style="font-size:11px" class="disabled-sorting text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php $i=1; @endphp
                                    @foreach ($permanent_allusers as $key => $user)

                                    <tr>
                                        <td class="w-1 text-center">{{$i++}}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->kata?$user->kata->receipt_no:'' }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->kata->total_amount!=''?$user->kata->total_amount:0 }}</td>
                                        <td>{{ $user->kata?$user->kata->paid_amount:0 }}</td>
                                        <td>{{ $user->kata?$user->kata->remaining_amount:0 }}</td>
                                        <td>{{ $user->kata?$user->kata->paid_date:'' }}</td>
                                        <td>{{ $user->kata?$user->kata->amount_status:'' }}</td>
                                        <td class="text-center">
                                            <div class="col">
                                                <div class="dropdown  text-center">
                                                    <button style="" class="dropdown-toggle btn-round  btn-sm btn text-info btn-link btn-cus-weight" type="button" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Manage
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton">
                                                        <div class="dropdown-header">Manage user</div>

                                                        <a class="dropdown-item show-katas" data-id="{{$user->id}}" href="javascript:void(0)">Show</a>
                                                        <a class="dropdown-item"  href="{{url('permanent-katas/invoice/'.$user->id)}}">Invoice</a>
                                                        <a class="dropdown-item edit-katas" data-id="{{$user->id}}" href="javascript:void(0)">Edit</a>
                                                        <a class="dropdown-item delete-katas" data-id="{{$user->id}}" href="javascript:void(0)">Delete</a>

                                                        {{--{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $kata->id],'style'=>'display:inline']) !!}
                                                        {!! Form::submit('Delete', ['class' => 'dropdown-item']) !!}
                                                        {!! Form::close() !!}--}}


                                                        {{-- <a class="dropdown-item reset-password-user" data-id="{{ $parent->id }}">Reset Password</a>--}}


                                                    </div>
                                                </div>


                                            </div>

                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div><!-- end content-->
                        </div><!--  end card  -->
                    </div> <!-- end col-md-12 -->
                </div> <!-- end row -->

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="permanent-kata-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-sm">
        <form id="permanent-kata-form" action="{{url('permanent-katas/create')}}" method="Post">
            @csrf
            <input type="hidden" name="id" id="edit-permanent-kata-id">
            <input type="hidden" name="user_id" id="edit-user_id">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-remove"></i>
                    </button>
                    <h5 class="title title-up" id="modal-title">Add Permanent Khata
                    </h5>
                </div>
                <div class="modal-body row">
                    <div class="col-sm-12" id="form_add">
                        <div class="row">

                            <div class="form-group name col-sm-6">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="" id="name" name="name" />

                            </div>

                            <div class="form-group mobile col-sm-6">
                                <label>Mobile</label>
                                <input type="text" class="form-control mobile-number" placeholder="" id="mobile" name="mobile" />

                            </div>
                           {{-- <div class="form-group current_date col-sm-4 select-wizard">
                                <label>Current Date</label>
                                <input class="form-control datepicker" name="current_date" id="current_date" type="text" />

                            </div>--}}
                            <div class="form-group address col-sm-12 select-wizard">
                                <label>Address</label>
                                <input class="form-control" name="address" id="address"  type="text" />

                            </div>

                            <div class="form-group total_amount col-sm-4">
                                <label>Total Amount</label>
                                <input class="form-control calculate" name="total_amount" id="total_amount"  type="text" />

                            </div>

                            <div class="form-group paid_amount col-sm-4">
                                <label>Paid Amount</label>
                                <input class="form-control calculate" name="paid_amount" id="paid_amount" type="text"  />

                            </div>

                            <div class="form-group remaining_amount col-sm-4">
                                <label>Remaining Amount</label>
                                <input class="form-control calculate" name="mobileremaining_amount" id="mobileremaining_amount" value="0" type="hidden"/>

                                <input class="form-control calculate" name="remaining_amount" id="remaining_amount"  type="text"/>

                            </div>

                            <div class="form-group paid_date col-sm-4">
                                <label>Paid Date</label>
                                <input class="form-control datepicker" name="paid_date" id="paid_date"  type="text" />

                            </div>

                            <div class="form-group amount_status col-sm-4">
                                <label>Amount Status</label>
                                <select class="selectpicker btn-round pl-0" data-size="7"  name="amount_status" id="amount_status" data-style="btn-round btn btn-secondary" title="Select Amount Status">
                                    <option value="" disabled>Amount Status</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Bill">Bill</option>
                                </select>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="">
                        <button type="submit" class="btn btn-round btn-success btn-link add-btn" >Save</button>
                    </div>
                    <div class="divider"></div>
                    <div class="">
                        <button type="button" class="btn btn-round btn-danger btn-link" data-dismiss="modal">Cancel</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
{{--
<div class="modal fade" id="edit-permanent-kata-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-sm">
        <form id="edit-permanent-kata-form" action="{{url('permanent-katas/update')}}" method="post">
            @csrf
            <input type="hidden" name="id" id="edit-permanent-kata-id">
            <input type="hidden" name="user_id" id="edit-user_id">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-remove"></i>
                    </button>
                    <h5 class="title title-up" id="modal-title">Edit Permanent Khata
                    </h5>
                </div>
                <div class="modal-body row">
                    <div class="col-sm-12">
                        <div class="row">

                            <div class="form-group name col-sm-4">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="" id="edit-name" name="edit_name" />

                            </div>

                            <div class="form-group mobile col-sm-4">
                                <label>Mobile</label>
                                <input type="text" class="form-control calculate1" placeholder="" id="edit-mobile" name="edit_mobile" />

                            </div>
                            <div class="form-group current_date col-sm-4 select-wizard">
                                <label>Current Date</label>
                                <input class="form-control datepicker" name="edit_current_date" id="edit-current_date" type="text" />

                            </div>
                            <div class="form-group address col-sm-12 select-wizard">
                                <label>Address</label>
                                <input class="form-control" name="edit_address" id="edit-address" type="text" />

                            </div>

                            <div class="form-group total_amount col-sm-4">
                                <label>Total Amount</label>
                                <input class="form-control calculate1" name="edit_total_amount" id="edit-total_amount" type="text" />

                            </div>
                            <div class="form-group paid_amount col-sm-4">
                                <label>Paid Amount</label>
                                <input class="form-control calculate1" name="edit_paid_amount" id="edit-paid_amount" type="text"  />

                            </div>
                            <div class="form-group remaining_amount col-sm-4">
                                <label>Remaining Amount</label>
                                <input class="form-control calculate1" name="edit_remaining_amount" id="edit-remaining_amount" type="text"/>

                            </div>

                            <div class="form-group paid_date col-sm-4">
                                <label>Paid Date</label>
                                <input class="form-control datepicker" name="edit_paid_date" id="edit-paid_date" type="text" />

                            </div>


                            <div class="form-group amount_status col-sm-4">
                                <label>Amount Status</label>
                                <select class="selectpicker btn-round pl-0" data-size="7" id="edit-amount_status" name="edit_amount_status" data-style="btn-round btn btn-secondary" title="Select Amount Status">
                                    <option value="" disabled>Amount Status</option>
                                    <option value="Paid">Paid</option>
                                    <option value="Unpaid">Unpaid</option>
                                </select>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="">
                        <button type="submit" class="btn btn-round btn-success btn-link add-btn" >Update</button>
                    </div>
                    <div class="divider"></div>
                    <div class="">
                        <button type="button" class="btn btn-round btn-danger btn-link" data-dismiss="modal">Cancel</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
--}}
<div class="modal fade" id="show-permanent-kata-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-sm">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-remove"></i>
                </button>
                <h5 class="title title-up" id="modal-title">View Permanent Khata </h5>
            </div>
            <div class="modal-body row">
                <div class="col-sm-12">
                    <div class="row">

                        <div class="form-group name col-sm-4">
                            <label>Name</label>
                            <P id="show-name"></P>

                        </div>

                        <div class="form-group mobile col-sm-4">
                            <label>Mobile</label>
                            <P id="show-mobile"></P>

                        </div>
                        <div class="form-group mobile col-sm-4">
                            <label>Invoice</label>
                            <P id="show-Invoice"></P>

                        </div>
                        <div class="form-group current_date col-sm-4 select-wizard">
                            <label>Current Date</label>
                            <P id="show-current-date"></P>

                        </div>
                        <div class="form-group address col-sm-8 select-wizard">
                            <label>Address</label>
                            <P id="show-address"></P>
                        </div>
                        <div class="form-group total_amount col-sm-4">
                            <label>Total Amount</label>
                            <P id="show-total-amount"></P>
                        </div>
                        <div class="form-group paid_amount col-sm-4">
                            <label>Paid Amount</label>
                            <P id="show-paid-amount"></P>
                        </div>
                        <div class="form-group remaining_amount col-sm-4">
                            <label>Remaining Amount</label>
                            <P id="show-remaining-amount"></P>
                        </div>
                        <div class="form-group paid_date col-sm-4">
                            <label>Paid Date</label>
                            <P id="show-paid-date"></P>
                        </div>
                        <div class="form-group amount_status col-sm-4">
                            <label>Amount Status</label>
                            <P id="show-amount-status"></P>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="">
                    <button type="button" class="btn btn-round btn-danger btn-link" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('front_script')

<script src="{{asset('js/core/jspdf.min.js')}}"></script>
<script src="{{asset('js/core/jspdf-autotable.js')}}"></script>


<script src="{{asset('js/plugins/bootstrap-datetimepicker.js')}}"></script>
<script src="{{asset('js/demo.js')}}"></script>
<script src="{{asset('js/custom/permanent-katas.js')}}"></script>
@endsection
