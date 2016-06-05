

@extends('layouts.mylayout')
@section('leftpanContent')
<h2>Log In <br/></h2>
<br/>
<p>Enter the follwing infos to log in.</p>
<p>
<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
  {!! csrf_field() !!}
  <table width="100%" cellspacing="10px">
    <tr>
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <td><label class="col-md-4 control-label">E-Mail Address</label></td>
        <div class="col-md-6">
          <td><input type="email" class="form-control" name="email" value="{{ old('email') }}"></td>
          @if ($errors->has('email'))
          <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>
      </div>
    </tr>
    <tr>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <td><label class="col-md-4 control-label">Password</label></td>
        <div class="col-md-6">
          <td><input type="password" class="form-control" name="password"></td>
          @if ($errors->has('password'))
          <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>
      </div>
    </tr>
    <tr>
      <td></td>
      <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
          <td>
            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
          </td>
    </tr>
    <tr>
    <td></td>
    <td>
    <button type="submit" class="btn btn-primary">
    <i class="fa fa-btn fa-sign-in"></i>Login
    </button>
    </td>
    </div>
    </div>
    </tr>
  </table>
</form>
</p>
<p>
  <a href="register">Don't have an account yet?</a>
</p>
@endsection

