@extends('layouts.app')

@section('content')
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h2 class="login-logo-name">META</h2>
            </div>
            <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                
            </form>
            <p class="m-t"> <small><strong>Copyright</strong> © 1994-2016 <a href="http://www.metamorphosis.tv">Metamorphosis</a> <br />(A Division of Davvydave Ltd.)</small> </p>    
        </div>
    </div>
@endsection
