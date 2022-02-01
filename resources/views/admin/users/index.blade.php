@extends('layouts.app')
@section('title', 'Users')
@section('content')
<style>
    .ad {
        border-bottom: 1px solid #ddd;
        padding: 16px 0px 0 16px;
        margin-left: 3px;
    }
     .add-div-error{
         color: red;
     }
    .edit-div-error{
        color: red;
    }

</style>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                  <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Users</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 pull-right">

                                    <button class="btn btn-round btn-secondary pull-right" data-toggle="modal" id="show-user-btn">
                                        Add New User
                                    </button>

                                </div>
                            </div>
                            <div class="modal fade" id="user-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-sm">
                                    <div class="modal-content">
                                        <form id="user-form" action="" method="Post">
                                            @csrf
                                        <div class="modal-header justify-content-center">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                            <h5 class="title title-up" id="modal-title">New User Details</h5>
                                        </div>
                                        <div class="modal-body row">
                                            <div class="col-sm-4">
                                                <div class="row">

                                                    <div class="form-group col-sm-12">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" placeholder="" name="username" required="true"/>
                                                        <div class="add-div-error username"></div>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-lg-12">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" placeholder="" name="name" required="true"/>
                                                        <div class="add-div-error name"></div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-sm-8">
                                                <div class="row">
                                                    <div class="form-group col-sm-6 select-wizard">
                                                        <label>Password *</label>
                                                        <input class="form-control" name="password" id="userPassword" type="password" required="true" />
                                                        <div class="add-div-error password"></div>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label>Confirm sPassword *</label>
                                                        <input class="form-control" name="password_confirmation" id="userconfirmpassword" type="password" required="true" equalTo="#registerPassword" />
                                                        <div class="add-div-error password_confirmation"></div>
                                                    </div>
                                                    <div class="pull-right col-sm-6">


 
                                                    </div>

                                                    <div class="form-check ml-2 mt-4 col-sm-12 checkbox-general">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" name="status">
                                                            <span class="form-check-sign"></span>
                                                           Check if user is inactive
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                       
                                        <div class="modal-footer">
                                            <div class="">
                                                <button type="submit" class="btn btn-round btn-success btn-link add-btn" id="save-btn">Save</button>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="">
                                                <button type="button" class="btn btn-round btn-danger btn-link" data-dismiss="modal">Cancel</button>
                                            </div>

                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-sm">
                                    <div class="modal-content">
                                        <form id="edit-user-form" action="" method="Post">
                                            @csrf
                                            <input type="hidden" name="id" id="edit-user-id">
                                        <div class="modal-header justify-content-center">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                            <h5 class="title title-up" id="modal-title">Edit User Details</h5>
                                        </div>
                                        <div class="modal-body row">
                                            <div class="col-sm-4">
                                                <div class="row">

                                                    <div class="form-group col-sm-12">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" placeholder="" name="username"  id="edit-username" />
                                                        <div class="edit-div-error username"></div>
                                                    </div>
                                                    <div class="form-group col-sm-12 col-lg-12">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" placeholder="" name="name"  id="edit-name"/>
                                                        <div class="edit-div-error given_name"></div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-sm-8">
                                                <div class="row">

                                                    <div class="form-group col-sm-6 select-wizard">
                                                        <label>Password</label>
                                                        <input class="form-control" name="password" id="edituserPassword" type="password"/>
                                                        <div class="edit-div-error password"></div>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label>Confirm Password *</label>
                                                        <input class="form-control" name="password_confirmation" id="edituserconfirmpassword" type="password" />
                                                        <div class="edit-div-error password_confirmation"></div>
                                                    </div>
                                                     
                                                </div>
                                                <div class="row">
                                                    <div class="form-check form-group col-sm-12 col-lg-6 checkbox-general ml-3">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox" name="status" id="edit-status" />
                                                            <span class="form-check-sign"></span>
                                                            Check if user is inactive
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </form>


                                        <div class="modal-footer">
                                            <div class="">
                                                <button type="submit" class="btn btn-round btn-success btn-link  btn-sm update-btn" id="edit-save-btn">Update</button>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="">
                                                <button type="button" class="btn btn-round btn-danger btn-link btn-sm" data-dismiss="modal">Cancel</button>
                                            </div>
                                           </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="show-user-modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header justify-content-center">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                            <h5 class="title title-up" id="modal-title">view User Detail</h5>
                                        </div>
                                        <div class="modal-body row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="form-group col-sm-6 ">
                                                        <label>User Type</label>
                                                        <p class="ad" id="show-user-type">No Value</p>
                                                    </div>
                                                    <div class="form-group col-sm-6 ">
                                                        <label>Name</label>
                                                        <p class="ad" id="show-name">No Value</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="divider"></div>
                                            <div class="col-sm-6  ex1">
                                                <div class="row">
                                                    <div class=" col-sm-6 select-wizard">
                                                        <label>User Name</label>
                                                        <p class="ad" id="show-username">No Value</p>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label>Status</label>
                                                        <p class="ad" id="show-status">No Value</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="modal-footer">
                                            <div class="">
                                                <button type="submit" class="btn btn-round btn-secondary btn-sm btn-link" data-dismiss="modal" id="show-save-btn">Save</button>
                                            </div>

                                            <div class="">
                                                <button type="button" class="btn btn-round btn-danger btn-link btn-sm" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
{{--                                @if(session()->has('message'))--}}
{{--                                    <div class="alert alert-success" id="success-alert">--}}
{{--                                        {{ session()->get('message') }}--}}
{{--                                    </div>--}}
{{--                                @endif--}}
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title">Record List</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="toolbar">
                                            <div class="form-group col-sm-2 select-wizard">
                                                {{--                                                <select class="selectpicker" data-size="5" name="class_name" data-style="btn btn-sm btn-secondary btn-round"--}}
                                                {{--                                                        title="Filter" required="true">--}}
                                                {{--                                                    <option value="" disabled >Select Class</option>--}}
                                                {{--                                                    @foreach($classes as $class)--}}
                                                {{--                                                        <option value="{{$class->cls_Id}}">{{$class->class}}</option>--}}
                                                {{--                                                    @endforeach--}}
                                                {{--                                                </select>--}}
                                            </div>
                                         
                                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                                        </div>

                                        <table id="datatable" data-id="datatable"  class="table table-hover custom_border" cellspacing="0" width="100%">
                                            <thead class="table-secondary">
                                            <tr>
                                                <th class="text-center w-auto">SNo</th>
                                                <th class="w-30">Name</th>
                                                <th class="w-20">Username</th>
                                                <th class="w-10">Status</th>
                                                <th class="w-15 disabled-sorting text-center">Actions</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @php $i= 1;@endphp
                                            @foreach($users as $user)
                                            <tr>
                                                <td class="text-center">{{$i++}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->username}}</td>

                                                <td>{{$user->status}}</td>
                                                <td class="text-center disabled-sorting">
                                                    <div class="col-lg-6 text-center  col-md-6 col-sm-1">

                                                        
                                                        <div class="dropdown text-center">
                                                            <button style="" class="dropdown-toggle text-left btn-link  btn-round  btn-sm btn text-info  btn-cus-weight"  id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Manage
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right">


                                                                <a class="dropdown-item" href="#" id="show-user" data-id="{{ $user->id }}"> View Profile</a>
                                                                




                                                                <a class="dropdown-item" href="#" id="edit-user" data-id="{{ $user->id }}"> Edit User</a>




                                                                <a class="dropdown-item reset-password-user" data-id="{{ $user->id }}" href="#"> Reset Password</a>


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

                    <!--<div class="card-footer text-right">-->
                    <!--<div class="form-check pull-left">-->
                    <!--<label class="form-check-label">-->
                    <!--<input class="form-check-input" type="checkbox" name="optionCheckboxes" required>-->
                    <!--<span class="form-check-sign"></span>-->
                    <!--Subscribe to newsletter-->
                    <!--</label>-->
                    <!--</div>-->
                    <!--<button type="submit" class="btn btn-primary">Register</button>-->
                    <!--</div>-->
            </div>

        </div>

    </div>

@endsection

@section('front_css')
    <link rel="stylesheet" href="{{asset('custom.css')}}">
@endsection
@section('front_script')

    <script src="{{asset('adminassets/validator/dist/jquery.validate.js')}}"></script>
    <script src="{{asset('js/custom/user_script.js')}}"></script>
     

@endsection

