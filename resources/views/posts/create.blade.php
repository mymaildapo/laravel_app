@extends('SharedLayout.app')<!--Nav bAR-  resources\views\SharedLayout\app.blade.php-->
@section('AllDapocontent') <!--contain all html tags, this is how ur import it, i export it in file resources\views\SharedLayout\app.blade.php-->
  
    <h1>Create Post</h1>
    <!--for this to work u have to add provider and aliases in config\app.php--->
    <!--'enctype' => 'multipart/data' reserved rules is to put this because of the Form::file--->
    {{ Form::open(['action' => 'PostController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        <!--store is the function we are submitiing to, PostController@store so it goin to make a post request to the function called store -->
        <!--action, method, POST is reserved word,so i didnt write it somewhere-->
        <div class="group-form">
            {{Form::label('title','Title ') }} <!--{{Form::label('labelNameForTitle','My Title for textBox goes here ') }}-->
            {{Form::text('titleTextbox', '', ['class' => 'form-control', 'placeholder' => 'place-holder'])}} <!-- {{Form::text('textBoxNameForTitle', '', ['class' => 'form-control', 'placeholder' => 'My title data for database TextBox placeHolder'])}}-->
            <!--'' means it is blank in the textbox-->
        </div>
        <div class="group-form">
                {{Form::label('body','Body') }}           <!--id below will make the textarea look like microsoft words editor--->
                {{Form::textarea('bodyTextBox', '', ['id' => 'article-ckeditor','class' => 'form-control', 'placeholder' => 'place-holder'])}} <!--id is reserved and article-ckeditor is from the script in resources\views\SharedLayout\app.blade.php-->
        </div>
        <div class="form-group">
            {{Form::file('cover_imageAnyname')}}
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-success'])}}   <!--{{Form::submit('Text = Submit', ['class' => 'btn btn-primary'])}}--->
    {{ Form::close() }}
       
@endsection