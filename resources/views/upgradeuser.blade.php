@extends('layouts.mylayout')

@section('leftpanContent')
	<p><h3>Select the user you want to enable upgrade permission</h3></p>
	
	<p>
	<center>
		<form action="/edit/upgradeuser" method="post" >
		{!! csrf_field() !!}
			User Name &nbsp;&nbsp;&nbsp; 
			<select name="userselect">
				@for($i=0;$i<count($data['user_id_ara']);$i++)
					<option value="{{$data['user_id_ara'][$i]}}">{{$data['user_name_ara'][$i]}}</option>
				@endfor
			</select>
			<p><input type="submit" name="button" value="Upgrade!!"></p>
		</form>
	</center>
	</p>
@endsection