@extends('layouts.mylayout')

@section('leftpanContent')
	<p>
		<font size = "3">
			<ul>
				@for($i=0;$i<count($data['movie_id_ara']);$i++)
					<li> <a href="/movies/{{$data['movie_id_ara'][$i]}}">{{$data['movie_name_ara'][$i]}}</a> </li>
					<br/>
				@endfor
			</ul>
		</font>
	</p>
@endsection