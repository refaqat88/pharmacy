@extends('layouts.app')
@section('title', 'Edit Role')
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
                    <h5 class="title">Edit Role</h5> </div>
                <div class="card-body">
                    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label>Name</label>
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-12 ">
                            <div class="form-group">
                                <label>Permission</label>
                                <br>
                                <strong>Permission:</strong>
                                <br/>
                                @foreach($permission as $value)
                                    <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                        {{ $value->name }}</label>
                                    <br/>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-sm-12 mt-3">
                            <a href="{{Route('roles.index')}}" class="btn btn-warning cancel pull-right" data-title=" ">Cancel</a>
                            <button type="submit" class="btn btn-secondary btn-round pull-right">Update</button>

                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

