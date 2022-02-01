<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Khata's Record List</h6>
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

                <div class="container px-0">
                    <div class="row mt-4">
                        <div class="col-12">
                            <a href="#" class="btn btn-info btn-bold px-4 export float-right mt-3 mt-lg-0">PDF</a>
                        </div>
                        <div class="col-12 col-lg-12" id="Invoice">
                            <div class="row">
                                <div class="col-4 text-150 pt-25">
                                    {{--<i class="fa fa-book fa-2x text-success-m2 mr-1"></i>--}}
                                    <span class="text-default-d3"><img src="{{asset('img/upload/logo/'.Auth()->user()->user_image)}}" width="100px" height="auto"></span>
                                </div>
                                <div class="col-8 text-150 pt-25">
                                    <div class="text-grey-m2">
                                        <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                            {{Auth()->user()->company}}
                                        </div>

                                        <div class="my-2"><span class="text-600 text-90">Address:</span> {{Auth()->user()->address}}</div>

                                        <div class="my-2"><span class="text-600 text-90">Phone:</span> {{Auth()->user()->phone}}</div>

                                        {{-- <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25">{{$user->kata?$user->kata->amount_status:''}}</span></div>--}}
                                    </div>
                                </div>
                            </div>
                            <!-- .row -->

                            <hr class="row brc-default-l1 mx-n1 mb-4" />

                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <span class="text-sm text-grey-m2 align-middle">To:</span>
                                        <span class="text-600 text-110 text-blue align-middle"> {{$khata!=''?$khata->name:''}}</span>
                                    </div>
                                    <div class="text-grey-m2">
                                        <div class="my-1">
                                            <i class="fa fa-address-card fa-flip-horizontal text-secondary"></i> <b class="text-600">{{$khata?$khata->kata->address:''}}</b>
                                        </div>

                                        <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{$khata?$khata->phone:''}}</b></div>
                                        <div class="my-1"><i class="fa fa-user fa-flip-horizontal text-secondary"></i> <b class="text-600">
                                                @php $type =$khata?$khata->kata->type:'';
                                                    if($type==0){
                                                    echo 'Temporary';
                                                    }if($type==1){
                                                    echo  'Permanent';
                                                    }elseif ($type==2){
                                                    echo  'Supplier';
                                                    }
                                                @endphp
                                            </b>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col -->

                                <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                    <hr class="d-sm-none" />
                                    <div class="text-grey-m2">
                                        <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                            Invoice
                                        </div>

                                        {{--<div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #{{$khata?$khata->kata->receipt_no:''}}</div>--}}

                                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span>{{date('Y-m-d')}}</div>

                                       {{-- <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25">{{$khata?$khata->kata->amount_status:''}}</span></div>--}}
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>

                            <div class="mt-4">
                                <div class="row text-600 text-white bgc-default-tp1">
                                    <div class="d-none d-sm-block col-1">#</div>
                                    <div class="col-2 col-sm-2">Total</div>
                                    <div class="col-1 col-sm-1">Invoice</div>
                                    <div class="d-none d-sm-block col-2 col-sm-2">Paid</div>
                                    <div class="d-none d-sm-block col-sm-2">Remaining</div>
                                    <div class="d-none d-sm-block col-sm-2">Paid Date</div>
                                    <div class="d-none d-sm-block col-sm-1">Page</div>
                                    <div class="col-1">Status</div>
                                </div>

                                @php $i=1; $last_remaing= 0;@endphp
                                @if(!$allkatas->isEmpty())
                                    @foreach ($allkatas as $key => $kata)
                                        @php
                                            $user_id = $kata->user?$kata->user->id:'';
                                             if($kata->type==0){
                                             $type = 'Temporary';
                                             }if($kata->type==1){
                                               $type = 'Permanent';
                                             }elseif ($kata->type==2){
                                              $type = 'Supplier';
                                             }
                                            $last_remaing = $allkatas?$allkatas->last()->remaining_amount:0;

                                        @endphp

                                <div class="text-95 text-secondary-d3">
                                    <div class="row mb-2 mb-sm-0 py-10">
                                        <div class="d-none d-sm-block col-1">{{$i++}}</div>
                                        <div class="col-2 col-sm-2">{{$kata->total_amount}}
                                        </div><div class="col-1 col-sm-1">{{$kata->receipt_no}}</div>
                                        <div class="d-none d-sm-block col-2">{{$kata->paid_amount}}</div>
                                        <div class="d-none d-sm-block col-2 text-95">{{$kata->remaining_amount}}</div>
                                        <div class="d-none d-sm-block col-2 text-95">{{$kata->paid_date}}</div>
                                        <div class="d-none d-sm-block col-1 text-95">{{$kata->page_no}}</div>
                                        <div class="col-1 text-secondary-d2">{{$kata->amount_status}}</div>
                                    </div>

                                </div>


                                <div class="row border-b-2 brc-default-l2"></div>
                                @endforeach
                             @else
                                    <div class="text-95 text-secondary-d3">
                                        <div class="row">
                                            <div class="d-none d-sm-block col-12 text-center pt-2">No record Exist</div>
                                        </div>

                                    </div>
                            @endif
                                <!-- or use a table instead -->
                                <!--
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                                <thead class="bg-none bgc-default-tp1">
                                    <tr class="text-white">
                                        <th class="opacity-2">#</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th width="140">Amount</th>
                                    </tr>
                                </thead>

                                <tbody class="text-95 text-secondary-d3">
                                    <tr></tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Domain registration</td>
                                        <td>2</td>
                                        <td class="text-95">$10</td>
                                        <td class="text-secondary-d2">$20</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        -->

                                <div class="row mt-3">
                                    <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                        {{--Extra note such as company or payment information...--}}
                                    </div>

                                    <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                        {{--    <div class="row my-2">
                                                <div class="col-7 text-right">
                                                    Remaining Amount
                                                </div>
                                                <div class="col-5">
                                                    <span class="text-120 text-secondary-d1">$2,250</span>
                                                </div>
                                            </div>

                                            <div class="row my-2">
                                                <div class="col-7 text-right">
                                                    Tax (10%)
                                                </div>
                                                <div class="col-5">
                                                    <span class="text-110 text-secondary-d1">$225</span>
                                                </div>
                                            </div>--}}

                                        <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                            <div class="col-7 text-right">
                                                Remaining Amount
                                            </div>
                                            <div class="col-5">
                                                <span class="text-150 text-success-d3 opacity-2">Rs {{$last_remaing}} </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr />

                                <div>
                                    <span class="text-secondary-d1 text-105">Thank you for your business</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               {{-- <table id="datatable" data-id="datatable" class="table table-hover custom_border" cellspacing="0" width="100%">
                    <thead class="table-secondary">
                    <tr>
                        <th style="font-size:12px" class=" text-center">S.No</th>
                        <th style="font-size:12px" class="">Name</th>
                        <th style="font-size:12px" class="">Receipt</th>
                        <th style="font-size:12px" class="">Mobile</th>
                        <th style="font-size:12px" class="">Total</th>
                        <th style="font-size:12px" class="">Paid</th>
                        <th style="font-size:12px" class="">Remaining</th>
                        <th style="font-size:12px" class="">Paid Date</th>
                        <th style="font-size:12px" class="">Status</th>
                        <th style="font-size:12px" class="">Type</th>
                        <th style="font-size:12px" class="disabled-sorting text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php $i=1; @endphp
                    @if(!$allkatas->isEmpty())
                    @foreach ($allkatas as $key => $kata)
                       @php
                           $user_id = $kata->user?$kata->user->id:'';
                            if($kata->type==0){
                            $type = 'Temporary';
                            }if($kata->type==1){
                              $type = 'Permanent';
                            }elseif ($kata->type==2){
                             $type = 'Supplier';
                            }

                       @endphp
                        <tr>
                            <td class="w-1 text-center">{{$i++}}</td>
                            <td>{{ $kata->user?$kata->user->name:'' }}</td>
                            <td>{{ $kata->receipt_no}}</td>
                            <td>{{ $kata->user?$kata->user->phone:'' }}</td>
                            <td>{{ $kata->total_amount!=''?$kata->total_amount:0 }}</td>
                            <td>{{ $kata->paid_amount}}</td>
                            <td>{{ $kata->remaining_amount}}</td>
                            <td>{{ $kata->paid_date }}</td>
                            <td>{{ $kata->amount_status }}</td>
                            <td>{{ $type }}</td>
                            <td class="text-center">
                                <div class="col">
                                    <div class="dropdown  text-center">
                                        <button style="" class="dropdown-toggle btn-round  btn-sm btn text-info btn-link btn-cus-weight" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Manage
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton">
                                            <div class="dropdown-header"><a class="dropdown-item"  href="{{url('report/invoice/'.$kata->id)}}">Invoice</a></div>

                                            --}}{{--<a class="dropdown-item show-katas" data-id="{{$kata->id}}" href="javascript:void(0)">Show</a>

                                            <a class="dropdown-item edit-katas" data-id="{{$kata->id}}" href="javascript:void(0)">Edit</a>
                                            <a class="dropdown-item delete-katas" data-id="{{$kata->id}}" href="javascript:void(0)">Delete</a>
--}}{{--
                                            --}}{{--{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $kata->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'dropdown-item']) !!}
                                            {!! Form::close() !!}--}}{{--


                                            --}}{{-- <a class="dropdown-item reset-password-user" data-id="{{ $parent->id }}">Reset Password</a>--}}{{--


                                        </div>
                                    </div>


                                </div>

                            </td>
                        </tr>

                    @endforeach

                    @else
                        <tr>
                            <td style="text-align: center; vertical-align: middle;" colspan="11" >No record exist!</td>
                        </tr>
                    @endif

                    </tbody>
                </table>--}}
            </div><!-- end content-->
        </div><!--  end card  -->
    </div> <!-- end col-md-12 -->
</div> <!-- end row -->

