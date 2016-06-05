@extends('layouts.mylayout')

@section('leftpanContent')
	<h2>Select Movie you want to update?</h2>
	<p>
		<font size = "3">
			<ul>
				@for($i=0;$i<count($movie_id_ara);$i++)
					<li> <a href="/edit/update/movie/{{$movie_id_ara[$i]}}">{{$movie_name_ara[$i]}}</a> </li>
					<br/>
				@endfor
			</ul>
		</font>
	</p>
@endsection