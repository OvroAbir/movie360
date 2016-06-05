@extends('layouts.mylayout')

@section('leftpanContent')
	<form action="/edit/add/dirprod" method="post">
		{!! csrf_field() !!}
		<input type="hidden" name="type" value="{{$person_type}}">
		<table width="80%">
			<tr>
            	<td>Name &nbsp;</td>
            	<td><input type="text" name="name" size="20" maxlength="30" value="" /> </td>
        	</tr>
      	</table>
        <p> 
          <center><input type="submit" name="aaddButton" value="Add" /> </center>
        </p>
	</form>
@endsection