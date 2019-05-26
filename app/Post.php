<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{     //$table,$primaryKey,$timestabes (must call that)
    protected $table = 'posts';//posts is name of table, u can also change table name
    public $primaryKey = 'id'; // u can also change id to anyid column in database
    public $timestabes =true; //can be change to false

    public function userAnyname(){

    // return $this->belongsTo('App\User');
   
        return $this->belongsTo('App\User', 'user_id'); // App\User from app\User.php, user_idis the foreign key
    
        //$this is Post,  have relation with the User and it belongsTo a User
        //a single post belong a User
        //App is folder we are in  and must be 
        //capital A and User is from app\Post.php
        
      
    }
}
