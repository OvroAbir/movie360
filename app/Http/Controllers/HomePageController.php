<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class HomePageController extends Controller
{
    public function getHomePageInfos()
    {
    	$data['movie_id_ara'] = DB::table('movie')->orderBy('RATING', 'DESC')->take(3)->lists('MOVIE_ID');
    	$data['movie_name_ara'] = DB::table('movie')->orderBy('RATING', 'DESC')->take(3)->lists('MOVIE_NAME');

    	$data['movie_rating_ara'] = DB::table('movie')->orderBy('RATING', 'DESC')->take(3)->lists('RATING');
    	$data['movie_date_ara'] = DB::table('movie')->orderBy('RATING', 'DESC')->take(3)->lists('RELEASE_DATE');


    	$data['actor_id_ara'] = DB::table('actor')->take(3)->lists('ACTOR_ID');
    	$data['actor_name_ara'] = DB::table('actor')->take(3)->lists('NAME');

    	//$data['director_id_ara'] = DB::table('director')->take(3)->lists('DIRECTOR_ID');
    	$data['director_name_ara'] = DB::table('director')->take(3)->lists('DIRECTOR_NAME');

    	for($i=0;$i<3;$i++)
    	{
    		$lang_id = DB::table('movie_language')->where('MOVIE_ID', $data['movie_id_ara'][$i])->first()->LANGUAGE_ID;
    		$data['language_name_ara'][$i] = DB::table('language')->where('LANGUAGE_ID', $lang_id)->first()->LANGUAGE_NAME;
    	}



    	return view('homepage')->with('data', $data);
    }
}
