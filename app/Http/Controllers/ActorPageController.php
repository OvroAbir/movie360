<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class ActorPageController extends Controller
{
    public function getActor($actor_id)
    {
    	$actor = DB::table('actor')->where('ACTOR_ID', $actor_id)->first();
    	
    	$actor_name = $actor->NAME;
    	
    	$actor_dob = $actor->BIRTH_DATE;

    	$actor_country_id = $actor->COUNTRY_ID;
    	$actor_country_name = DB::table('country')->where('COUNTRY_ID', $actor_country_id)->first()->COUNTRY_NAME;	

    	$actor_height = $actor->HEIGHT;

    	$actor_gender_id = $actor->GENDER_ID;
    	if($actor_gender_id == 1)
    		$actor_gender = 'Male';
    	else
    		$actor_gender = 'Female';


    	$movie_id_ara = DB::table('actor_list')->where('ACTOR_ID', $actor_id)->PLUCK('MOVIE_ID');
    	$movie_name_ara = array();
    	$movie_count = 0;
    	foreach ($movie_id_ara as $movie_id) {
    		$movie_name_ara[$movie_count] = DB::table('movie')->where('MOVIE_ID', $movie_id)->first()->MOVIE_NAME;
    		$movie_count++;
    	}


    	return view('actorpage')->with('actor_id', $actor_id)->with('actor_name', $actor_name)->with('actor_dob', $actor_dob)->with('actor_country_name', $actor_country_name)->with('actor_height', $actor_height)->with('actor_gender', $actor_gender)->with('movie_id_ara', $movie_id_ara)->with('movie_name_ara', $movie_name_ara)->with('movie_count', $movie_count);
    }
    public function getAllActor()
    {
        $data['actor_id_ara'] = DB::table('actor')->orderBy('NAME')->lists('ACTOR_ID');
        $data['actor_name_ara'] = DB::table('actor')->orderBy('NAME')->lists('NAME');

        return view('actorlistpage')->with('data', $data);
    }
}
