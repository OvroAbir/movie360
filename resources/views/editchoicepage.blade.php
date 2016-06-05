@extends('layouts.mylayout')

@section('leftpanContent')
  @if(Auth::user()->role == 7)
    <p>
      <font size = "3">
        <a href="/edit/add/movie"> Add a Movie </a><br /><br />
        <a href="/edit/add/actor"> Add an Actor/Actress</a><br /><br />
        <a href="/edit/add/director"> Add a Director</a><br /><br />
        <a href="/edit/add/production_house"> Add a Production House</a><br /><br />
      </font>
    </p>

    <p>
      <font size = "3">
        <a href="/edit/delete/movie"> Delete a Movie </a><br /><br />
        <a href="/edit/delete/actor"> Delete an Actor/Actress</a><br /><br />
        <a href="/edit/delete/director"> Delete a Director</a><br /><br />
        <a href="/edit/delete/production_house"> Delete a Production House</a><br /><br />
      </font>
    </p>

    <p>
      <font size = "3">
        <a href="/edit/addactorinmovie"> Add Actors In a Movie</a><br /><br />
      </font>
    </p>
  @endif

  @if(Auth::user()->role == 7 || Auth::user()->role == 3)
    <p>
      <font size = "3">
        <a href="/edit/update/movie"> Update a Movie </a><br /><br />
        <a href="/edit/update/actor"> Update an Actor/Actress</a><br /><br />
      </font>
    </p>
  @endif

     
  @if(Auth::user()->role == 7)
    <p>
      <font size="3">
        <a href="/edit/upgradeuser"> Upgrade A User </a><br /><br />
        <a href="/edit/reporting"> Generate Report </a>
      </font>
    </p>
  @endif

@endsection