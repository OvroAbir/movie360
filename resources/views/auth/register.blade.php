

@extends('layouts.mylayout')
@section('leftpanContent')
<h2>Sign Up</h2>
<p>Enter the informations below to sign up.<br/><br/></p>
<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
  {!! csrf_field() !!}
  <table width="100%" cellspacing="15px">
    <tr>
      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <td><label class="col-md-4 control-label">Name</label></td>
        <td><input type="text" class="form-control" name="name" value="{{ old('name') }}">
          @if ($errors->has('name'))
          <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </td>
      </div>
    </tr>
    <tr>
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <td><label class="col-md-4 control-label">E-Mail Address</label></td>
        <td><input type="email" class="form-control" name="email" value="{{ old('email') }}">
          @if ($errors->has('email'))
          <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </td>
      </div>
    </tr>
    <tr>
      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <td><label class="col-md-4 control-label">Password</label></td>
        <td><input type="password" class="form-control" name="password"></td>
        @if ($errors->has('password'))
        <span class="help-block">
        <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
      </div>
    </tr>
    <tr>
      <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <td><label class="col-md-4 control-label">Confirm Password</label></td>
        <td><input type="password" class="form-control" name="password_confirmation"></td>
        @if ($errors->has('password_confirmation'))
        <span class="help-block">
        <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
        @endif
      </div>
    </tr>
  </table>
  <p>
  <center>
    <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
        <i class="fa fa-btn fa-user"></i>Register
        </button>
      </div>
    </div>
  </center>
  </p>
</form>
@endsection

