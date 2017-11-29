<html>
    @extends('layouts.app-login')
    @section('content')
    <head>
        <style>
        <link rel="icon" href="public/images/Prince and Princess logo/1.png">
        </style>
    </head>
    <div class="container">
        <div class="flexBox vertical-center" style="display: flex; flex-flow: row wrap; justify-content: center;">
            <div class="panel panel-default">
                <div class="panel-body text-center">
                    
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        
                        <img src="/images/PP.png" class="pp-logo"> <!-- P&P LOGO -->

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> 
                            <!-- USER ICON-->
                            <img src= "/images/user.png" class="email-tb"> 

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Username">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <!-- PASSWORD ICON-->
                            <img src= "/images/lock.png" class="lock-tb">

                            <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-lg-9 col-lg-offset-1">
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary btn-block"> 
                                    Login 
                                </button>
                            </div>
                        </div>

                        <!--
                        <div class=" checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div> 
                        -->

                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
</html>