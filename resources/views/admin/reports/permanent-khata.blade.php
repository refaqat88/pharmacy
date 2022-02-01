@extends('layouts.app')
@section('title', 'Temporary Khata Reports')
@section('content')
    <style type="text/css">
        .error{ color: red; }
        .hide{ display: none; }
        input[type="checkbox"], input[type="radio"]{ margin-top: 10px}
    </style>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Permanent Khata Reports</h4>
                    </div>
                    <div class="card-body">
                        <form id="FormPermanentReport" action="{{ url('reportAdmissionAjax')}}" method="post">

                            @include('include.filter_form');

                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('load')

        <div id="exame_report_content">


        </div>




    </div>

@endsection

@section('front_script')
    <script src="{{asset('js/demo.js')}}"></script>
    <script src="{{asset('js/plugins/bootstrap-datetimepicker.js')}}"></script>

    <script src="{{asset('js/custom/report.js')}}"></script>
    {{--<script src="{{asset('js/custom/katas.js')}}"></script>--}}


@endsection