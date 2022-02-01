@extends('layouts.app')
@section('title', 'Temporary Katas Invoice')
@section('content')

    <div class="content" id="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <button class="btm btn-secondary export float-right">Print</button>
                </div>
                    <div class="col-12" id="Invoice">

                    <div class="card">

                        <div class="card-body p-0">
                            <div class="row p-5">
                                <div class="col-md-6">
                                    <img src="{{asset('img/logo.png')}}" width="100px" height="auto">
                                </div>

                                <div class="col-md-6 text-right">
                                    <p class="font-weight-bold mb-1">Gets Pharmacy</p>
                                    <p class="text-muted">Islamabad</p>
                                    <p class="text-muted">0123456789</p>
                                </div>
                            </div>

                            <hr class="my-5">

                            <div class="row pb-5 p-5">
                                <div class="col-md-6">
                                    <p class="font-weight-bold mb-4">Client Information</p>
                                    <p class="mb-1">{{$user->name}}</p>
                                    <p>{{$user->kata?$user->kata->address:''}}</p>
                                    <p class="mb-1">{{$user->phone}}</p>
                                    <p>@php
                                            $type = $user->kata?$user->kata->type:'';
                                            if($type==0){
                                             echo 'Temporary';
                                             }if($type==1){
                                             echo  'Permanent';
                                             }elseif ($type==2){
                                              echo  'Supplier';
                                             }
                                        @endphp
                                       </p>
                                </div>

                                <div class="col-md-6 text-right">
                                    <p class="font-weight-bold mb-4">Payment Details</p>
                                    <p class="mb-1"><span class="text-muted">Invoice: </span> Invoice #{{$user->kata?$user->kata->receipt_no:''}}</p>
                                    <p class="mb-1"><span class="text-muted">Date: </span> {{date('Y-m-d')}}</p>
                                    {{--<p class="mb-1"><span class="text-muted">Payment Type: </span> Root</p>--}}
                                    {{--<p class="mb-1"><span class="text-muted">Phone: {{$company->phone}} </span></p>--}}
                                </div>
                            </div>

                            <div class="row p-5">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="border-0 text-uppercase small font-weight-bold">Total Amount</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Paid Amount</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Remaining Amount</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Paid Date</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Amount Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{$user->kata?$user->kata->total_amount:''}}</td>
                                            <td>{{$user->kata?$user->kata->paid_amount:''}}</td>
                                            <td>{{$user->kata?$user->kata->remaining_amount:''}}</td>
                                            <td>{{$user->kata?$user->kata->paid_date:''}}</td>
                                            <td>{{$user->kata?$user->kata->amount_status:''}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="d-flex flex-row-reverse  p-4">

                                <div class="py-3 px-5 text-right">
                                    <div class="mb-2">Remaining Amount</div>
                                    <div class="font-weight-light">Rs {{$user->kata?$user->kata->remaining_amount:''}}</div>
                                </div>

                                {{--<div class="py-3 px-5 text-right">
                                    <div class="mb-2">Paid Amount</div>
                                    <div class="font-weight-light">Rs {{$user->kata?$user->kata->paid_amount:''}}</div>
                                </div>


                                <div class="py-3 px-5 text-right">

                                    <div class="mb-2">Grand Total</div>
                                    <div class="font-weight-light">Rs {{$user->kata?$user->kata->total_amount:''}}</div>
                                </div>--}}



                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>


@endsection

@section('front_script')
    <script src="{{asset('js/core/html2pdf.bundle.min.js')}}"></script>
  {{--  <script src="{{asset('js/core/jspdf.min.js')}}"></script>
    <script src="{{asset('js/jspdf/jspdf-autotable.js')}}"></script>--}}
    <script src="{{asset('js/custom/katas.js')}}"></script>
   <script src="{{asset('js/demo.js')}}"></script>


    <script src="{{asset('js/plugins/bootstrap-datetimepicker.js')}}"></script>--}}

@endsection