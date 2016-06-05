@extends('layouts.mylayout')

@section('leftpanContent')
	<h3>Please Insert necessay informations of the <span>Actor/Actress</span>. </h3>
    <center>
    <form action="/edit/add/actor" method="post">
    {!! csrf_field() !!}
      <p>
      <table cellspacing = "10px">
        <tr>
            <td>Actor Name &nbsp;</td>
            <td><input type="text" name="actorNameTextField" size="35" maxlength="40"/></td>
        </tr>
        <tr>
	        <td>Image &nbsp;</td>
	       	<td valign="middle">
	       		<input type="file" name="fileToUpload" id="fileToUpload">
	       	</td>
	    </tr>
        <tr>
          
            <td>Gender &nbsp; </td>
            <td>
            	<input type="radio" name="radioGender[]"value="male" checked>Male &nbsp;
            	<input type="radio" name="radioGender[]"value="female">Female
            </td>
          
        </tr>
        <tr>
          
            <td>Date of Birth &nbsp;</td>
            <td>
              <select name="dayDropDown">
                @for($i=1;$i<32;$i++)
	                <option value="{{$i}}">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
	            @endfor
              </select>
              -
            <select name="monthDropdown">
              <option value="01">JAN</option>
              <option value="02">FEB</option>
              <option value="03">MAR</option>
              <option value="04">APR</option>
              <option value="05">MAY</option>
              <option value="06">JUN</option>
              <option value="07">JUL</option>
              <option value="08">AUG</option>
              <option value="09">SEP</option>
              <option value="10">OCT</option>
              <option value="11">NOV</option>
              <option value="12">DEC</option>
            </select>
            -
            <select name="birDateYearTextField">
            @for($i=1930;$i<2017;$i++)
	          <option value="{{$i}}">{{$i}}</option> <br />
	        @endfor
          </select>
           
          
        </tr>
        <tr>
          
            <td>Height(In cm) &nbsp;</td>
            <td><input type="text" name="heightTextField" size="5" maxlength="5" value="" /> </td>
          
        </tr>
        <tr>
            <td>Country &nbsp; </td>
            <td>
            	<select name = "countryIdDropDOwn">
	            	@for($i=0;$i<count($data['country_id_ara']);$i++)
						<option value="{{$data['country_id_ara'][$i]}}">{{$data['country_name_ara'][$i]}}</option>
					@endfor
	            </select>
            </td> 
        </tr> 
      </table>
    </p>
    </center>
    
    <center><input type="submit" name="addButton" value="Add Actor" /> </center>
    </form>
@endsection