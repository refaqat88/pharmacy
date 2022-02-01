<div class="row">
    <div class="col-md-12">




        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Permanent Kata's Record List</h6>
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
                        <th class=" text-center">S.No</th>
                        <th class="">Name</th>
                        <th class="">Receipt</th>
                        <th class="">Mobile</th>
                        <th class="">Total</th>
                        <th class="">Paid</th>
                        <th class="">Remaining</th>
                        <th class="">Paid Date</th>
                        <th class="">Amount Status</th>
                        <th class="disabled-sorting text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php $i=1;  @endphp
                    @if(!$allkatas->isEmpty())
                    @foreach ($allkatas as $key => $kata)

                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td>{{ $kata->user?$kata->user->name:'' }}</td>
                            <td>{{ $kata->receipt_no}}</td>
                            <td>{{ $kata->user?$kata->user->phone:'' }}</td>
                            <td>{{ $kata->total_amount }}</td>
                            <td>{{ $kata->paid_amount}}</td>
                            <td>{{ $kata->remaining_amount}}</td>
                            <td>{{ $kata->paid_date }}</td>
                            <td>{{ $kata->amount_status }}</td>
                            <td class="text-center">
                                <div class="col">
                                    <div class="dropdown  text-center">
                                        <button style="" class="dropdown-toggle btn-round  btn-sm btn text-info btn-link btn-cus-weight" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Manage
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton">
                                            <div class="dropdown-header">Manage user</div>

                                            <a class="dropdown-item show-katas" data-id="{{$kata->user?$kata->user->id:''}}" href="javascript:void(0)">Show</a>
                                            <a class="dropdown-item"  href="{{url('katas/invoice/'.$kata->user?$kata->user->id:'')}}">Invoice</a>
                                            <a class="dropdown-item edit-katas" data-id="{{$kata->user?$kata->user->id:''}}" href="javascript:void(0)">Edit</a>
                                            <a class="dropdown-item delete-katas" data-id="{{$kata->user?$kata->user->id:''}}" href="javascript:void(0)">Delete</a>

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
                    @else
                        <tr>
                            <td style="text-align: center; vertical-align: middle;" colspan="10" >No record exist!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div><!-- end content-->
        </div><!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->