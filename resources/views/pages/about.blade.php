@extends('SharedLayout.app')<!--Telling it to look at this folder only-->
<!--we must wrap everything up with laravel tag once we use one laravel tag unelse the page going
to be using two html document-->
@section('AllDapocontent')
        <h1><?php echo $titleAnyname; ?></h1><!-- also can do {{$titleAnyname}}--->
        <p>This is About</p>
@endsection
   