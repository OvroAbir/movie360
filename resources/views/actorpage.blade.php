@extends('layouts.mylayout')

@section('leftpanContent')
	<p>
      <center><h2><font face="Geneva, Marko One">{{$actor_name}}<font></h2></center>
    </p>
    <table width="100%" cellspacing="20px">
      <tr>
        <td>
          <center><img src= "/images/actor/{{$actor_id}}.jpg" alt="Not Found"></center>
        </td>
        <td>
          <font size = "2" color="gold">
            <table width = "100%" cellspace = "20px" >
              <tr><td>Gender </td> <td>: &nbsp; {{$actor_gender}}</td></tr>
              <tr><td>&nbsp;</td></tr>
              <tr><td>Date Of Birth </td> <td>: &nbsp; {{$actor_dob}} </td></tr>
              <tr><td>&nbsp;</td></tr>
              <tr><td>Height </td> <td>: &nbsp; {{$actor_height}} &nbsp; cm</td></tr>
              <tr><td>&nbsp;</td></tr>
              <tr><td>Country </td> <td>: &nbsp;{{$actor_country_name}}</td></tr>
            </table>
          </font>
        </td>
      </tr>
    </table>
    <p>
      <h3>List of Movies &nbsp; : </h3>
    </p>

    <ul>
    	@for($i=0;$i<$movie_count;$i++)
    		<li> <a href="/movies/{{$movie_id_ara[$i]}}">{{$movie_name_ara[$i]}}</a> </li>
    	@endfor
    </ul>

  </div>
@endsection