<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Library\myclass;

use App\Library\mpdf60;

use mPDF;

use DB;

class ReportController extends Controller
{
    public function getMpdf()
    {
    	$num_of_movies = DB::table('movie')->count();
    	$highest_rated_movie = DB::table('movie')->orderBy('RATING', 'desc')->first()->MOVIE_NAME;


    	$movie_id_ara = DB::table('movie')->lists('MOVIE_ID');
    	$movie_count_max = -1;
    	$movie_id_max = $movie_id_ara[0];
    	
    	foreach ($movie_id_ara as $movie_id) {
    		$count = DB::table('search_table')->where('MOVIE_ID', $movie_id)->count();
    		if($count>$movie_count_max)
    		{
    			$movie_count_max = $count;
    			$movie_id_max = $movie_id;
    		}
    	}
    	$movie_name_max = DB::table('movie')->where('MOVIE_ID', $movie_id_max)->first()->MOVIE_NAME;
    	$highest_searched_movie = $movie_name_max;

    	$movie_comment_count_max = -1;
    	$movie_id_comment_max = $movie_id_ara[0];
    	
    	foreach ($movie_id_ara as $movie_id) {
    		$count = DB::table('user_movie_comment')->where('MOVIE_ID', $movie_id)->count();
    		if($count>$movie_comment_count_max)
    		{
    			$movie_comment_count_max = $count;
    			$movie_id_comment_max = $movie_id;
    		}
    	}

    	$movie_name_comment_max = DB::table('movie')->where('MOVIE_ID', $movie_id_comment_max)->first()->MOVIE_NAME;

    	$num_of_users = DB::table('users')->count();



    	ob_start();
    	$html = ob_get_clean();
    	$html = utf8_encode($html);

    	$html .= 
    	'<html>	
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
					    <td class="tg-6k2t">'.$num_of_movies.'</td>
					  </tr>
					  <tr>
					    <td class="tg-yw4l">Highest Rated Movie</td>
					    <td class="tg-yw4l">'.$highest_rated_movie.'</td>
					  </tr>
					  <tr>
					    <td class="tg-6k2t">Highest Searched Movie</td>
					    <td class="tg-6k2t">'.$highest_searched_movie.'</td>
					  </tr>
					  <tr>
					    <td class="tg-yw4l">Most Commented Movie</td>
					    <td class="tg-yw4l">'.$movie_name_comment_max.'</td>
					  </tr>
					  <tr>
					    <td class="tg-6k2t">Number of users</td>
					    <td class="tg-6k2t">'.$num_of_users.'</td>
					  </tr>
					</table>
				</p>
			</body>
		</html>';


	$mpdf = new mPDF();
	$mpdf->showImageErrors = true;
	$mpdf->allow_charset_conversion = true;
	$mpdf->charset_in = 'UTF-8';
	$mpdf->WriteHTML($html);
	$mpdf->Output('movie360', 'I');
	exit();

    }
}
