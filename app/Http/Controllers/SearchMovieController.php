<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class SearchMovieController extends Controller
{
    public function searchMovie(Request $request)
    {
        $query = DB::table('movie');

    	if($request->has('movieName'))
    		$query = $query->where('MOVIE_NAME', 'like' , '%'.$request->movieName.'%');
        if($request->has('directorName'))
        {
            $dir_ara = DB::table('director')->where('DIRECTOR_NAME', 'like', '%'.$request->directorName.'%')->lists('DIRECTOR_ID');
            $query = $query->whereIn('DIRECTOR_ID', $dir_ara);
        }
        if($request->has('productionHouse'))
        {
            $prod_ara = DB::table('production_house')->where('PROD_HOUSE_NAME', 'like', '%'.$request->productionHouse.'%')->lists('PROD_HOUSE_ID');
            $query = $query->whereIn('PROD_HOUSE_ID', $prod_ara);
        }
        if($request->has('actorName'))
        {
            $act_ara = DB::table('actor')->where('NAME', 'like', '%'.$request->actorName.'%')->lists('ACTOR_ID');
            $movie_id_of_act_ara = DB::table('actor_list')->whereIn('ACTOR_ID', $act_ara)->lists('MOVIE_ID');
            $query = $query->whereIn('MOVIE_ID', $movie_id_of_act_ara);
        }
        if($request->has('genreId'))
        {
            $movie_id_of_genre_ara = DB::table('movie_genre')->whereIn('GENRE_ID', $request->genreId)->lists('MOVIE_ID');
            $query = $query->whereIn('MOVIE_ID', $movie_id_of_genre_ara);
        }

        $query = $query->orderBy('MOVIE_NAME');
        
        $data['movie_name_ara'] = $query->lists('MOVIE_NAME');
        $data['movie_id_ara'] = $query->lists('MOVIE_ID'); 

        return view('searchresultpage')->with('data', $data);
    }

    public function liveSearch($str)
    {
        $type = stristr($str, '_', true);
        $keyword = substr(stristr($str, '_'), 1);
        $result = array();

        if($type == 'movie')
        {
            $result = DB::table('movie')->where('MOVIE_NAME', 'like' , '%'.$keyword.'%')->orderBy('MOVIE_NAME')->lists('MOVIE_NAME');
        }
        elseif($type == 'director')
        {
            $result = DB::table('director')->where('DIRECTOR_NAME', 'like', '%'.$keyword.'%')->orderBy('DIRECTOR_NAME')->lists('DIRECTOR_NAME');
        }
        elseif($type == 'production')  
        {
            $result = DB::table('production_house')->where('PROD_HOUSE_NAME', 'like', '%'.$keyword.'%')->orderBy('PROD_HOUSE_NAME')->lists('PROD_HOUSE_NAME');
        }
        elseif($type == 'actor')
        {
            $result = DB::table('actor')->where('NAME', 'like', '%'.$keyword.'%')->orderBy('NAME')->lists('NAME');
        }


        foreach ($result as $res) {
            echo '<option value="'.$res.'">';
        }
    }
    public function searchByGenre($genre_id)
    {
        //$genre_id = DB::table('genre')->where('GENRE_NAME', $genre)->first()->GENRE_ID;

        $data['movie_id_ara'] = DB::table('movie_genre')->where('GENRE_ID', $genre_id)->lists('MOVIE_ID');

        $data['movie_id_ara'] = DB::table('movie')->whereIn('MOVIE_ID', $data['movie_id_ara'])->orderBy('MOVIE_NAME')->lists('MOVIE_ID');
        $data['movie_name_ara'] = DB::table('movie')->whereIn('MOVIE_ID', $data['movie_id_ara'])->orderBy('MOVIE_NAME')->lists('MOVIE_NAME');

        return view('searchresultpage')->with('data', $data);
    }

    public function searchMovieByCatagory(Request $request)
    {
        if(!$request->has('inputsearch'))
            return back();

        $query = DB::table('movie');

        if($request->select == 'name' || $request->select == 'all')
            $query = $query->where('MOVIE_NAME', 'like' , '%'.$request->inputsearch.'%');
        if($request->select == 'director' || $request->select == 'all')
        {
            $dir_ara = DB::table('director')->where('DIRECTOR_NAME', 'like', '%'.$request->inputsearch.'%')->lists('DIRECTOR_ID');
            $query = $query->whereIn('DIRECTOR_ID', $dir_ara);
        }
        if($request->select == 'production' || $request->select == 'all')
        {
            $prod_ara = DB::table('production_house')->where('PROD_HOUSE_NAME', 'like', '%'.$request->inputsearch.'%')->lists('PROD_HOUSE_ID');
            $query = $query->whereIn('PROD_HOUSE_ID', $prod_ara);
        }
        if($request->select == 'actor' || $request->select == 'all')
        {
            $act_ara = DB::table('actor')->where('NAME', 'like', '%'.$request->inputsearch.'%')->lists('ACTOR_ID');
            $movie_id_of_act_ara = DB::table('actor_list')->whereIn('ACTOR_ID', $act_ara)->lists('MOVIE_ID');
            $query = $query->whereIn('MOVIE_ID', $movie_id_of_act_ara);
        }
        if($request->select == 'genre' || $request->select == 'all')
        {
            $movie_id_of_genre_ara = DB::table('movie_genre')->whereIn('GENRE_ID', array($request->inputsearch))->lists('MOVIE_ID');
            $query = $query->whereIn('MOVIE_ID', $movie_id_of_genre_ara);
        }

        $query = $query->orderBy('MOVIE_NAME');
        
        $data['movie_name_ara'] = $query->lists('MOVIE_NAME');
        $data['movie_id_ara'] = $query->lists('MOVIE_ID'); 

        return view('searchresultpage')->with('data', $data);
    }

}
