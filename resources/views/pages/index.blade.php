@extends('SharedLayout.app') <!--importing      resources\views\Layout\app.blade.php-->

@section('AllDapocontent') <!--alway  call content , this will put it in main content which is body-->
  

    <div class="jumbotron text-center">
        <h1> {{$titleAnyname}}</h1>
        <p>This is the laravel application from the La from scratch Yotube series</p>
 
 
    </div>
@endsection