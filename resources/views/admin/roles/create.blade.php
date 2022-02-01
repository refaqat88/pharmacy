@extends('layouts.app')
@section('title', 'Create Role')
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
                    <h5 class="title">Create New Role</h5> </div>
                <div class="card-body">
                    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $error->message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-12 ">
                                <div class="form-group">
                                    <label>Permission</label>
                                    <br>
                                    @foreach($permission as $value)
                                        <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            {{ $value->name }}</label>
                                        <br/>
                                    @endforeach
                                    @error('permission')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{  $message  }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-12 mt-3">
                                <input type='submit' class='btn btn-secondary btn-round pull-right' name='finish' value='Add' />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        @endsection

