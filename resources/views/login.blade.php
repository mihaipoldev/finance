@extends('layouts.master')

@section('title')
    Finance - Welcome
@endsection

@section('main')
    <main>
        <section class="container">
            @if(count($errors) > 0)
                <div class="row">
                    <div class="col-xs-12">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <div class="row">
                {{--<div class="col-sm-4">--}}
                    {{--<h3>Sign Up</h3>--}}
                    {{--<form action="{{ route('signup') }}" method="post" autocomplete="off">--}}
                        {{--<div class="form-group {{ $errors->has('register_username') ? 'has-error' : '' }}">--}}
                            {{--<label for="register-username">Username</label>--}}
                            {{--<input class="form-control" type="text" name="register_username" id="register-username" value="{{ Request::old('register_username') }}">--}}
                        {{--</div>--}}
                        {{--<div class="form-group {{ $errors->has('register_email') ? 'has-error' : '' }}">--}}
                            {{--<label for="register-email">Email</label>--}}
                            {{--<input class="form-control" type="text" name="register_email" id="register-email" value="{{ Request::old('register_email') }}" autocomplete="off">--}}
                        {{--</div>--}}
                        {{--<div class="form-group {{ $errors->has('register_password') ? 'has-error' : '' }}">--}}
                            {{--<label for="register-password">Password</label>--}}
                            {{--<input class="form-control" type="password" name="register_password" id="register-password" value="{{ Request::old('register_password') }}">--}}
                        {{--</div>--}}
                        {{--<button class="btn btn-primary" type="submit">Sign up</button>--}}
                        {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                    {{--</form>--}}
                {{--</div>--}}
                <div class="col-sm-6 col-sm-offset-3">
                    <h3>Login</h3>
                    <form action="{{ route('signin') }}" method="post" autocomplete="off">
                        <div class="form-group {{ $errors->has('login_username') ? 'has-error' : '' }}">
                            <label for="login-username">Username</label>
                            <input class="form-control" type="text" name="login_username" id="login-username" value="{{ Request::old('login_username') }}">
                        </div>
                        <div class="form-group {{ $errors->has('login_password') ? 'has-error' : '' }}">
                            <label for="login-password">Password</label>
                            <input class="form-control" type="password" name="login_password" id="login-password" value="{{ Request::old('login_password') }}">
                        </div>
                        <button class="btn btn-primary" type="submit">Login</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection