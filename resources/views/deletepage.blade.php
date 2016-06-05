@extends('layouts.mylayout')

@section('leftpanContent')
	<h3>Select the items you want to delete.</h3>

	<form action="/edit/delete/{{$type}}" method="post">
	{!! csrf_field() !!}
		<input type="hidden" name="type" value="{{$type}}">
		<table width="90%" cellspacing="5px">
			@for($i=0;$i<count($name_ara);$i++)
				<tr>
					<td>
						<input type="checkbox" name="id_list[]" value="{{$id_ara[$i]}}">
					</td>
					<td><font size="2">{{$name_ara[$i]}}</font></td>
				</tr>
			@endfor
		</table>
		<p>
			<center><input type="submit" name="button" value="Delete!!"></center>
		</p>
	</form>
@endsection