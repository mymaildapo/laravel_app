<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title ="Welcome to Dapo Oloruntola Page"; //declare new variable, compact () so we can see it in our view index.blade.php
        //return view('pages.index',compact('title')); // resources\views\pages look for pages folder and index.blade.php
            //or can also do it like this ->with (most used)
    return view('pages.index')->with('titleAnyname', $title); // resources\views\pages look for pages folder and index.blade.php
          //titleAnyname is what i want to call in index.blade.php

    }

    public function about()
    {
        $title ="About Dapo "; //declare new variable, compact () so we can see it in our view index.blade.php
       
        return view('pages.about')->with('titleAnyname', $title); // resources\views\pages look for pages folder and index.blade.php
        //titleAnyname is what i want to call in index.blade.php

    }

    public function services()
    {   
        $data = array(
            'title' => "Dapo Services",
            'servicesAnyname' => ['Programming','Data', 'Having Fun']
        );
        return view('pages.services')->with($data);
    }

    public function welcome()
    {   
        
        return view('welcome');
    }

}