		<html>	
    		<head><style type="text/css">
			.tg  {border-collapse:collapse;border-spacing:0;border-color:#999;border:none;margin:0px auto;}
			.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
			.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;}
			.tg .tg-yw4l{vertical-align:top}
			.tg .tg-6k2t{background-color:#D2E4FC;vertical-align:top}
			</style></head>
			<body>
				<center>
					<h1>Movie360</h1>
				</center>
				<h2>Report on this website</h2>
				<p>
					<table class="tg" width="80%">
					  <tr>
					    <th class="tg-yw4l"></th>
					    <th class="tg-yw4l"></th>
					  </tr>
					  <tr>
					    <td class="tg-6k2t">Total number of movies</td>
					    <td class="tg-6k2t">{{$data['num_of_movies']}}</td>
					  </tr>
					  <tr>
					    <td class="tg-yw4l">Highest Rated Movie</td>
					    <td class="tg-yw4l">{{$data['highest_rated_movie']}}</td>
					  </tr>
					  <tr>
					    <td class="tg-6k2t">Highest Searched Movie</td>
					    <td class="tg-6k2t">{{$data['highest_searched_movie']}}</td>
					  </tr>
					  <tr>
					    <td class="tg-yw4l">Most Commented Movie</td>
					    <td class="tg-yw4l">{{$data['movie_name_comment_max']}}</td>
					  </tr>
					  <tr>
					    <td class="tg-6k2t">Number of users</td>
					    <td class="tg-6k2t">{{$data['$num_of_users']}}</td>
					  </tr>
					</table>
				</p>
			</body>
		</html>