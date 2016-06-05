@extends('layouts.mylayout')

@section('leftpanContent')
	<p>
		<font size = "3">
			<ul>
				@for($i=0;$i<count($data['actor_id_ara']);$i++)
					<li> <a href="/actors/{{$data['actor_id_ara'][$i]}}">{{$data['actor_name_ara'][$i]}}</a> </li>
					<br/>
				@endfor
			</ul>
		</font>
	</p>
@endsection