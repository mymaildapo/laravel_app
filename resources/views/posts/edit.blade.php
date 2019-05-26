@extends('SharedLayout.app')<!--Nav bAR-  resources\views\SharedLayout\app.blade.php-->
@section('AllDapocontent') <!--contain all html tags, this is how ur import it, i export it in file resources\views\SharedLayout\app.blade.php-->
    <h1>Edit Post</h1>
    <!--Create Create.blade.php first before this page--->
    <!--$postNameAKA is from app\Http\Controllers\PostController.php edit function-->
    <!--$postNameAKA->id we need to include this to know which id it is updating--->
    {{ Form::open(['action' => ['PostController@update',$postNameAKA->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        <!--run @update function in PostController@update when the button is clicked so it goin to make a post request to the function called store -->
        <!--action, method, POST is reserved word,so i didnt write it somewhere-->
        <div class="group-form">
            {{Form::label('title','Title ') }} <!--{{Form::label('labelNameForTitle','My Title for textBox goes here ') }}-->
            {{Form::text('titleTextbox', $postNameAKA->title, ['class' => 'form-control', 'placeholder' => 'place-holder'])}} <!-- {{Form::text('textBoxNameForTitle', '', ['class' => 'form-control', 'placeholder' => 'My title data for database TextBox placeHolder'])}}-->
            
        </div>
        <div class="group-form">
                {{Form::label('body','Body') }}           <!--id below will make the textarea look like microsoft words editor--->
                {{Form::textarea('bodyTextBox', $postNameAKA->body, ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'place-holder'])}} <!--id is reserved and article-ckeditor is from the script in resources\views\SharedLayout\app.blade.php-->
        </div>
         <div class="form-group">
            {{Form::file('cover_imageAnyname')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-success'])}}   <!--{{Form::submit('Text = Submit', ['class' => 'btn btn-primary'])}}--->
        {{Form::hidden('_method','PUT')}} <!--To update we need use PUT, above in Form::open but we cant legally use PUT so we do this code here to work -->
    {{ Form::close() }}
   
@endsection