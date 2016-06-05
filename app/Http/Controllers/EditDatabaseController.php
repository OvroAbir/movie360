<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use Auth;

class EditDatabaseController extends Controller
{
    public function getChoicePage()
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7 && Auth::user()->role != 3)
    		return redirect('/');

    	return view('editchoicepage');
    }

    public function getInsertMoviePage()
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

    	$data = array();

    	$language_ara = DB::table('language');
    	$data['language_id_ara'] = $language_ara->pluck('LANGUAGE_ID');
    	$data['language_name_ara'] = $language_ara->pluck('LANGUAGE_NAME');

    	$country_ara = DB::table('country');
    	$data['country_id_ara'] = $country_ara->pluck('COUNTRY_ID');
    	$data['country_name_ara'] = $country_ara->pluck('COUNTRY_NAME');

    	$production_house_ara = DB::table('production_house');
    	$data['production_house_id_ara'] = $production_house_ara->pluck('PROD_HOUSE_ID');
    	$data['production_house_name_ara'] = $production_house_ara->pluck('PROD_HOUSE_NAME');

    	$director_ara = DB::table('director');
    	$data['director_id_ara'] = $director_ara->pluck('DIRECTOR_ID');
    	$data['director_name_ara'] = $director_ara->pluck('DIRECTOR_NAME');

    	$genre_ara = DB::table('genre')->orderBy('GENRE_NAME');
    	$data['genre_id_ara'] = $genre_ara->pluck('GENRE_ID');
    	$data['genre_name_ara'] =  $genre_ara->pluck('GENRE_NAME');

    	return view('insertmovieform')->with('data', $data);
    }

    public function insertMovie(Request $request)
    {
		if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

		$movie_name  = NULL;
		$run_time = NULL;
		$language_id = NULL;
		$relDate = NULL;
		$relMonth = NULL;
		$relYear = NULL;
		$budget = NULL;
		$country_id = NULL;
		$rating = NULL;
		$production_house_id = NULL;
		$director_id = NULL;
		$plot = NULL;
		$trailer = NULL;
		$imdb_link = NULL;
		$release_date = NULL;

		$genre_ara = NULL;

		if($request->has('movieNameTextField'))
			$movie_name = $request->movieNameTextField;
		else
			return redirect()->back();

		if($request->has('runTimeTextField'))
			$run_time = $request->runTimeTextField;
		if($request->has('languageIdDropDOwn'))
			$language_id = $request->languageIdDropDOwn;//
		if($request->has('relDateDayDropDown'))
			$relDate = $request->relDateDayDropDown;
		if($request->has('relDateMonthDropdown'))
			$relMonth = $request->relDateMonthDropdown;
		if($request->has('relDateYearTextField'))
			$relYear = $request->relDateYearTextField;
		if($request->has('budgetTextField'))
			$budget = $request->budgetTextField;
		if($request->has('countryIdDropDOwn'))
			$country_id = $request->countryIdDropDOwn;
		if($request->has('ratingTextField'))
			$rating = $request->ratingTextField;
		if($request->has('prodIdDropDOwn'))
			$production_house_id = $request->prodIdDropDOwn;
		if($request->has('dirIdDropDOwn'))
			$director_id = $request->dirIdDropDOwn;
		if($request->has('trailer'))
			$trailer = $request->trailer;
		if($request->has('ImdbLink'))
			$imdb_link = $request->ImdbLink;
		if($request->has('plot'))
			$plot = $request->plot;

		$release_date = $relYear.'-'.$relMonth.'-'.$relDate;


		$movie_id = DB::table('movie')->insertGetId(
						[
						'MOVIE_NAME'=>$movie_name,
						'RUNTIME'=>$run_time,
						'RELEASE_DATE'=>$release_date,
						'BUDGET'=>$budget,
						'COUNTRY_ID'=>$country_id,
						'RATING'=>$rating,
						'PROD_HOUSE_ID'=>$production_house_id,
						'DIRECTOR_ID'=>$director_id,
						'PLOT'=>$plot,
						'IMDB_LINK'=>$imdb_link,
						'TRAILER'=>$trailer
						]);

		if($request->has('check_list'))
		{
			foreach ($request->check_list as $genre_id) {
				DB::table('movie_genre')->insert(
					[
					'MOVIE_ID'=>$movie_id,
					'GENRE_ID'=>$genre_id
					]);
			}
		}
		if($language_id != null)
		{
			DB::table('movie_language')->insert(
				[
				'MOVIE_ID'=>$movie_id,
				'LANGUAGE_ID'=>$language_id
				]);
		}

		if($request->has('fileToUpload'))
		{
			$old_name = $request->fileToUpload;
			$old_path = 'upload/'.$old_name;

			$extension = \File::extension($old_path);

			$new_name = $movie_id.'.'.$extension;
			$new_path = 'images/'.$new_name;

			\File::copy($old_path , $new_path);
		}
		return redirect('/edit/addactorinmovie');
    }
    public function getInsertActorInMoviePage()
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

    	$data = array();
    	$data['movie_id_ara'] = DB::table('movie')->orderBy('MOVIE_NAME')->lists('MOVIE_ID');
    	$data['movie_name_ara'] = DB::table('movie')->orderBy('MOVIE_NAME')->lists('MOVIE_NAME');

    	$data['actor_id_ara'] = DB::table('actor')->orderBy('NAME')->lists('ACTOR_ID');
    	$data['actor_name_ara'] = DB::table('actor')->orderBy('NAME')->lists('NAME');

    	return view('insertactorinmovie')->with('data', $data);
    }

    public function insertActorInMovie(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

    	$movie_id = null;
    	if($request->has('movieNameDropDown'))
    		$movie_id = $request->movieNameDropDown;
    	else
    		return back();

    	if($request->has('actor_check_list'))
    	{
    		$count  = 0;
    		foreach ($request->actor_check_list as $actor_id) {
    			$character_name = $request->character_input[$actor_id];

    			if(DB::table('actor_list')->where('MOVIE_ID', $movie_id)->where('ACTOR_ID', $actor_id)->count()==0)
    			{
    				DB::table('actor_list')->insert(
    					[
    					'MOVIE_ID' => $movie_id,
    					'ACTOR_ID' => $actor_id,
    					'CHARACTER_NAME' => $character_name
    					]);
    			}
    			else if(DB::table('actor_list')->where('MOVIE_ID', $movie_id)->where('ACTOR_ID', $actor_id)->first()->CHARACTER_NAME == null && $character_name != null)
    			{
    				DB::table('actor_list')->where('MOVIE_ID', $movie_id)->where('ACTOR_ID', $actor_id)->update(
    					['CHARACTER_NAME'=>$character_name]);
    			}
    		}
    	}
    	else
    		return back();

    	return redirect('/movies/'.$movie_id);
    }

    public function getInsertActorPage()
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

    	$country_ara = DB::table('country');
    	$data['country_id_ara'] = $country_ara->pluck('COUNTRY_ID');
    	$data['country_name_ara'] = $country_ara->pluck('COUNTRY_NAME');

    	return view('insertactor')->with('data', $data);
    }

    public function insertActor(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

    	$actor_name = null;
    	$actor_img = null;
    	$gender_id = null;
    	$height = null;
    	$country = null;
    	$bDate = null;

    	if($request->has('actorNameTextField'))
    		$actor_name = $request->actorNameTextField;
    	else
    		return back();


		if($request->has('radionGender[male]'))
			$gender_id = 1;
		else
			$gender_id = 2;

		if($request->has('dayDropDown'))
			$date = $request->dayDropDown;
		if($request->has('monthDropdown'))
			$month = $request->monthDropdown;
		if($request->has('birDateYearTextField'))
			$year = $request->birDateYearTextField;

		$bDate = $year.'-'.$month.'-'.$date;

		if($request->has('heightTextField'))
			$height = $request->heightTextField;

		if($request->has('countryIdDropDOwn'))
			$country_id = $request->countryIdDropDOwn;

		$actor_id = DB::table('actor')->insertGetId(
			[
			'NAME'=>$actor_name,
			'GENDER_ID'=>$gender_id,
			'BIRTH_DATE'=>$bDate,
			'HEIGHT'=>$height,
			'COUNTRY_ID'=>$country_id
			]);

		if($request->has('fileToUpload'))
		{
			$old_name = $request->fileToUpload;
			$old_path = 'upload/'.$old_name;

			$extension = \File::extension($old_path);

			$new_name = $actor_id.'.'.$extension;
			$new_path = 'images/actor/'.$new_name;

			\File::copy($old_path , $new_path);
		}

		return redirect('/actors/'.$actor_id);
    }

    public function getInsertDirectorPage()
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

    	$person_type = 'd';
    	return view('insertdirprod')->with('person_type', $person_type);
    }

    public function getInsertProdPage()
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

    	$person_type = 'p';
    	return view('insertdirprod')->with('person_type', $person_type);
    }

    public function insertDirectorProd(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

    	if($request->has('name'))
    		$name = $request->name;
    	else
    		return back();
    	
    	$person_type = $request->type;
    	if($person_type == 'd')
    	{
    		DB::table('director')->insert(
    			['DIRECTOR_NAME'=>$request->name]);
    	}
    	else if($person_type == 'p')
    	{
    		DB::table('production_house')->insert(
    			['PROD_HOUSE_NAME'=>$request->name]);
    	}
    	return redirect('/edit');
    }

    public function getDeletePage($type)
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

    	if($type == 'movie')
    	{
    		$id_ara = DB::table('movie')->orderBy('MOVIE_NAME')->lists('MOVIE_ID');
    		$name_ara = DB::table('movie')->orderBy('MOVIE_NAME')->lists('MOVIE_NAME');
    	}

    	else if($type == 'actor')
    	{
    		$id_ara = DB::table('actor')->orderBy('NAME')->lists('ACTOR_ID');
    		$name_ara = DB::table('actor')->orderBy('NAME')->lists('NAME');
    	}

    	else if($type == 'director')
    	{
    		$id_ara = DB::table('director')->orderBy('DIRECTOR_NAME')->lists('DIRECTOR_ID');
    		$name_ara = DB::table('director')->orderBy('DIRECTOR_NAME')->lists('DIRECTOR_NAME');
    	}

    	else if($type == 'production_house')
    	{
    		$id_ara = DB::table('production_house')->orderBy('PROD_HOUSE_NAME')->lists('PROD_HOUSE_ID');
    		$name_ara = DB::table('production_house')->orderBy('PROD_HOUSE_NAME')->lists('PROD_HOUSE_NAME');
    	}
    	return view('deletepage')->with('id_ara', $id_ara)->with('name_ara', $name_ara)->with('type', $type);	
    }

    public function deleteObject(Request $request, $type)
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

    	$id_ara = null;
    	if($request->has('id_list'))
    		$id_ara = $request->id_list;


    	if($type == 'movie')
    	{
    		foreach ($id_ara as $movie_id) {
    			DB::table('movie')->where('MOVIE_ID', $movie_id)->delete();
    		}
    	}
    	else if($type == 'actor')
    	{
    		foreach ($id_ara as $actor_id) {
    			DB::table('actor')->where('ACTOR_ID', $actor_id)->delete();
    		}
    	}

    	else if($type == 'director')
    	{
    		foreach ($id_ara as $director_id) {
    			DB::table('director')->where('DIRECTOR_ID', $director_id)->delete();
    		}
    	}

    	else if($type == 'production_house')
    	{
    		foreach ($id_ara as $prod_id) {
    			DB::table('production_house')->where('PROD_HOUSE_ID', $prod_id)->delete();
    		}
    	}
    	
    	return redirect('/edit');
    }

    public function getUpgradeUserPage()
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

    	$data['user_id_ara'] = DB::table('users')->where('role', 1)->lists('id');
    	$data['user_name_ara'] = DB::table('users')->where('role', 1)->lists('name');

    	return view('upgradeuser')->with('data', $data);
    }

    public function upgradeUser(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7)
    		return redirect('/');

    	$user_id = $request->userselect;
    	DB::table('users')->where('id', $user_id)->update(
    		['role'=>3]);
    	return redirect('/edit');
    }

    public function getUpdateMoviePageList()
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7 && Auth::user()->role != 3)
    		return redirect('/');

        $movie_id_ara = DB::table('movie')->pluck('MOVIE_ID');

        $movie_count = 0;
        $movie_name_ara = array();
        foreach ($movie_id_ara as $movie_id) {
            $movie_name_ara[$movie_count] = DB::table('movie')->where('MOVIE_ID', $movie_id)->first()->MOVIE_NAME;
            $movie_count++;
        }
        return view('updatemoviepagelist')->with('movie_id_ara', $movie_id_ara)->with('movie_name_ara', $movie_name_ara);
    }

    public function getUpdateMoviePage($movie_id)
    {
    	if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7 && Auth::user()->role != 3)
    		return redirect('/');

    	$data['movie_id'] = $movie_id;
    	$movie = DB::table('movie')->where('MOVIE_ID', $movie_id)->first();
     	$data['movie_name'] = $movie->MOVIE_NAME;

     	$data['rating'] = $movie->RATING;

        $data['budget'] = $movie->BUDGET;
        $data['runtime'] = $movie->RUNTIME;
        $data['release_date'] = $movie->RELEASE_DATE;
        $data['country_id'] = $movie->COUNTRY_ID;
        $data['rating'] = $movie->RATING;
        $data['prod_id'] = $movie->PROD_HOUSE_ID;
        $data['director_id'] = $movie->DIRECTOR_ID;
        $data['plot'] = $movie->PLOT;
        $data['imdb'] = $movie->IMDB_LINK;
        $data['trailer'] = $movie->TRAILER;
        $data['language_id'] = DB::table('movie_language')->where('MOVIE_ID', $movie_id)->first()->LANGUAGE_ID;

        sscanf($data['release_date'], "%d-%d-%d", $data['year'], $data['month'], $data['date']);
        $data['month_name'] = array('dummy', 'JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC');


        $data['language_id_ara'] = DB::table('language')->orderBy('LANGUAGE_NAME')->lists('LANGUAGE_ID');
        $data['language_name_ara'] = DB::table('language')->orderBy('LANGUAGE_NAME')->lists('LANGUAGE_NAME');

        $data['country_id_ara'] = DB::table('country')->orderBy('COUNTRY_ID')->lists('COUNTRY_ID');
        $data['country_name_ara'] = DB::table('country')->orderBy('COUNTRY_ID')->lists('COUNTRY_NAME');

        $data['production_house_id_ara'] =  DB::table('production_house')->orderBy('PROD_HOUSE_NAME')->lists('PROD_HOUSE_ID');
        $data['production_house_name_ara'] =  DB::table('production_house')->orderBy('PROD_HOUSE_NAME')->lists('PROD_HOUSE_NAME');

        $data['director_id_ara'] = DB::table('director')->orderBy('DIRECTOR_NAME')->lists('DIRECTOR_ID');
        $data['director_name_ara'] = DB::table('director')->orderBy('DIRECTOR_NAME')->lists('DIRECTOR_NAME');

        $data['genre_id_ara'] = DB::table('genre')->orderBy('GENRE_NAME')->lists('GENRE_ID');
        $data['genre_name_ara'] = DB::table('genre')->orderBy('GENRE_NAME')->lists('GENRE_NAME');

        $data['checked_genres'] = DB::table('movie_genre')->where('MOVIE_ID', $movie_id)->lists('GENRE_ID');

        return view('updatemovie')->with('data', $data);
    }

    public function updateMovie(Request $request)
    {
		if(Auth::guest())
    		return redirect('/login');
    	else if(Auth::user()->role !=7 && Auth::user()->role !=3)
    		return redirect('/');

		$movie_name  = NULL;
		$run_time = NULL;
		$language_id = NULL;
		$relDate = NULL;
		$relMonth = NULL;
		$relYear = NULL;
		$budget = NULL;
		$country_id = NULL;
		$rating = NULL;
		$production_house_id = NULL;
		$director_id = NULL;
		$plot = NULL;
		$trailer = NULL;
		$imdb_link = NULL;
		$release_date = NULL;

		$genre_ara = NULL;

		$movie_id = $request->movie_id;

		if($request->has('runTimeTextField'))
			$run_time = $request->runTimeTextField;
		if($request->has('languageIdDropDOwn'))
			$language_id = $request->languageIdDropDOwn;//
		if($request->has('relDateDayDropDown'))
			$relDate = $request->relDateDayDropDown;
		if($request->has('relDateMonthDropdown'))
			$relMonth = $request->relDateMonthDropdown;
		if($request->has('relDateYearTextField'))
			$relYear = $request->relDateYearTextField;
		if($request->has('budgetTextField'))
			$budget = $request->budgetTextField;
		if($request->has('countryIdDropDOwn'))
			$country_id = $request->countryIdDropDOwn;
		if($request->has('ratingTextField'))
			$rating = $request->ratingTextField;
		if($request->has('prodIdDropDOwn'))
			$production_house_id = $request->prodIdDropDOwn;
		if($request->has('dirIdDropDOwn'))
			$director_id = $request->dirIdDropDOwn;
		if($request->has('trailer'))
			$trailer = $request->trailer;
		if($request->has('ImdbLink'))
			$imdb_link = $request->ImdbLink;
		if($request->has('plot'))
			$plot = $request->plot;

		$release_date = $relYear.'-'.$relMonth.'-'.$relDate;


		DB::table('movie')->where('MOVIE_ID', $movie_id)->update(
			[
			'RUNTIME'=>$run_time,
			'RELEASE_DATE'=>$release_date,
			'BUDGET'=>$budget,
			'COUNTRY_ID'=>$country_id,
			'RATING'=>$rating,
			'PROD_HOUSE_ID'=>$production_house_id,
			'DIRECTOR_ID'=>$director_id,
			'PLOT'=>$plot,
			'IMDB_LINK'=>$imdb_link,
			'TRAILER'=>$trailer
			]);

		if($request->has('check_list'))
		{
			DB::table('movie_genre')->where('MOVIE_ID', $movie_id)->delete();
			foreach ($request->check_list as $genre_id) {
				DB::table('movie_genre')->insert(
					[
					'MOVIE_ID'=>$movie_id,
					'GENRE_ID'=>$genre_id
					]);
			}
		}
		if($language_id != null)
		{
			DB::table('movie_language')->where('MOVIE_ID', $movie_id)->update(
				['LANGUAGE_ID'=>$language_id]);
		}

		if($request->has('fileToUpload'))
		{
			$old_name = $request->fileToUpload;
			$old_path = 'upload/'.$old_name;

			$extension = \File::extension($old_path);

			$new_name = $movie_id.'.'.$extension;
			$new_path = 'images/'.$new_name;

			\File::copy($old_path , $new_path);
		}
		return redirect('/movies/'.$movie_id);
    }

    public function getDirList()
    {
        $name = DB::table('director')->orderBy('DIRECTOR_NAME')->lists('DIRECTOR_NAME');
        return view('showobjectlist')->with('name', $name);
    }
    public function getProdList()
    {
        $name = DB::table('production_house')->orderBy('PROD_HOUSE_NAME')->lists('PROD_HOUSE_NAME');
        return view('showobjectlist')->with('name', $name);
    }
}
