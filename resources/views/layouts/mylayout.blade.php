<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Movies365</title>

@yield('headContent')

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" >

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
   
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>

</head>
<body>
<div id="topPan"> <a href="#"><img src="/images/logo.gif" title="Brain Tech" alt="Brain Tech" width="219" height="58" border="0"  class="logo"/></a>
  <div id="topimagePan"><img src="/images/blank.gif" alt="" /></div>
  <ul>
    <li class="home"><a href="/">Home</a></li>
    <li><a href="/movies/">Top Movies</a></li>
    <li><a href="{{ url('searchpage') }}">Search</a></li>
    @if(!Auth::guest() && (Auth::user()->role == 7 || Auth::user()->role == 3))
    	<li><a href="/edit">Admin Access</a></li>
    @endif

    @if (Auth::guest())
        <li><a href="{{ url('/login') }}">Login</a></li>
    @else
        <li><a href="{{ url('/logout') }}"><i></i>Logout</a></li>
        <li><a>Welcome <span>{{ Auth::user()->name }} </span></a></li>
    @endif

    
  </ul>
</div>
<div id="bodyPan">
  <div id="leftPan">
    @yield('leftpanContent')
  </div>

  <div id="rightPan">
    <div id="rightform2Pan">
      <form action="/movies/search_by_catagory" method="post" class="form2">
      {!! csrf_field() !!}
        <h2>Search</h2>
        <label>search</label>
        <input name="inputsearch" type="text" />
        <select name="select">
          {{--<option value="all">All</option>--}}
          <option value="name">by name</option>
          {{--<option value="genre">by genre</option>--}}
          <option value="actor">by actor</option>
          <option value="director">by director</option>
        </select>
        <input name="search" type="submit"  class="search" id="search" value="SEARCH"/>
      </form>
    </div>


    <h3>Browse</h3>
      <ul>
        <li><a href="/movies">Movies</a></li>
        <li><a href="/actors">Actors</a></li>
        <li><a href="/directors">Directors</a></li>
        <li><a href="/producers">Producers</a></li>
      </ul>


    

    <h3>Browse By Catagory</h3>
    <ul>
      <li><a href="/movies/search_by_genre/6">Action</a></li>
      <li><a href="/movies/search_by_genre/2">Adventure</a></li>
      <li><a href="/movies/search_by_genre/9">Comedy</a></li>
      <li><a href="/movies/search_by_genre/1">Crime</a></li>
      <li><a href="/movies/search_by_genre/3">Drama</a></li>
      <li><a href="/movies/search_by_genre/4">Family</a></li>
      <li><a href="/movies/search_by_genre/5">Fantasy</a></li>
      <li><a href="/movies/search_by_genre/7">Mystery</a></li>
      <li><a href="/movies/search_by_genre/10">Romance</a></li>
      <li><a href="/movies/search_by_genre/8">Sci-fi</a></li>
    </ul>
  </div>
</div>
<div id="bodyBottomPan">
  <div id="BottomLeftPan">
    <p>
      @yield('bottomLeftPan')
    </p>
  </div>
  <div id="BottomMiddlePan">
    <p>
      @yield('bottomMiddlePan')
    </p>
  </div>
</div>
<div id="footerPan">
  <ul>
    <li><a href="index.php">home</a>|</li>
    <li><a href="about.php">about us</a>|</li>
    <li><a href="about.php">support</a>|</li>
    <li><a href="about.php">solutions</a>|</li>
    <li><a href="topMovie.php">movies</a>|</li>
    <li><a href="about.php">contact</a></li>
  </ul>
  <p class="copyright">©Free distributeable.</p>
  <div id="footerPanhtml"><a href="index.php">HTML</a></div>
  <div id="footerPancss"><a href="index.php">CSS</a></div>
</div>

</body>
</html>
