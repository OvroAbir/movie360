@extends('layouts.mylayout')

@section('leftpanContent')
    <table  cellspacing="10px" width ="90%">
      <tr>
        <td rowspan="7" >
          <img src= "/images/{{$movie_id}}.jpg" alt="Not Found" >
        </td>
        <td  rowspan="2" valign = "top" font><center><h2><font color = gold face="Geneva, Marko One">{{$name}}<font></h2></center></td>
      </tr>
      <tr>
      </tr>
      <tr>
        <td  valign = "baseline"><h2>{{$reldate}}</h2></td>
      </tr>
      <tr>
        <td ><h2><font size="3">
        {{$genre_name_ara}}
        </font></h2></td>
      </tr>
      <tr>
        <td ><h2>{{$runtime}} min<h2></td>
      </tr>
      <tr>
        <td><a href="{{$imdb_link}}" target="_blank"><img src="/images/imdb_logo.png" width="55" height="25"></a></td>
      </tr>
      <tr>
        <td valign ="top"><h2><span>Rating</span>&nbsp;&nbsp; : &nbsp;&nbsp;{{$rating}}</h2></td>
      </tr>
    </table>

    <p>
      <h2>Synopsis</h2>
      <p>
        <font size="2">{{$plot}} </font>
      </p>
      <h3></h3>
    </p>

    <p>
      <left><iframe width="420" height="236" src={{$trailer_link}}></iframe></left> 
    </p>

    <p>
      
    </p>
    
    <table  width = "100%" cellspacing = "10px" >
      <tr>
        <td><font size = "2">
          <table width = "100%" cellspace = "10px" >
            <tr><td>Language </td> <td>: &nbsp; {{$language_name}}</td></tr>
            <tr><td>Budget </td> <td>: &nbsp;{{$budget}} Million $ </td></tr>
            <tr><td>Country </td> <td>: &nbsp;{{$country_name}}</td></tr>
            <tr><td>Production House </td> <td>: &nbsp; {{$production_house_name}}</td></tr>
          </table></font>
        </td>
        <td valign = "top" >
          <table  width = "100%" cellspacing = "5px">
            <tr>
              <th align = "left" ><h2>Cast</h2></th>
            </tr>
            @for($i=0;$i<$actor_in_movie_count;$i++)
              <tr> 
                <td>
                  <h3><a href="/actors/{{$actor_id_ara[$i]}}">{{$actor_name_ara[$i]}}</a></h3>  
                  <span>as</span> {{$character_name_ara[$i]}}
                </td> 
              </tr>
            @endfor
          </table>
        </td>
      </tr>
      <tr>
        <td>
          
        </td>
        <td valign="top">
          <table  width = "100%" cellspacing = "5px">
            <tr>
              <th align = "left"><h2>Director</h2></th>
            </tr>
            <tr>
              <td><h3>{{$director_name}}</h3></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    
    <p>
      <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;border:none;}
        .tg td{font-family:Arial, sans-serif;font-size:13px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
        .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
        .tg .tg-m6px{font-weight:bold;font-size:16px;font-style:italic;color:#ffffc7}
        .tg .tg-yw4l{vertical-align:top}
        .tg .tg-l60n{font-family:"Comic Sans MS", cursive, sans-serif !important;;vertical-align:top}
      </style>

      @if(count($comment_ara)!=0)
        <p><h2>Comments</h2></p>
      @endif

      @for($i=0;$i<$comment_count;$i++)
        <table class="tg" cellspacing="5px" border="1px" width="80%">
          <tr>
            <td class="tg-yw4l" rowspan="2" width="60px"><img src="/images/user_icon.png" width="60" height="60"></th>
            <td class="tg-m6px">{{$user_name_commentd_ara[$i]}}</th>
          </tr>
          <tr>
            <td class="tg-l60n">{{$comment_ara[$i]}}<br></td>
          </tr>
        </table>
      @endfor
    </p>


    @if(Auth::user())
      <form method="POST" action="{{url('/').'/movies/'.$movie_id.'/add_coment'}}">
        {!! csrf_field() !!}
        <input type="hidden" name="country" value="{{$movie_id}}">
        <table cellspacing="5px" >
          <tr>
            <td rowspan="2"><textarea name="comment" id="comment" cols="40"></textarea></td>
            <td>
              <select name="rateMovieDropDown">
                <option value="1">1 bad</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10 good</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="left"><input type='submit' value='Submit!!'/> </td>
          </tr>
        </table>
      </form>
    @endif
@endsection

@section('bottomLeftPan')
  You might Like
@endsection

@section('bottomMiddlePan')
  <table cellspacing="5px">
    <tr>
      @foreach($suggestion_movie_id_ara as $sug_movie_id)
        <td>
          <a href="/movies/{{$sug_movie_id}}"><img src="/images/{{$sug_movie_id}}.jpg" height="111px" width="75px"></a>
        </td>
      @endforeach
    </tr>
  </table>
@endsection
