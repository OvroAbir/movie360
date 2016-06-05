@extends('layouts.mylayout')

@section('leftpanContent')
	<h2>Top Movies</h2>
	<p>
		<font size = "3">
			<ul>
				@for($i=0;$i<$movie_count;$i++)
					<li> <a href="/movies/{{$movie_id_ara[$i]}}">{{$movie_name_ara[$i]}}</a> </li>
					<br/>
				@endfor
			</ul>
		</font>
	</p>
@endsection