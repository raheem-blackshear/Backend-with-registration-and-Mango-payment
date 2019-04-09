@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit Profile</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('edit-profile') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                @if(session()->has('message'))
                                    <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Username (disabled)</label>
                                    <input type="hidden" name="username" value="{{ $admin->username }}">
                                    <input type="email" class="form-control" disabled="" value="{{ $admin->username }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Nome Cognome</label>
                                    <input type="text" class="form-control" name="nome_cognome" value="{{ $admin->nome_cognome }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Old Password</label>
                                    <input type="password" name="old_password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">New Password</label>
                                    <input type="password" name="new_password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Repeat Password</label>
                                    <input type="password" name="repeat_password" class="form-control">
                                </div>
                            </div>
                        </div>
{{--                        <input type="submit" name="submit" value="Update Profile">--}}
                        <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>

@endsection