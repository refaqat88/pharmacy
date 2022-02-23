<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title> Pharmacy | @yield('title')</title>
    <meta name="_token" content="{{csrf_token()}}"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/paper-dashboard-2-pro"/>
    <!--  Social tags      -->
    <meta name="keywords"
          content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 4 dashboard, bootstrap 4, css3 dashboard, bootstrap 4 admin, paper dashboard bootstrap 4 dashboard, frontend, responsive bootstrap 4 dashboard, paper design, paper dashboard bootstrap 4 dashboard">
    <meta name="description"
          content="Paper Dashboard PRO is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you.">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Paper Dashboard PRO by Creative Tim">
    <meta itemprop="description"
          content="Paper Dashboard PRO is a beautiful Bootstrap 4 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you.">
    <meta itemprop="image" content="../../../s3.amazonaws.com/creativetim_bucket/products/84/opt_pd2p_thumbnail.jpg">
    <!-- Twitter Card data -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet"/>
    <link href="{{asset('css/fontawesome/font-awesome.min.css')}}" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/fontawesome/font-awesome.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/fontawesome/fontawesome.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/paper-dashboard.min1036.css?v=2.1.1')}}" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->


    <!-- Sweet alert cdn -->
    <link rel="stylesheet" href="{{asset('css/sweetalert/sweetalert.css')}}"  crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{asset('css/demo.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/jquery/jquery-confirm.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/datepicker/bootstrap-datepicker.min.css')}}"  />
    <link href="{{asset('css/paper-dashboard.min1036.css')}}" rel="stylesheet"/>


    <link rel="stylesheet" href="{{asset('css/jquery/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet')}}"/>
    <style> .sweet-alert div.form-group {
            display: none !important;
        }
    </style>

@yield('front_css')
<!-- Extra details for Live View on GitHub Pages -->
    <!-- Google Tag Manager -->
{{-- <script>
     (function (w, d, s, l, i) {
         w[l] = w[l] || [];
         w[l].push({
             'gtm.start': new Date().getTime(),
             event: 'gtm.js'
         });
         var f = d.getElementsByTagName(s)[0],
             j = d.createElement(s),
             dl = l != 'dataLayer' ? '&l=' + l : '';
         j.async = true;
         j.src =
             '../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
         f.parentNode.insertBefore(j, f);
     })(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
 </script>--}}
<!-- End Google Tag Manager -->
</head>

<body class="" onload="cl();">
<!-- Extra details for Live View on GitHub Pages -->
<!-- Google Tag Manager (noscript) -->
<noscript>

</noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="wrapper ">

    @include('include.sidebar');

    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-minimize">
                        <button id="minimizeSidebar" class="btn btn-icon btn-round">
                            <i class="fa fa-lg fa-angle-right text-center visible-on-sidebar-mini"></i>
                            <i class="mni fa fa-lg fa-angle-left text-center visible-on-sidebar-regular"></i>
                        </button>
                    </div>
                    <div class="navbar-toggle">
                        <button type="button" class="navbar-toggler">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <a class="navbar-brand" href="javascript:;">Pharmacy</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navigation">

                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link btn-rotate" href="{{ url('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i>
                            </a>

                            <form id="logout-form" action="{{ url('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>


                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->


        @yield('content')



        {{--footer--}}


        <footer class="footer footer-black  footer-white ">
            <div class="container-fluid">
                <div class="row">
                    <nav class="footer-nav">
                        <ul>
                            <li><a href="#" target="_blank">Pharmacy</a></li>
                        </ul>
                    </nav>
                    <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script> by Point Web Tech Pvt Ltd
              </span>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<!--   Core JS Files   -->
<script> var base_url = "{{ env('APP_URL') }}";
    var asset_url = "{{ env('ASSET_URL') }}";

</script>

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/slidmini.js')}}"></script> {{-- sidebar slide adjust--}}
{{--<script src="{{asset('adminassets/js/core/jquery.min.js')}}"></script>--}}
<script src="{{asset('js/core/popper.min.js')}}"></script>
<script src="{{asset('js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('js/plugins/moment.min.js')}}"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset('js/plugins/bootstrap-switch.js')}}"></script>
<!--  Plugin for Sweet Alert -->
<script src="{{asset('js/plugins/sweetalert.min.js')}}"></script>
<!-- Forms Validations Plugin -->
<script src="{{asset('js/plugins/jquery.validate.min.js')}}"></script>
<!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="{{asset('js/plugins/jquery.bootstrap-wizard.js')}}"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="{{asset('js/plugins/bootstrap-selectpicker.js')}}"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="{{asset('js/plugins/bootstrap-datetimepicker.js')}}"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="{{asset('js/plugins/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('js/core/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('js/core/jszip.min.js')}}"></script>
<script src="{{asset('js//core/buttons.print.min.js')}}"></script>
<script src="{{asset('js/core/pdfmake.min.js')}}"></script>
<script src="{{asset('js/core/vfs_fonts.js')}}"></script>
<script src="{{asset('js/core/buttons.html5.min.js')}}"></script>

<script src="{{asset('js/plugins/bootstrap-tagsinput.js')}} "></script>
<script src="{{asset('js/plugins/jasny-bootstrap.min.js')}}"></script>

<script src="{{asset('js/plugins/nouislider.min.js')}}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Chart JS -->
<script src="{{asset('js/plugins/chartjs.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('js/paper-dashboard.min1036.js?v=2.1.1')}}" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->



@include('include.common_script');



@yield('front_script')




</body>





</html>


