@extends('layouts.master')

@section('title')
    Login/Register
@endsection

@section('content')
    @if(count($errors) > 0)
        <div class="row err_container">
            <div class="col-md-4 col-md-offset-4 error_register">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <h3>Register</h3>
            <form action="{{ 'register' }}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="first_name">Your First Name</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name')}}">
                </div>
                <div class="form-group">
                    <label for="email">Your E-Mail</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email')}}">
                </div>
                <div class="form-group">
                    <label for="password">Your Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="{{Request::old('password')}}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Log in</h3>
            <form action={{ 'login' }} method="post">
                {!! csrf_field() !!}
                <div class="form-group {{ $errors->has('email')? 'has-error' : ''}}">
                    <label for="email">Your E-Mail</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group {{ $errors->has('password')? 'has-error' : ''}}">
                    <label for="password">Your Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection