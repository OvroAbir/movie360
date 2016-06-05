@extends('layouts.mylayout')

@section('leftpanContent')
	<p><center><h2>{{$data['movie_name']}}</h2></center></p>

	<p>
	<center>
	<form action="/edit/update/movie" method="post" >
	{!! csrf_field() !!}
		<input type="hidden" name="movie_id" value="{{$data['movie_id']}}">
	    <table cellspacing="10px">
	        <tr>
	            <td>Runtime(In Minute)</td>
	            <td><input type="text" name="runTimeTextField" size="5" maxlength="5" value="{{$data['runtime']}}" /> </td>
	        </tr>
	        <tr>
	            <td>Language</td>
	            <td>
	            	<select name = "languageIdDropDOwn">
	            		@for($i=0;$i<count($data['language_name_ara']);$i++)
	            			@if($data['language_id_ara'][$i] == $data['language_id'])
	            				<option value="{{$data['language_id_ara'][$i]}}" selected="selected">{{$data['language_name_ara'][$i]}}
	            				</option>	
	            			@else
								<option value="{{$data['language_id_ara'][$i]}}">{{$data['language_name_ara'][$i]}}</option>
							@endif
						@endfor
	            	</select>
	            </td>
	        </tr>
	        <tr>
	            <td>Release Date</td>
	            <td>
	                <select name="relDateDayDropDown">
	                	@for($i=1;$i<32;$i++)
	                		@if($i == $data['date'])
	                			<option value="{{$i}}" selected="selected">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
	                		@else
	                    		<option value="{{$i}}">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
	                    	@endif
	                    @endfor
	                </select>
	                -
	                <select name="relDateMonthDropdown">
	                	@for($i=1;$i<13;$i++)
	                		@if($i == $data['month'])
	                			<option value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}" selected="selected">{{$data['month_name'][$i]}}</option>
	                		@else
	                			<option value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}">{{$data['month_name'][$i]}}</option>
	                		@endif
	                	@endfor
	                </select>
	                -
	                <select name="relDateYearTextField">
	                    @for($i=1930;$i<2017;$i++)
	                    	@if($i == $data['year'])
	                       		<option value="{{$i}}" selected="selected">{{$i}}</option>
	                       	@else
	                       		<option value="{{$i}}">{{$i}}</option>
	                       	@endif
	                    @endfor
	                </select>
	        </tr>
	        <tr>
	            <td>Budget(In Million Dollar) &nbsp;</td>
	            <td><input type="text" name="budgetTextField" size="10" maxlength="10" value="{{$data['budget']}}" /> </td>
	        </tr>
	        <tr>
	            <td>Country</td>
	            <td>
	            	<select name = "countryIdDropDOwn">
	            		@for($i=0;$i<count($data['country_id_ara']);$i++)
	            			@if($data['country_id_ara'][$i] == $data['country_id'])
	            				<option value="{{$data['country_id_ara'][$i]}}" selected="selected">{{$data['country_name_ara'][$i]}}
	            				</option>
	            			@else
								<option value="{{$data['country_id_ara'][$i]}}">{{$data['country_name_ara'][$i]}}</option>
							@endif
						@endfor
	            	</select>
	            </td>
	        </tr>
	        <tr>
	            <td>Rating</td>
	            <td><input type="text" name="ratingTextField" size="5" maxlength="5" value="{{$data['rating']}}" /> </td>
	        </tr>
	        <tr>
	            <td>Production House</td>
	            <td>
	            	<select name = "prodIdDropDOwn">
	            		@for($i=0;$i<count($data['production_house_name_ara']);$i++)
	            			@if($data['production_house_id_ara'][$i] == $data['prod_id'])
	            				<option value="{{$data['production_house_id_ara'][$i]}}" selected="selected">{{$data['production_house_name_ara'][$i]}}
	            				</option>
	            			@else
								<option value="{{$data['production_house_id_ara'][$i]}}">{{$data['production_house_name_ara'][$i]}}</option>
							@endif
						@endfor
	            	</select>
	            </td>
	        </tr>
	        <tr>
	            <td>Director Name</td>
	            <td>
	            	<select name = "dirIdDropDOwn">
	            		@for($i=0;$i<count($data['director_name_ara']);$i++)
	            			@if($data['director_id_ara'][$i] == $data['director_id'])
	            				<option value="{{$data['director_id_ara'][$i]}}" selected="selected">{{$data['director_name_ara'][$i]}}
	            				</option>
	            			@else
								<option value="{{$data['director_id_ara'][$i]}}">{{$data['director_name_ara'][$i]}}</option>
							@endif
						@endfor
	            	</select>
	            </td>
	        </tr>
	        <tr>
	            <td valign="middle">Movie Genre </td>
	            <td>
	                <table>
	                	@for($count = 0;$count<count($data['genre_name_ara']);)
	                		<tr>
		                		@for($col = 0;$col<4 && $count<count($data['genre_name_ara']);$col++)
		                			<td>
		                				@if(array_search($data['genre_id_ara'][$count], $data['checked_genres']) != FALSE)
			                			<input type="checkbox" name="check_list[]" value="{{$data['genre_id_ara'][$count]}}" checked="">&nbsp;{{$data['genre_name_ara'][$count++]}}&nbsp;
			                			@else
			                				<input type="checkbox" name="check_list[]" value="{{$data['genre_id_ara'][$count]}}">&nbsp;{{$data['genre_name_ara'][$count++]}}&nbsp;
			                			@endif
		                			</td>
		                		@endfor
	                		</tr>
	                	@endfor	                   
	                </table>
	            </td>
	        </tr>
	        <tr>
	        	<td valign="middle">Youtube Trailer Link </td>
	        	<td>
	        		<input type="text" name="trailer" value="{{$data['trailer']}}"></textarea>
	        	</td>
	        </tr>
	        <tr>
	        	<td valign="middle">Plot </td>
	        	<td>
	        		<textarea name="plot" id="plot" cols="35">{{$data['plot']}}</textarea>
	        	</td>
	        </tr>
	        
	        <tr>
	        	<td>Poster</td>
	        	<td valign="middle">
	        		<input type="file" name="fileToUpload" id="fileToUpload">
	        	</td>
	        </tr>
	    </table>
	    <p> 
	        <input type="submit" name="NextButton" value="Update!!" /> 
	    </p>
	</form>
	
@endsection