@extends('layouts.mylayout')

@section('headContent')
<script>
  function showResult(e, str, type) {
    if(e.keyCode >= 37 && e.keyCode <= 40)
      return;

    if (str.length==0) {
      document.getElementById("livesearch_"+type).innerHTML="";
      return;
    }
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("livesearch_"+type).innerHTML=xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","/searchsug/"+type+"_"+str,true);
    xmlhttp.send();
}
</script>
@endsection

@section('leftpanContent')
    <h3>Please fill in at least one field from below </h3>
    <center>
    <form action="{{url('/').'/searchMovie'}}" method="POST">
    {!! csrf_field() !!}
      <p>
      <table cellspacing = "15px" width = "100%">
        <tr>
            <td>Movie Name &nbsp;</td>
            <td>
              <input type="text" name="movieName" autocomplete="off" list="livesearch_movie" size="40" maxlength="40" onkeyup="showResult(event, this.value, 'movie')"/>
              
              <datalist id="livesearch_movie"></datalist>
            </td>
        </tr>
        <tr>
            <td>Director Name &nbsp;</td>
            <td>
              <input type="text" name="directorName" autocomplete="off" list="livesearch_director" size="40" maxlength="40" onkeyup="showResult(this.value, 'director')"/>
              <datalist id="livesearch_director"></datalist>
            </td>
        </tr>
        <tr>
            <td>Production House  &nbsp;</td>
            <td>
              <input type="text" name="productionHouse" autocomplete="off" list="livesearch_production" size="40" maxlength="40" onkeyup="showResult(this.value, 'production')"/>
              <datalist id="livesearch_production"></datalist>
            </td>
        </tr>
        <tr>
            <td>Actor Name &nbsp;</td>
            <td>
              <input type="text" name="actorName" autocomplete="off" list="livesearch_actor" size="40" maxlength="40" onkeyup="showResult(this.value, 'actor')"/>
              <datalist id="livesearch_actor"></datalist>
            </td>
        </tr>

        <tr>
          <td valign="middle">Movie Genre </td>
          <td>
            <table>
              <tr>
                <td><input type="checkbox" name="genreId[]" value="6" />&nbsp;Action &nbsp;</td>
                <td><input type="checkbox" name="genreId[]" value="2" />&nbsp;Adventure&nbsp;</td>
                <td><input type="checkbox" name="genreId[]" value="9" />&nbsp;Comedy&nbsp;</td>
                <td><input type="checkbox" name="genreId[]" value="1" />&nbsp;Crime&nbsp;</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="genreId[]" value="3" />&nbsp;Drama&nbsp;</td>
                <td><input type="checkbox" name="genreId[]" value="4" />&nbsp;Family&nbsp;</td>
                <td><input type="checkbox" name="genreId[]" value="5" />&nbsp;Fantasy&nbsp;</td>
                <td><input type="checkbox" name="genreId[]" value="7" />&nbsp;Mystery&nbsp;</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="genreId[]" value="10" />&nbsp;Romance&nbsp;</td>
                <td><input type="checkbox" name="genreId[]" value="8" />&nbsp;Sci-Fi</td>
              </tr>
            </table>
          </td>
        </tr>
 
      </table>
    </p>
    </center>
    
    <center><input type="submit" name="goButton" value="Search" /> </center>
    </form>
 @endsection