@extends('layouts.mylayout')

@section('leftpanContent')
		<form action="/edit/addactorinmovie" method="post" >
			{!! csrf_field() !!}
			<p>
				<table width="100%" cellspacing="20px">
					<tr>
						<td><font size="3">Select the movie</font></td>
						<td>
							<select name="movieNameDropDown">
								@for($i=0;$i<count($data['movie_id_ara']);$i++)
									<option value="{{$data['movie_id_ara'][$i]}}">{{$data['movie_name_ara'][$i]}}</option>
								@endfor
							</select>
						</td>
					</tr>
				</table>
			</p>

			<p>
				<table width="100%" cellspacing="10px">
					<th valign="left">Select Actor</th> <th>Character Name in the Movie</th>
						@for($i=0;$i<count($data['actor_id_ara']);$i++)
							<tr>
								<td valign="left">
									<font size="2">
										<input type="checkbox" name="actor_check_list[]" value="{{$data['actor_id_ara'][$i]}}">&nbsp;&nbsp;{{$data['actor_name_ara'][$i]}}
									</font>
								</td>
								<td valign="right">
									<input type="text" name="character_input[{{$data['actor_id_ara'][$i]}}]" size="30">
								</td>
							</tr>
						@endfor
					</tr>
				</table>
			</p>
			<center>
				<input type="submit" name="button" value="Insert">
			</center>
			
		</form>
@endsection