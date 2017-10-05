<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
        @if (Auth::guest())
        <div class="panel panel-default">
            <div class="panel-body ">
                <h2 class="title"><span class="fa fa-user"></span> MEMBER LOGIN</h2>
                
                <p>User registration is required in order to access this page. Please register so that we can contact you with advisories and information about critical software updates.</p>
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">E-Mail Address</label>

                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>                            
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                <span class="fa fa-question-circle"></span>
                                Forgot Your Password?
                            </a>
                        </div>
                        <div class="row">
                            <a class="btn btn-link" href="{{ route('register') }}">
                                <span class="fa  fa-question-circle"></span>
                                Create an account
                            </a>
                        </div>                        
                    </div>
                </form>                
            </div>
        </div> <!-- /.panel panel-default -->
        @else
        <div class="panel panel-default">
            <div class="panel-body ">
                <h2 class="title"><span class="fa fa-user"></span> MEMBER LOGIN</h2>
                <p>Hi {{ Auth::user()->name }}.</p>
                <a class="btn btn-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div> <!-- /.panel-body -->
        </div> <!-- /.panel .panel-defaut -->
        @endif
        @yield('content')
    </div><!-- /.col-md-6 -->
    <div class="col-md-3">
    </div>
</div>