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
    	$data['num_of_movies'] = DB::table('movie')->count();
    	$data['highest_rated_movie'] = DB::table('movie')->orderBy('RATING', 'desc')->first()->MOVIE_NAME;


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
    	$data['highest_searched_movie'] = $movie_name_max;

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

    	$data['movie_name_comment_max'] = DB::table('movie')->where('MOVIE_ID', $movie_id_comment_max)->first()->MOVIE_NAME;

    	$data['num_of_users'] = DB::table('users')->count();

	    $html = view('pdfview')->with('data', $data)->render();


		$mpdf = new mPDF();
		$mpdf->showImageErrors = true;
		$mpdf->allow_charset_conversion = true;
		$mpdf->charset_in = 'UTF-8';
		$mpdf->setFooter('{PAGENO} / {nb}');
		$mpdf->WriteHTML($html);
		$mpdf->Output('movie360', 'I');
		exit();
    }
}
