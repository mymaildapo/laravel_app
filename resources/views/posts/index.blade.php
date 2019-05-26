@extends('SharedLayout.app')<!--Nav bAR-  resources\views\SharedLayout\app.blade.php-->
@section('AllDapocontent') <!--contain all html tags, this is how ur import it, i export it in file resources\views\SharedLayout\app.blade.php-->
    <h1>Posts</h1>
    @if(count($anynamePostAKA) > 0) <!---must be > 0 to show the first one-->
    <ul class="list-group">
        @foreach($anynamePostAKA as $anyname )

        <li class="list-group-item">
         <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style="width:100%" src="/storage/cover_images/{{$anyname->cover_image}}">
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$anyname->id}}">{{$anyname->title}}</a></h3>
                        <small>Written on {{$anyname->created_at}} by {{$anyname->userAnyname->name}}</small>
                    </div>
                </div>
            </li>
        @endforeach
        {{$anynamePostAKA->links()}} <!--this will give number of pages per 2 post. i need to write paginate(2) in app\Http\Controllers\PostController.php;-->
           
    </ul>
    @else
        <p>No Post Found</p>
    @endif
@endsection