@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')
 
<div class="content">
        <div class="row">
            <div class="col-md-3 border-right card ml-5">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    
 
                        <img class="rounded-circle mt-5" width="200px" height="200px" src="{{$user->photo()}}" alt="Default logo">
                 
                    <span class="font-weight-bold mt-4 profile-username"><h6>{{$user->name}}</h6></span>
                    <span class="text-black-50"><a href="mailto:{{$user->email}}" class="size-50">{{$user->email}}</a></span>
                    <span> </span>
                </div>
            </div>
            <div class="col-md-8 card">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Profile updated successfully!
                    </div>
                @endif
                <div class="card-header">
                    <h5 class="title">Edit Profile</h5> </div>
                <div class="card-body">
                    <form action="{{route('profile-update')}}" method="Post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" @error ('username') is-invalid @enderror  placeholder="" value="{{old('username', $user->username)}}" name="username" title="User Name">
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-6 ">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"  placeholder="Name" value="{{old('name', $user->name)}}">
                                    
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{  $message  }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-6 ">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password"  class="form-control @error('password') is-invalid @enderror" name="password" placeholder="" value="">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 ">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation"  class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="" value="">
                                    @error ('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 ">
                                <div class="form-group">
                                    <label>Company</label>
                                    <input type="text"  class="form-control @error('company') is-invalid @enderror" name="company" placeholder="" value="{{old('company', $user->company)}}">
                                    @error('company')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 ">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address"  class="form-control @error('address') is-invalid @enderror" placeholder="" value="{{old('address', $user->address)}}">
                                    @error ('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="phone"  value="{{old('phone', $user->phone)}}">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6 ">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{old('email', $user->email)}}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <label>User Image</label>
                                <input type="file" class="form-control" placeholder="" value="" name="user_image" title="User Image">
                                 
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-sm-12 mt-3">
                                <input type='submit' class='btn btn-secondary btn-round pull-right' name='finish' value='Update' />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
     
@endsection

