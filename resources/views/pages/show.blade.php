@extends('SharedLayout.app')<!--Nav bAR-  resources\views\SharedLayout\app.blade.php-->
@section('AllDapocontent') <!--contain all html tags, this is how ur import it, i export it in file resources\views\SharedLayout\app.blade.php-->
    <br>
   <a href="/posts" class="btn btn-dark">Go Back</a>
        <h1>{{$postNameAKA->title}}</h1>
        <img style="width:50%" src="/storage/cover_images/{{$postNameAKA->cover_image}}">
        <br>
        <br>
        <h3>{!!$postNameAKA->body!!}</h3> <!--2!! with it parse the html meaning it will convert the ckeditor html to text-->
        <hr>
        <small>Written on {{$postNameAKA->created_at}} by {{$postNameAKA->userAnyname->name}}</small>
        <hr>
        <!---mean if user is not a guest then they should be able to see edit and delete bottons below--->
        @if(!Auth::guest())<!---if not Auth::guest() reserved I didnt write them--->
             @if(Auth::user()->id == $postNameAKA->user_id)<!--if user table id == post table user_id  then show the buttons--->
                    <a href="/posts/{{$postNameAKA->id}}/edit" class="btn btn-dark">Edit</a> <!--Edit using the id-->
                    <!--below form for delete method is Post even though it is going to be delete 'class' => 'pull-right'] pull it to the right of the edit button--->
                    {!!Form::open(['action' => ['PostController@destroy', $postNameAKA->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                        <!--inside the form-->
                        {{Form::hidden('_method','DELETE')}} <!--so DELETE can work overide above method POSt, WE CAN ONLY LEGALLY USED POST THERE-->
                        {{Form::submit('Delete',['class' => 'btn btn-danger'])}} <!--delete form and delete button-->
                        <!--orm::submit('Delete')- is the name text to display on the button -->
                    {!!Form::close()!!}
        
                @endif
        @endif
@endsection
