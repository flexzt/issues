@extends('index')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-body">

                        @if(!isset($success))

                            <div class="col-md-11 col-md-offset-1">
                                <h2 class="page-title">Login</h2>
                            </div>

                            <form class="form-horizontal" method="POST" action="/login/">

                                <div class="form-group{{ isset($errors['login']) ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Login</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="login" name="login" value=""
                                               placeholder="Login" required autofocus>
                                        @if (isset($errors['login']))
                                            <span class="help-block">
                                            <strong>{{ isset($errors['login']) }}</strong>
                                          </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group {{ isset($errors['password'])? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" id="password" name="password"
                                               required>
                                        @if (isset($errors['password']))
                                            <span class="help-block">
                    <strong>{{ isset($errors['password']) }}</strong>
                  </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-success form-btn btn-block">Sign in
                                        </button>
                                    </div>
                                </div>
                            </form>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('right_sidebar')

@endsection
