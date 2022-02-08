@extends('layouts.app')
@section('title', 'Temporary Khatas Invoice')
@section('content')

    <div class="content" id="content">
        <div class="page-content container">
            <div class="container px-0">
                <div class="row mt-4">
                    <div class="col-12">
                        <a href="#" class="btn btn-info btn-bold px-4 export float-right mt-3 mt-lg-0">PDF</a>
                    </div>
                    <div class="col-12 col-lg-12" id="Invoice">
                        <div class="row">
                            <div class="col-4 text-150 pt-25">
                                {{--<i class="fa fa-book fa-2x text-success-m2 mr-1"></i>--}}
                                <span class="text-default-d3"><img src="{{Auth::user()->photo()}}" width="100px" height="auto"></span>
                            </div>
                            <div class="col-8 text-150 pt-25">
                                <div class="text-grey-m2">
                                    <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                        {{Auth()->user()->company}}
                                    </div>

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Address:</span> {{Auth()->user()->address}}</div>

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Phone:</span> {{Auth()->user()->phone}}</div>

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
                                    <span class="text-600 text-110 text-blue align-middle"> {{$khata->user?$khata->user->name:''}}</span>
                                </div>
                                <div class="text-grey-m2">
                                    <div class="my-1">
                                        <i class="fa fa-address-card fa-flip-horizontal text-secondary"></i> <b class="text-600">{{$khata->address}}</b>
                                    </div>

                                    <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{$khata->user?$khata->user->phone:''}}</b></div>
                                    <div class="my-1"><i class="fa fa-user fa-flip-horizontal text-secondary"></i> <b class="text-600">
                                        @php if($khata->type==0){
                                        echo 'Temporary';
                                        }if($khata->type==1){
                                        echo  'Permanent';
                                        }elseif ($khata->type==2){
                                        echo  'Supplier';
                                        }@endphp
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

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #{{$khata->receipt_no}}</div>

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{$khata->paid_date}}</div>

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-warning badge-pill px-25">{{$khata->amount_status}}</span></div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="mt-4">
                            <div class="row text-600 text-white bgc-default-tp1">
                                <div class="d-none d-sm-block col-1">#</div>
                                <div class="col-2 col-sm-2">Total</div>
                                <div class="d-none d-sm-block col-4 col-sm-2">Paid</div>
                                <div class="d-none d-sm-block col-sm-2">Remaining</div>
                                <div class="d-none d-sm-block col-sm-2">Paid Date</div>
                                <div class="col-2">Status</div>
                            </div>

                            <div class="text-95 text-secondary-d3">
                                <div class="row mb-2 mb-sm-0 py-10">
                                    <div class="d-none d-sm-block col-1">1</div>
                                    <div class="col-2 col-sm-2">{{$khata->total_amount}}</div>
                                    <div class="d-none d-sm-block col-2">{{$khata->paid_amount}}</div>
                                    <div class="d-none d-sm-block col-2 text-95">{{$khata->remaining_amount}}</div>
                                    <div class="d-none d-sm-block col-2 text-95">{{$khata->paid_date}}</div>
                                    <div class="col-2 text-secondary-d2">{{$khata->amount_status}}</div>
                                </div>

                            </div>

                            <div class="row border-b-2 brc-default-l2"></div>

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
                                            <span class="text-150 text-success-d3 opacity-2">Rs {{$khata->remaining_amount}}</span>
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
        </div>

    </div>


@endsection

@section('front_css')
    <style>body{
    margin-top:20px;
    color: #484b51;
    }
    .text-secondary-d1 {
    color: #728299!important;
    }
    .page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
    }
    .page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
    }
    .brc-default-l1 {
    border-color: #dce9f0!important;
    }

    .ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
    }
    .mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
    }
    .mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
    }

    hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
    }

    .text-grey-m2 {
    color: #888a8d!important;
    }

    .text-success-m2 {
    color: #86bd68!important;
    }

    .font-bolder, .text-600 {
    font-weight: 600!important;
    }

    .text-110 {
    font-size: 110%!important;
    }
    .text-blue {
    color: #478fcc!important;
    }
    .pb-25, .py-25 {
    padding-bottom: .75rem!important;
    }

    .pt-25, .py-25 {
    padding-top: .75rem!important;
    }
    .bgc-default-tp1 {
    background-color: rgba(121,169,197,.92)!important;
    }
    .bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
    }
    .page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
    }

    .btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
    }
    .w-2 {
    width: 1rem;
    }

    .text-120 {
    font-size: 120%!important;
    }
    .text-primary-m1 {
    color: #4087d4!important;
    }

    .text-danger-m1 {
    color: #dd4949!important;
    }
    .text-blue-m2 {
    color: #68a3d5!important;
    }
    .text-150 {
    font-size: 150%!important;
    }
    .text-60 {
    font-size: 60%!important;
    }
    .text-grey-m1 {
    color: #7b7d81!important;
    }
    .align-bottom {
    vertical-align: bottom!important;
    }
    </style>

@endsection
@section('front_script')
    <script src="{{asset('js/core/html2pdf.bundle.min.js')}}"></script>
  {{--  <script src="{{asset('js/core/jspdf.min.js')}}"></script>
    <script src="{{asset('js/jspdf/jspdf-autotable.js')}}"></script>--}}
    <script src="{{asset('js/custom/katas.js')}}"></script>
   <script src="{{asset('js/demo.js')}}"></script>


    <script src="{{asset('js/plugins/bootstrap-datetimepicker.js')}}"></script>--}}

@endsection