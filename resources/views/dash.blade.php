@extends('SharedLayout.app')

@section('AllDapocontent')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    <h3>You have {{count($postAKA)}} Blog Post</h3><!--{{count($postAKA)}}-->
                    @if(count($postAKA) > 0 )
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($postAKA as $postAnynameit) <!-- postAKA from app\Http\Controllers\DashBoardController.php Loop through all the post from the user-->
                                <tr>
                                    <td>{{$postAnynameit->title}}</td>
                                    <td><a href="/posts/{{$postAnynameit->id}}/edit" class="btn btn-dark">Edit</a></td><!--This will take use to post /id/ edit.blade.php page-->
                                    <td>
                                        {!!Form::open(['action' => ['PostController@destroy', $postAnynameit->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                                            <!--inside the form-->
                                            {{Form::hidden('_method','DELETE')}} <!--so DELETE can work overide above method POSt, WE CAN ONLY LEGALLY USED POST THERE-->
                                            {{Form::submit('Delete',['class' => 'btn btn-danger'])}} <!--delete form and delete button-->
                                            <!--orm::submit('Delete')- is the name text to display on the button -->
                                        {!!Form::close()!!}
                                    </td>
                                    <!---button need Form, delete button form-->
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no Posts</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
