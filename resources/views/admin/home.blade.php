@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-2 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-money text-info"></i>
                                </div>
                            </div>
                            <div class="col-10 col-md-8">
                                <div class="numbers">
                                    <p class="card-category"><small><b>Temporary Khata</b></small></p>
                                    <p class="card-title">{{$data['temporary']?$data['temporary']:0}} <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            {{--<i class="fa fa-clock-o"></i>
                            Today--}}
                        </div>
                    </div>
                </div>
            </div>
           {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-2 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-money text-info"></i>
                                </div>
                            </div>
                            <div class="col-10 col-md-8">
                                <div class="numbers">
                                    <p class="card-category"><small><b>Temporary Khata Revenue</b></small></p>
                                    <p class="card-title">{{$data['temporary_revenue']?$data['temporary_revenue']:''}}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                           --}}{{-- <i class="fa fa-refresh"></i>--}}{{--
                           --}}{{-- Update now--}}{{--
                        </div>
                    </div>
                </div>
            </div>--}}
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-2 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-money text-info"></i>
                                </div>
                            </div>
                            <div class="col-10 col-md-8">
                                <div class="numbers">
                                    <p class="card-category"><small><b>Permanent Khata</b></small></p>
                                    <p class="card-title">{{$data['permanent']?$data['permanent']:0}}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                           {{-- <i class="fa fa-refresh"></i>--}}
                           {{-- Update now--}}
                        </div>
                    </div>
                </div>
            </div>
          {{--  <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-2 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-money text-info"></i>
                                </div>
                            </div>
                            <div class="col-10 col-md-8">
                                <div class="numbers">
                                    <p class="card-category"><small><b>Permanent Khata Revenue</b></small></p>
                                    <p class="card-title">{{$data['permanent_revenue']?$data['permanent_revenue']:''}}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                           --}}{{-- <i class="fa fa-refresh"></i>--}}{{--
                           --}}{{-- Update now--}}{{--
                        </div>
                    </div>
                </div>
            </div>--}}
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-2 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-money text-success"></i>
                                </div>
                            </div>
                            <div class="col-10 col-md-8">
                                <div class="numbers">
                                    <p class="card-category"><small><b>Suplier Expenses</b></small></p>
                                    <p class="card-title">{{$data['expenses']?$data['expenses']:0}}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            {{--<i class="fa fa-calendar-o"></i>
                            Last Day--}}
                        </div>
                    </div>
                </div>
            </div>
           {{-- <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-2 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="fa fa-money text-info"></i>
                                </div>
                            </div>
                            <div class="col-10 col-md-8">
                                <div class="numbers">
                                    <p class="card-category"><small><b>Supplier Revenue</b></small></p>
                                    <p class="card-title">{{$data['revenue']?$data['revenue']:''}}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            --}}{{--<i class="fa fa-calendar-o"></i>
                            Last day--}}{{--
                        </div>
                    </div>
                </div>
            </div>--}}

        </div>

    </div>
@endsection
