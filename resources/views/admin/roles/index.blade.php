@extends('layouts.app')
@section('title', 'Role')
@section('content')

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <div class="row">
                            <h4 class="card-title col-md-6 mr-0">Role</h4>
                            <div class="col-md-6">
                                <a type="button" class="btn btn-secondary btn-round float-right" href="{{ route('roles.create') }}">Add Role</a>
                            </div>
                        </div>
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="card-title">Role Record List</h6>
                                </div>
                                <div class="card-body">
                                    <div class="toolbar">
                                        <div class="form-group col-sm-2 select-wizard">
                                        </div>
                                        <div class="row">
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
                                        </div>
                                        <!--        Here you can write extra buttons/actions for the toolbar              -->
                                    </div>

                                    <table id="datatable" class="table table-hover custom_border" cellspacing="0" width="100%">
                                        <thead class="table-secondary">
                                        <tr>
                                            <th class=" text-center w-10">S.No</th>
                                            <th class="w-25">Name</th>
                                            <th class="w-10 disabled-sorting text-center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach ($roles as $key => $role)

                                            <tr>
                                                <td class="text-center">{{$i++}}</td>
                                                <td>{{ $role->name }}</td>
                                                <td class="text-center">
                                                    <div class="col">


                                                        <div class="dropdown  text-center">
                                                            <button style="" class="dropdown-toggle btn-round  btn-sm btn text-info btn-link btn-cus-weight" type="button" id="dropdownMenuButton"
                                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Manage
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton">
                                                                <div class="dropdown-header">Manage user</div>


                                                                <a class="dropdown-item show-parent" href="{{ route('roles.show',$role->id) }}">Show</a>


                                                                <a class="dropdown-item edit-parent" href="{{ route('roles.edit',$role->id) }}">Edit</a>

                                                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                                {!! Form::submit('Delete', ['class' => 'dropdown-item']) !!}
                                                                {!! Form::close() !!}


                                                                {{-- <a class="dropdown-item reset-password-user" data-id="{{ $parent->id }}">Reset Password</a>--}}


                                                            </div>
                                                        </div>


                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {!! $roles->render() !!}
                                </div><!-- end content-->
                            </div><!--  end card  -->
                        </div> <!-- end col-md-12 -->
                    </div> <!-- end row -->

                </div>

            </div>

        </div>

    </div>


@endsection



