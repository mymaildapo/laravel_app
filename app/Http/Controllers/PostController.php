<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; 
use App\User;//BRING OUR MODEL IN,app\Post.php App Amust be Capital eventhough in the folder is lower case
use DB; //FOR sql (i dint create any folder just type this)
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //we copied this code from app\Http\Controllers\DashBoardController.php so we can
    //if the user who ar NOT logged in can create a post,delete or edit post
    public function __construct()
    {
        //config\auth.php is from class config\auth.php
        $this->middleware('auth', ['except' => ['index', 'show']]);
        //block everything in dash.blade.php is going to be block if user hasnt signed in
        //except does - is show view folder resources\views we want the guest user/not logg in to user to see
        // so i want to to see index in posts folder resources\views\posts\index.blade.php and show in pages folder resources\views\pages\show.blade.php
   
        //try it out when user go to http://127.0.0.1:8000/posts/create
        // it will redirect them to login 
        //all we have to do is put this code here
    }

    public function index()
    //Post is the model name
    {           // Post::all(); -this grab all the array of data in the database
   //    $anynamePost =  Post::all(); //Post is the name of this file app\Post.php, not table name
      // return $anynamePost; //return arrays of database
       // $anynamePost =  Post::orderBy('title','asc')->get(); //title name of column in database
      //  return Post::where('title','Post One')->get(); //with condition return [] to same page
    // $anynamePost =  Post::orderBy('title','desc')->get(); //title name of column in database
            //or but use above because it more easier and recommended
     //$anynamePost = DB::select('SELECT * FROM posts');
     //$anynamePost =  Post::orderBy('title','desc')->take(1)->get();//return data 1 [], desc
     //$anynamePost =  Post::orderBy('title','asc')->take(1)->get();//return data 1 [], asc
    $anynamePost =  Post::orderBy('created_at','desc')->paginate(2);//show 2 post data per page,  i need to put this {{$anynamePostAKA->links()}} in resources\views\posts\index.blade.php, this display number of pages
    //created_at name of column in database
      return view('posts.index')->with('anynamePostAKA',$anynamePost); //resources\views\posts\index.blade.php
   
    }

    
    public function create()
    {
     //   return ('posts.create'); // return string only, posts.create
         return view('posts.create'); // now go to brower, this will work bacuse u work this code  Route::resource('posts','PostController'); in in routes\web.php,
        //return page at resources\views\posts\create.blade.php
    }

   
    public function store(Request $request)
    {
        //validation
        $this-> validate($request,[
            'titleTextbox' => 'required', //titleTextbox from resources\views\posts\create.blade.php
            'bodyTextBox' => 'required',  // bodyTextBox resources\views\posts\create.blade.php
             'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        //cover_imageAnyname is from resources\views\posts\create.blade.php
        if ($request->hasFile( 'cover_imageAnyname')) {
            // Get filename with the extension
            $filenameWithExt = $request->file( 'cover_imageAnyname')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file( 'cover_imageAnyname')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file( 'cover_imageAnyname')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        //create post
        // because we have this use App\Post on top of the page
        //so we can can new Post (see line 6)

        //creat a new Post
        $postAnyname = new Post; // can the object of app\Post.php
        //title and body is from database
        $postAnyname -> title = $request -> input('titleTextbox');//titleTextbox from resources\views\pages\show.blade.php
        $postAnyname -> body = $request -> input('bodyTextBox');//titleTextbox from resources\views\pages\show.blade.php
        $postAnyname -> user_id = auth()->user()->id; // auth()->user->id always the same. user() and, auth() reserved i dint write it
        $postAnyname -> cover_image = $fileNameToStore; 
        $postAnyname -> save();
        
        return redirect('/posts') -> with ('success', 'Post Created successfully !'); //'success is from views\inc\messages.blade.php @if(session('success'))
        //success is just to get the div to display when succesful
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pName = Post::find($id); // is the model in app\Post.php
        return view('pages.show')->with('postNameAKA', $pName ); //no $ befor postNameAKA
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pName = Post::find($id); // is the model in app\Post.php
    
        //check for user_id, so users can edit post that is not theirs
        //when we controller we can access user table id with auth()
        //if user table id is not equal to post table foreign key user_id then redirect to http://127.0.0.1:8000/posts
        //with message Un-authorized
        if(auth()->user()->id !== $pName->user_id)
        {
            //error is from resources\views\inc\messages.blade.php
            return redirect('/posts')->with('error', 'Un-Authorized Page'); //no $ befor postNameAKA
       
        }
        //it will user below code if the if statement didnt return
        return view('posts.edit')->with('postNameAKA', $pName); //no $ befor postNameAKA
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //validation
        $this-> validate($request,[
            'titleTextbox' => 'required', //titleTextbox from resources\views\posts\create.blade.php
            'bodyTextBox' => 'required'  // bodyTextBox resources\views\posts\create.blade.php
        ]);
        //create post
        // because we have this use App\Post on top of the page
        //so we can can new Post (see line 6)


        // Handle File Upload
        //cover_imageAnyname is from resources\views\posts\create.blade.php
        if ($request->hasFile( 'cover_imageAnyname')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_imageAnyname')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_imageAnyname')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('cover_imageAnyname')->storeAs('public/cover_images', $fileNameToStore);
        } 


        //find new Post
        $postAnyname = Post::find($id);   //find post using id, Post is the name of file app\Post.php
        //title and body is from database
        $postAnyname -> title = $request -> input('titleTextbox');//titleTextbox from resources\views\pages\show.blade.php
        $postAnyname -> body = $request -> input('bodyTextBox'); //titleTextbox from resources\views\pages\show.blade.php

        if ($request->hasFile( 'cover_imageAnyname')) {
            $postAnyname-> cover_image = $fileNameToStore;  //must be white in colour cover_image
        }
        $postAnyname -> save(); // save() is reserved methd
        
        return redirect('/posts') -> with ('success', 'Post Updated successfully!'); //'success is from views\inc\messages.blade.php @if(session('success'))
        //success is just to get the div to display when succesful
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //first find the post
        $post = Post::find($id);

        //check for user_id, so users can delete post that is not theirs
        //when we controller we can access user table id with auth()
        //if user table id is not equal to post table foreign key user_id then redirect to http://127.0.0.1:8000/posts
        //with message Un-authorized
        if (auth()->user()->id !== $post->user_id) {
            //error is from resources\views\inc\messages.blade.php
            return redirect('/posts')->with('error', 'Un-Authorized Page'); //no $ befor postNameAKA

        }

        if ($post->cover_image != 'noimage.jpg') {
            // Delete Image
            Storage::delete('public/cover_images/' . $post->cover_image);
        }

        $post -> delete(); // delete() is reserved methd
        return redirect('/posts') -> with ('success', 'Post Deleted successfully!'); //'success is from views\inc\messages.blade.php @if(session('success'))
        
    }
}
