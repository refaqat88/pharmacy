@extends('layouts.app')
@section('title', 'Show Role')
@section('content')

    <div class="content">
        <div class="row">

            <div class="col-md-12 card">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-header">
                    <h5 class="title">Show Role</h5> </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <strong>Name</strong>
                                {{ $role->name }}
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-12 ">
                            <div class="form-group">
                                <strong>Permission</strong>
                                <br>
                                @if(!empty($rolePermissions))
                                    @foreach($rolePermissions as $v)
                                        <label class="label label-success">{{ $v->name }}</label><br>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-12 mt-3">
                           {{-- <input type='submit' class='btn btn-secondary btn-round pull-right' name='finish' value='Add' />--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

