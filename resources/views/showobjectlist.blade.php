@extends('layouts.mylayout')

@section('leftpanContent')
	<p>
		<font size = "3">
			<ul>
				@for($i=0;$i<count($name);$i++)
					<li>{{$name[$i]}}</li>
					<br/>
				@endfor
			</ul>
		</font>
	</p>
@endsection