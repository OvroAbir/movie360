<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Auth;

class MoviePageController extends Controller
{
    public function getMovie($movie_id)
    {
        $user_id = null;
        if(!Auth::guest())
            $user_id = Auth::user()->id;
        DB::table('search_table')->insert(
            ['USER_ID'=> $user_id, 'MOVIE_ID'=> $movie_id]);
        

     	$movie = DB::table('movie')->where('MOVIE_ID', $movie_id)->first();
     	$mName = $movie->MOVIE_NAME;

     	$rating_from_admin = $movie->RATING;
        $rating_from_user_ara = DB::table('user_movie_rating')->where('MOVIE_ID', $movie_id)->pluck('RATING');
        if(count($rating_from_user_ara) != 0)
        {
            $avg_rating_user = array_sum($rating_from_user_ara)/count($rating_from_user_ara);
            $rating = $rating_from_admin *.8 + $avg_rating_user*.2;
        }
        else
            $rating = $rating_from_admin;

        $budget = $movie->BUDGET;
        $runtime = $movie->RUNTIME;

        $dir_id = $movie->DIRECTOR_ID;
        $director = DB::table('director')->where('DIRECTOR_ID', $dir_id)->first();
        $director_name = $director->DIRECTOR_NAME;

        $lang = DB::table('movie_language')->where('MOVIE_ID', $movie_id)->first();
        $language_id = $lang->LANGUAGE_ID;
        $language = DB::table('language')->where('LANGUAGE_ID', $language_id)->first();
        $language_name = $language->LANGUAGE_NAME;

        $country_id = $movie->COUNTRY_ID;
        $country = DB::table('country')->where('COUNTRY_ID', $country_id)->first();
        $country_name = $country->COUNTRY_NAME;

        $prod_house_id = $movie->PROD_HOUSE_ID;
        $production_house = DB::table('production_house')->where('PROD_HOUSE_ID', $prod_house_id)->first();
        $production_house_name = $production_house->PROD_HOUSE_NAME;


        $genre_id_ara = DB::table('movie_genre')->where('MOVIE_ID', $movie_id)->pluck('GENRE_ID');
        $genre_name_ara='';

        foreach ($genre_id_ara as $genre_id) {
            $genre_name = DB::table('genre')->where('GENRE_ID', $genre_id)->first()->GENRE_NAME;
            $genre_name_ara = $genre_name_ara ."/" .$genre_name;
        }
        $genre_name_ara = substr($genre_name_ara, 1);

        
        $actor_id_ara = DB::table('actor_list')->where('MOVIE_ID', $movie_id)->pluck('ACTOR_ID');
        $actor_in_movie_count = 0;
        $actor_name_ara = array();
        foreach ($actor_id_ara as $actor_id) {
            $actor_name_ara[$actor_in_movie_count] = DB::table('actor')->where('ACTOR_ID', $actor_id)->first()->NAME;
            $actor_in_movie_count++;
        }
        $character_name_ara = DB::table('actor_list')->where('MOVIE_ID', $movie_id)->pluck('CHARACTER_NAME');

        $comment_ara = DB::table('user_movie_comment')->where('MOVIE_ID', $movie_id)->pluck('COMMENT');
        $user_id_commentd_ara = DB::table('user_movie_comment')->where('MOVIE_ID', $movie_id)->pluck('USER_ID');


        $user_name_commentd_ara = array();
        $comment_count = 0;
        foreach ($user_id_commentd_ara as $user_id) {
            $user_name_commentd_ara[$comment_count] = DB::table('users')->where('id', $user_id)->first()->name;
            $comment_count++;
        }

        $genre_matching_movie_id_ara = DB::table('movie_genre')->where('MOVIE_ID', '<>', $movie_id)->wherein('GENRE_ID', $genre_id_ara)->pluck('MOVIE_ID');
        //return $genre_matching_movie_id_ara;
        foreach ($genre_matching_movie_id_ara as $gm) {
        	$genre_counter_ara[$gm] = 0;
        }
        
        foreach ($genre_matching_movie_id_ara as $gm) {
        	$genre_counter_ara[$gm]++;
        }
        
        arsort($genre_counter_ara);

        $suggestion_counter = 0;
        $number_of_suggestion = 4;
        foreach ($genre_counter_ara as $mId => $mIdCounter) {
        	$suggestion_movie_id_ara[$suggestion_counter++] = $mId;
        	if($suggestion_counter >= $number_of_suggestion)
        		break;
        }
        
        $reldate = $movie->RELEASE_DATE;

        $trailer_link = "https://www.youtube.com/embed/". $movie->TRAILER;

        $plot = $movie->PLOT;

        $imdb_link = $movie->IMDB_LINK;

		return view('moviepage')->with('name', $mName)->with('rating', $rating)->with('budget', $budget)->with('runtime', $runtime)->with('director_name', $director_name)->with('language_name', $language_name)->with('movie_id', $movie_id)->with('country_name', $country_name)->with('production_house_name', $production_house_name)->with('genre_name_ara', $genre_name_ara)->with('actor_name_ara', $actor_name_ara)->with('character_name_ara', $character_name_ara)->with('comment_ara', $comment_ara)->with('comment_count', $comment_count)->with('user_name_commentd_ara', $user_name_commentd_ara)->with('actor_in_movie_count', $actor_in_movie_count)->with('actor_id_ara', $actor_id_ara)->with('suggestion_movie_id_ara', $suggestion_movie_id_ara)->with('number_of_suggestion', $number_of_suggestion)->with('reldate', $reldate)->with('trailer_link', $trailer_link)->with('plot', $plot)->with('imdb_link', $imdb_link);
    }

    public function addComment(Request $request, $movie_id)
    {
        if(Auth::guest())
            return back();

        $user_id = Auth::user()->id;

        if($request->has('comment'))
        {
            $comment = $request->comment;
            DB::table('user_movie_comment')->insert(
                [
                'USER_ID'=>$user_id,
                'MOVIE_ID'=>$movie_id,
                'COMMENT'=>$comment
                ]);
        }
        if($request->has('rateMovieDropDown'))
        {
            $rating = $request->rateMovieDropDown;

            if(DB::table('user_movie_rating')->where('USER_ID', $user_id)->where('MOVIE_ID', $movie_id)->count() == 0)
            {
                DB::table('user_movie_rating')->insert(
                    [
                    'USER_ID'=>$user_id,
                    'MOVIE_ID'=>$movie_id,
                    'RATING'=>$rating
                    ]);
            }
            else
            {
                DB::table('user_movie_rating')->where('USER_ID', $user_id)->where('MOVIE_ID', $movie_id)->update(
                    ['RATING'=>$rating]);
            }
        }

        return back();
    }

    public function getAllMovies()
    {
        $movie_id_ara = DB::table('movie')->orderBy('RATING', 'DESC')->pluck('MOVIE_ID');

        $movie_count = 0;
        $movie_name_ara = array();
        foreach ($movie_id_ara as $movie_id) {
            $movie_name_ara[$movie_count] = DB::table('movie')->where('MOVIE_ID', $movie_id)->first()->MOVIE_NAME;
            $movie_count++;
        }
        
        return view('topmoviespage')->with('movie_id_ara', $movie_id_ara)->with('movie_name_ara', $movie_name_ara)->with('movie_count', $movie_count);
    }
}
