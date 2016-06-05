@extends('layouts.mylayout')

  @section('leftpanContent')
    <h2>Movies<span>365</span></h2>
    <p>
      This is a website for Movies. General Informations like Casting,  Rating, Runtime, Budget, Language, Country, Release Date,
      Directors and Production House can be found here. One can also search for informations of actors/actresses. Only Admin Panel can make new entry in the database. Users can Only rate and comment on the movies. 
    </p>
    <div id="leftblockonePan">
      <h3><a href="/movies">Top <span>Movies</span></a></h3>
      <h4><span>1.</span><a href="{{$data['movie_id_ara'][0]}}">{{$data['movie_name_ara'][0]}} </a></h4>
      <p>
      </br>
        &nbsp;&nbsp;&nbsp;<img src="/images/{{$data['movie_id_ara'][0]}}.jpg" alt="Can not find" style="width:120px;height:120px;"> 
      </p>
      <p> 
        <table>
          <tr><td>&nbsp;&nbsp; <span>Language &nbsp; </td><td> &nbsp; </span> {{$data['language_name_ara'][0]}} </td> </tr>
          <tr><td>&nbsp;&nbsp; <span>Rating &nbsp; </td><td> &nbsp; </span> {{$data['movie_rating_ara'][0]}} </td></tr>
          <tr><td>&nbsp;&nbsp; <span>Release Date &nbsp; </td> <td>&nbsp; </span> {{$data['movie_date_ara'][0]}} </td></tr>
        </table>
      </p>

      <p class="border"><img src="/images/blank.gif" alt="" /></p>
      <h4><span>1.</span><a href="{{$data['movie_id_ara'][1]}}">{{$data['movie_name_ara'][1]}} </a></h4>
      <p>
      </br>
        &nbsp;&nbsp;&nbsp;<img src="/images/{{$data['movie_id_ara'][1]}}.jpg" alt="Can not find" style="width:120px;height:120px;"> 
      </p>
      <p> 
        <table>
          <tr><td>&nbsp;&nbsp; <span>Language &nbsp; </td><td> &nbsp; </span> {{$data['language_name_ara'][1]}} </td> </tr>
          <tr><td>&nbsp;&nbsp; <span>Rating &nbsp; </td><td> &nbsp; </span> {{$data['movie_rating_ara'][1]}} </td></tr>
          <tr><td>&nbsp;&nbsp; <span>Release Date &nbsp; </td> <td>&nbsp; </span> {{$data['movie_date_ara'][1]}}</td></tr>
        </table>
      </p>

    </div>
    <div id="leftblocktwoPan">
      <h3><a href="/actors">Top <span>Actors</span></a></h3>
      <ul>
        <li><a href="/actors/{{$data['actor_id_ara'][0]}}">{{$data['actor_name_ara'][0]}}</a></li></br>
        <li><a href="/actors/{{$data['actor_id_ara'][1]}}">{{$data['actor_name_ara'][1]}}</a></li></br>
        <li><a href="/actors/{{$data['actor_id_ara'][2]}}">{{$data['actor_name_ara'][2]}}</a></li></br>
      </ul>
      
      <h3><a href="/directors">Top <span>Directors</span></a></h3>
      </br>
      <ul>
        <li>{{$data['director_name_ara'][0]}}</li></br>
        <li>{{$data['director_name_ara'][1]}}</li></br>
      </ul>

    </div>
  @endsection