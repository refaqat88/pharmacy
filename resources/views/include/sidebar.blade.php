<div class="sidebar" data-color="default" data-active-color="danger">

    <div class="logo">
        <a href="{{route('home')}}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{Auth::user()->photo()}}">
            </div>
            <!-- <p>CT</p> -->
        </a>


        <a href="{{route('home')}}" class="simple-text logo-normal">
            <img src="{{Auth::user()->photo()}}" height="auto" width="70px">

        </a>



    </div>
    <div class="sidebar-wrapper">
        <div class="user">

            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
              <span> Hi,
                {{Auth::user()->name}}     <b class="caret"></b>
              </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse @if(Request::routeIs('edit-profile')) show @endif" id="collapseExample">
                    <ul class="nav">

                        <li class="{{ Request::routeIs('edit-profile') ? 'active' : '' }}">
                            <a href="{{route('edit-profile')}}">
                                <span class="sidebar-mini-icon">EP</span>
                                <span class="sidebar-normal">Edit Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <span class="sidebar-mini-icon">lo</span>
                                <span class="sidebar-normal">Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">



            <li class="{{ Request::routeIs('home') ? 'active' : '' }}" >
                <a href="{{route('home')}}">
                    <i class="fa fa-dashboard"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @role('super admin')
            <li class="{{ Request::routeIs('users.index') ? 'active' : '' }}" >
                <a href="{{route('users.index')}}">
                    <i class="fa fa-users"></i>
                    <p>Users</p>
                </a>
            </li>
            @endrole


            {{--<li class="{{ Request::routeIs('roles.index') || Request::routeIs('roles.create') ? 'active' : '' || Request::routeIs('roles.show') ? 'active' : '' }}">

                <a href="{{route('roles.index')}}">
                    <i class="fa fa-user"></i>
                    <p>
                        Roles and Permission
                    </p>
                </a>

            </li>--}}

            <li class="{{Request::is('katas') || Request::is('katas/create') ? 'active' : '' || Request::is('katas/show') ? 'active' : '' || Request::is('katas/invoice') ? 'active' : '' }}">

                <a href="{{url('katas')}}">
                    <i class="fa fa-user"></i>
                    <p>
                        Khata's
                    </p>
                </a>

            </li>
            <li class="{{Request::is('products') || Request::is('product/create') ? 'active' : '' || Request::is('product/show') ? 'active' : '' || Request::is('product/invoice') ? 'active' : '' }}">

                <a href="{{url('products')}}">
                    <i class="fa fa-user"></i>
                    <p>
                        Products
                    </p>
                </a>

            </li>
         {{--   <li class="{{Request::is('bills')  ? 'active' : '' }}">

                <a href="{{url('bills')}}">
                    <i class="fa fa-user"></i>
                    <p>
                        Bills
                    </p>
                </a>

            </li>
            <li class="{{ Request::is('bill/add') ? 'active' : '' || Request::is('bill/create') ? 'active' : ''  ? 'active' : '' || Request::is('bill/invoice') ? 'active' : '' }}">

                <a href="{{url('bill/add')}}">
                    <i class="fa fa-user"></i>
                    <p>
                        Add Bill
                    </p>
                </a>

            </li>
--}}
            <li class="@if(Request::is('bills') || Request::is('bill/add')) active  @endif ">
                <a data-toggle="collapse" href="#bills-page">
                    <i class="fa fa-graduation-cap"></i>
                    <p>
                        Bills <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse @if(Request::is('bill/add') || Request::is('bills')) show  @endif  " id="bills-page">
                    <ul class="nav">
                        <li class="{{Request::is('bills')  ? 'active' : '' }}">

                            <a href="{{url('bills')}}">
                                <i class="fa fa-user"></i>
                                <p>
                                    Bills
                                </p>
                            </a>

                        </li>
                        <li class="{{ Request::is('bill/add') ? 'active' : '' || Request::is('bill/create') ? 'active' : ''  ? 'active' : '' || Request::is('bill/invoice') ? 'active' : '' }}">

                            <a href="{{url('bill/add')}}">
                                <i class="fa fa-user"></i>
                                <p>
                                    Add Bill
                                </p>
                            </a>

                        </li>
                    </ul>
                </div>
            </li>
            <li class="@if(Request::is('customer/bills') || Request::is('customer/bill/add')) active  @endif ">
                <a data-toggle="collapse" href="#customer-bills-page">
                    <i class="fa fa-graduation-cap"></i>
                    <p>
                        Customer Bills <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse @if(Request::is('customer/bill/add') || Request::is('customer/bills') ||  Request::is('customer/bill/create'))  show  @endif  " id="customer-bills-page">
                    <ul class="nav">
                        <li class="{{Request::is('customer/bills')  ? 'active' : '' }}">

                            <a href="{{url('customer/bills')}}">
                                <i class="fa fa-paperclip"></i>
                                <p>
                                    Customer Bills
                                </p>
                            </a>

                        </li>
                        <li class="{{ Request::is('customer/bill/add') ? 'active' : '' || Request::is('customer/bill/create') ? 'active' : '' }}">

                            <a href="{{url('customer/bill/add')}}">
                                <i class="fa fa-paperclip"></i>
                                <p>
                                    Add Customer Bill
                                </p>
                            </a>

                        </li>
                    </ul>
                </div>
            </li>
           {{-- <li class="{{Request::is('permanent-katas') || Request::is('permanent-katas/create') ? 'active' : '' || Request::is('permanent-katas/show') ? 'active' : '' || Request::is('permanent-katas/invoice/{id}') ? 'active' : '' }}">

                <a href="{{url('permanent-katas')}}">
                    <i class="fa fa-user"></i>
                    <p>
                        Permanent Khata's
                    </p>
                </a>

            </li>--}}
            <li class="{{Request::is('supplier-katas') || Request::is('supplier-katas/create') ? 'active' : '' || Request::is('supplier-katas/show') ? 'active' : '' || Request::is('supplier-katas/invoice/{id}') ? 'active' : '' }}">

                <a href="{{url('supplier-katas')}}">
                    <i class="fa fa-user"></i>
                    <p>
                        Supplier Khata's
                    </p>
                </a>

            </li>

            <li class="@if(Request::is('khata-reports') || Request::is('permanent-khata-reports')) active  @endif ">
                <a data-toggle="collapse" href="#reports">
                    <i class="fa fa-graduation-cap"></i>
                    <p>
                        Reports<b class="caret"></b>
                    </p>
                </a>
                <div class="collapse @if(Request::is('temporary-khata-reports') || Request::is('permanent-khata-reports')) show  @endif  " id="reports">
                    <ul class="nav">
                        <li  class="{{ Request::is('khata-reports') ? 'active' : '' }}">
                            <a href="{{ url('khata-reports')}}">
                                <span class="sidebar-mini-icon">KR</span>
                                <span class="sidebar-normal">Khata Reports</span>
                            </a>
                        </li>
                      {{--  <li class="{{ Request::is('permanent-khata-reports') ? 'active' : '' }}">
                            <a href="{{ url('permanent-khata-reports')}}">
                                <span class="sidebar-mini-icon">PKR</span>
                                <span class="sidebar-normal"> Permanent Khata Reports  </span>
                            </a>
                        </li>--}}
                    </ul>
                </div>
            </li>

            </ul>
    </div>
</div>
